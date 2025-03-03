<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    public function satu() {

        $members = DB::table('members')
                    ->select(['name', 'phone', 'wallet'])
                    // ->where(function ($query) {
                    //     $query->where('name', 'farel');
                    //     $query->orWhere('phone', '1111111');
                    // })
                    ->orderBy('name', 'desc')
                    ->paginate(5);
        
        // dd($members);
        return view('query-builder.satu', ['members' => $members]);
    }

    public function create(Request $request) {
        DB::table('members')->insert([
            'name' => fake()->name,
            'wallet' => '10000',
            'status' => '1',
            'phone' => '3333333'
        ]);

        return back();
    }

}
