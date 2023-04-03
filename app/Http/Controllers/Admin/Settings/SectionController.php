<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class SectionController extends Controller
{
    public function create(Request $request)
    {
        if($request->sec_name != null && $request->sec_class != null && $request->sec_room != null)
        {
            DB::table('sections')
            ->insert([
                "s_name" => Str::upper($request->sec_name),
                "c_id" => (int)$request->sec_class,
                "r_id" => (int)$request->sec_room,

            ]);

            DB::table('rooms')
            ->where('id',(int)$request->sec_room)
            ->update([
                "r_status" =>1
            ]);
            Alert::toast('Section Name '.$request->sec_name.' has been inserted','success');
            return back();
        }

            if($request->sec_name == null){
                Alert::toast('Section Name is blank','warning');

            }
            elseif($request->sec_class == null){
                Alert::toast('Class Name is blank','warning');
            }
            elseif($request->sec_room == null){
                Alert::toast('Room No is blank','warning');
            }
            return back();


    }
    public function update(Request $request)
    {

        $section = DB::table('sections')
        ->select('s_name')
        ->where('s_name',Str::upper($request->update_sec_name))
        ->where('c_id',(int)$request->update_sec_class)
        ->get();
        if(sizeof($section) != 0)
        {
            Alert::warning('Section Name and Class Name Already Exists!');

        }
        else
        {
            DB::table('sections')
            ->where('id',(int)$request->update_id)
            ->update([
            "s_name" => Str::upper($request->update_sec_name),
            "c_id" => (int)$request->update_sec_class,
            ]);
            Alert::success('Section Name '.Str::upper($request->update_sec_name).' updated successfully');
        }
        return back();
    }
    public function update_room(Request $request)
    {
        $getstatus = DB::table('rooms')
        ->select('r_status')
        ->where('id',$request->update_sec_room)->first();
        if($getstatus->r_status==1)
        {
            Alert::warning('Room No. Already Exists!');
        }
        else
        {
            DB::table('rooms')
            ->where('id',(int)$request->update_r_id)
            ->update([
                "r_status" =>0
            ]);
            DB::table('rooms')
            ->where('id',(int)$request->update_sec_room)
            ->update([
                "r_status" =>1
            ]);
            DB::table('sections')
            ->where('id',(int)$request->update_id)
            ->update([
                "r_id" =>(int)$request->update_sec_room
            ]);
            $getroom = DB::table('rooms')
            ->select('r_no')
            ->where('id',$request->update_sec_room)->first();
            $getsection = DB::table('sections')
            ->select('s_name')
            ->where('id',$request->update_id)->first();
            Alert::success('Room No. '.$getroom->r_no.' of Section Name '.$getsection->s_name.' updated successfully');
        }
        return back();
    }
}
