<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class Class_FeesController extends Controller
{
    public function class_fees(Request $request)
    {
        DB::table('class_fees')
        ->insert([
           "c_id"=>$request->s_class,
            "year"=>$request->aca_year,
            "r_fees"=>$request->reg_fees,
            "t_fees"=>$request->tut_fees,
            "o_fees"=>$request->oth_fees
        ]);
        Alert::success('Fees details inserted successfully.');
        return back();
    }
}
