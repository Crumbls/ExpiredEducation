<?php

namespace App\Filament\Resources\Facts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('content_old')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('content_new')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('version')
                    ->required()
                    ->numeric()
                    ->default(1),
                Select::make('parent_id')
                    ->relationship('parent', 'title'),
                DateTimePicker::make('started_at'),
                DateTimePicker::make('ended_at'),
                TextInput::make('started_at_format')
                    ->required()
                    ->default('Y'),
                TextInput::make('ended_at_format')
                    ->required()
                    ->default('Y'),
            ]);
    }
}
