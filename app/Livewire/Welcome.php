<?php

namespace App\Livewire;

use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Welcome extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getYears(): array
    {
        return Cache::remember(__METHOD__, Carbon::now()->endOfYear(), function () {
            $now = Carbon::now();

            $currentYear = $now->year;

            $currentCentury = intdiv($currentYear - 1, 100) + 1;

            $previousCentury = $currentCentury - 1;

            $firstYearPreviousCentury = ($previousCentury - 1) * 100 + 1;

            $years = range($firstYearPreviousCentury, date('Y'));

            rsort($years);

            $years = array_combine(array_map('strval', $years), array_map('strval', $years));

            return $years;
        });

    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('year')
                    ->label('What year did you graduate?')
                    ->placeholder('eg. 2002')
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->options($this->getYears()),
            ])
            ->statePath('data');
    }

    public function submit(): Redirector
    {
        $year = Arr::get($this->form->getState(), 'year');
        $year = $year ?? Carbon::now()->addYears(-18)->format('Y');

        return redirect()->route('year.view', $year);
    }

    public function render()
    {
        return view('livewire.welcome')
            ->layout('components.app-layout');
    }
}
