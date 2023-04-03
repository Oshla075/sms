<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VehiclesController extends Controller
{
    public function create(Request $request)
    {
        DB::table('vehicles')
        ->insert([
         "v_name" =>$request->v_name
        ]);
       Alert::success('Vehicle Name '.$request->v_name.' Successfully Inserted');
       return back();
    }
}
