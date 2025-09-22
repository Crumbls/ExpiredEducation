<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use Illuminate\Http\Request;

class ViewFactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Fact $fact)
    {
        abort_if(! $fact || ! $fact->exists, 404);

        $fact->load('tags');

        return view('fact.view', [
            'record' => $fact,
        ]);
    }
}
