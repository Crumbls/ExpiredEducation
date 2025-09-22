<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
            'year' => $year
        ]);
    }

    protected function getRecords(int $year) : Collection {
        $cacheKey = __METHOD__.'::'.$year;

        return Cache::remember($cacheKey,  Carbon::now()->endOfYear(), function() use ($year) {
            $records = Fact::published()
                ->take(10000)
                ->with(['tags'])
                ->whereYear('ended_at', '>=', $year)
                ->orderBy('ended_at', 'desc')
                ->get();
            return $records;
        });
    }
}
