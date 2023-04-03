<?php

namespace App\Http\Controllers\Admin\Settings;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class RoomController extends Controller
{
    public function create(Request $request)
    {
        if ($request->r_no != null && $request->r_capacity != null) {
            DB::table('rooms')
                ->insert([
                    "r_no" => $request->r_no,
                    "r_capacity" => $request->r_capacity,
                ]);
            Alert::toast('Room No ' . $request->r_no . ' has been inserted', 'success');
            return back();
        } else {
            Alert::toast('No Data to insert', 'warning');
            return back();
        }
    }
    public function getRoom(Request $request)
    {
        $data = DB::table('rooms')->where('r_no', $request->rm)->get();
        // return response()->json();
        if (sizeof($data) == 0) {
            return response()->json(0);
        } else {
            return response()->json(1);
        }
    }
    public function update(Request $request)
    {


        $x = Helper1::unique_check('rooms', 'r_no', $request->update_r_no);
        if ($x == 0) {
            //room not exits
            DB::table('rooms')
            ->where('id', $request->update_id)
            ->update([
                "r_no" => $request->update_r_no,
            ]);
            if($request->update_r_capacity != null)
            {
                DB::table('rooms')
                ->where('id', $request->update_id)
                ->update([
                    "r_capacity" => $request->update_r_capacity,
                ]);
            }
            Alert::success('Room no & Capacity updated successfully');
            return back();

        }
        else
        {
            //room exist
            if($request->update_r_capacity != null)
            {
                DB::table('rooms')
                ->where('id', $request->update_id)
                ->update([
                    "r_capacity" => $request->update_r_capacity,
                ]);
            }
            Alert::success('Room Capacity updated successfully');
            return back();

        }
    }
}
