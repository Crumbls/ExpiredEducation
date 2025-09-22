<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListFactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $records = $this->getRecords();

        return view('fact.list', [
            'records' => $records,
        ]);
    }

    protected function getRecords(): Collection
    {
        $cacheKey = __METHOD__;

        return Cache::remember($cacheKey, Carbon::now()->endOfYear(), function () {

            $records = Fact::take(1000)
                ->with(['tags'])
                ->whereNotNull('published_at')
                ->orderBy('ended_at', 'desc')
                ->get();

            return $records;
        });
    }
}
