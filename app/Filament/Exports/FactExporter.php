<?php

namespace App\Filament\Exports;

use App\Models\Fact;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class FactExporter extends Exporter
{
    protected static ?string $model = Fact::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('title'),
            ExportColumn::make('content_old'),
            ExportColumn::make('content_new'),
            ExportColumn::make('version'),
            ExportColumn::make('parent.title'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('started_at'),
            ExportColumn::make('ended_at'),
            ExportColumn::make('started_at_format'),
            ExportColumn::make('ended_at_format'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your fact export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
