<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ViewYearController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $year = $request->year;
        $records = $this->getRecords($year);

        return view('year.view', [
            'records' => $records,
            'year' => $year,
        ]);
    }

    protected function getRecords(int $year): Collection
    {
        $cacheKey = __METHOD__.'::'.$year;

        return Cache::remember($cacheKey, Carbon::now()->endOfYear(), function () use ($year) {

            $records = $year > now()->format('Y') ? collect([]) : Fact::published()
                ->take(10000)
                ->with(['tags'])
                ->whereYear('ended_at', '>=', $year)
                ->orderBy('ended_at', 'desc')
                ->get();

            return $records;
        });
    }
}
