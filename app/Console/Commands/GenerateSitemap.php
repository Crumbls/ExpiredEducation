<?php

namespace App\Console\Commands;

use App\Models\Fact;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();

        // Add homepage
        $sitemap->add(
            Url::create('/')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9)
        );

        // Add timeline page
        $sitemap->add(
            Url::create('/timeline')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );

        // Add year pages that actually have facts
        $yearsWithFacts = Fact::published()
            ->selectRaw("strftime('%Y', ended_at) as year, MAX(updated_at) as last_updated, COUNT(*) as fact_count")
            ->whereNotNull('ended_at')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        $this->info("Adding {$yearsWithFacts->count()} year pages with content...");

        foreach ($yearsWithFacts as $yearData) {
            $sitemap->add(
                Url::create("/{$yearData->year}")
                    ->setLastModificationDate(\Carbon\Carbon::parse($yearData->last_updated))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7)
            );
        }

        // Add individual fact pages
        $facts = Fact::published()->get(['id', 'updated_at']);

        $this->info("Adding {$facts->count()} fact pages...");

        foreach ($facts as $fact) {
            $sitemap->add(
                Url::create("/facts/{$fact->id}")
                    ->setLastModificationDate($fact->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully at '.public_path('sitemap.xml'));
    }
}
