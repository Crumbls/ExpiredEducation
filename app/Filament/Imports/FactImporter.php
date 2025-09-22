<?php

namespace App\Filament\Imports;

use App\Models\Fact;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class FactImporter extends Importer
{
    protected static ?string $model = Fact::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('content_old')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('content_new')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('ended_at')
                ->rules(['datetime'])
        ];
    }

    public function resolveRecord(): Fact
    {
        dd($this->data);
        return Fact::firstOrNew([
            'id' => $this->data['id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your fact import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
