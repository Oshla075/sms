<?php

namespace App\Http\Controllers\Admin\Settings;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ClassController extends Controller
{
    public function create(Request $request)
    {
        // dd($request);
        if($request->c_name != null)
        {
            DB::table('classes')
            ->insert([
                "c_name" => Str::upper($request->c_name),
            ]);
            Alert::toast('Dear '.$request->c_name.' You Have Sucessfully','success');
            return back();
        }
        else
        {
            Alert::toast('No Data to insert','warning');
            return back();
        }
    }
    public function getClass(Request $request)
    {
        $data = DB::table('classes')->where('c_name',Str::upper($request->cls))->get();
        // return response()->json();


        if(sizeof($data)==0)
        {
            return response()->json(0);
        }
        else
        {
            return response()->json(1);

        }

    }
    public function update(Request $request)
    {
        $x = Helper1::unique_check('classes','c_name',$request->update_c_name);
        if ($x==0)
        {
        DB::table('classes')
        ->where('id',$request->update_id)
        ->update([
            "c_name" => $request->update_c_name,
        ]);
        Alert::success('Class Name '.$request->update_c_name.' updated successfully');
        } else
        {
            Alert::error('Class Name Already Exists!');
        }
        return back();
    }
}
