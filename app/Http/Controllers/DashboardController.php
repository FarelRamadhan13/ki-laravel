<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = collect([1,2,3,4,5,6, 'tes', 'tes1', 'tes2']);

        $filter = $data->filter(function ($val) {
            if(is_numeric($val))
                return $val < 4;

            return $val;
        })->values();

        return view('dashboard', ['username' => session()->get('users'), 'data' => $filter ]);
        // dd($filter);
    }
}
