<?php

namespace App\Console\Commands;

use App\Models\Fact;
use Illuminate\Console\Command;

class Importer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:importer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = storage_path('/app/private/filament_exports/1/0000000000000001.csv');
        if (! file_exists($file)) {
            return;
        }

        $lines = explode("\n", file_get_contents($file));
        $keys = [];
        $parsed = [];
        foreach ($lines as $lineno => $line) {

            $data = str_getcsv($line, escape: '\\');

            if (! $keys) {
                $keys = $data;

                continue;
            }

            if (! $data || ! $data[0]) {
                continue;
            }

            try {
                $record = array_combine($keys, $data);
                if (! $record['content_old']) {
                    continue;
                }
                $parsed[] = $record;
            } catch (\Throwable $e) {
                dd($keys, $data, $e->getMessage());
            }
        }

        //        shuffle($parsed);

        $parsed = array_chunk($parsed, 10);

        foreach ($parsed as $chunk) {
            $chunk = array_column($chunk, null, 'id');

            Fact::whereIn('id', array_keys($chunk))
                ->whereNull('published_at')
                ->update([
                    'published_at' => now(),
                ]);

            $existing = Fact::whereIn('id', array_keys($chunk))
                ->where('content_old', '=', '')
                ->get();
            if (! $existing->count()) {
                continue;
            }
            foreach ($existing as $record) {
                $data = $chunk[$record->getKey()];
                dump($data);
                $record->content_old = $data['content_old'];
                $record->content_new = $data['content_new'];
                $record->ended_at = $data['ended_at'];
                $record->published_at = now();
                $record->save();
            }
        }

    }
}
