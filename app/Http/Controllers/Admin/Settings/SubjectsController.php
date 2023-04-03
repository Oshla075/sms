<?php

namespace App\Http\Controllers\Admin\Settings;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
class SubjectsController extends Controller
{
    public function create(Request $request)
    {
        // $rule = [
        //     'sub_code'=> 'unique:subjects,sub_code'
        // ];

        // $v_data = $request->validate($rule);
        // $validator = Validator::make($request->all(),$rule,$c_msg);

        $x = Helper1::unique_check('subjects','sub_code',$request->sub_code);
        if($x==0)
        {
            if($request->sub_name != null && $request->sub_code != null)
            {
            DB::table('subjects')
            ->insert([
            "sub_id" => $request->sub_name,
            "sub_code" => $request->sub_code,
            ]);
            Alert::toast('Subject name successfully inserted.','success');
            return back();
            }
            else
            {
            Alert::toast('No Subject to insert','warning');
            return back();
            }
        }
        else
        {
            Alert::error('Subject Code Already Exists!');
            return back();
        }
    }

    public function subject_categories_create(Request $request)
    {
        if($request->sub_name != null)
        {
            DB::table('sub_categories')
            ->insert([
                "sub_name" => $request->sub_name,
            ]);
            Alert::toast('Subject Name '.$request->sub_name.' successfully inserted.','success');
            return back();
        }
        else
        {
            Alert::toast('No Subject to insert','warning');
            return back();
        }
    }

    public function getsubject_categories(Request $request)
    {
        $data = DB::table('sub_categories')->where('sub_name',$request->cls)->get();

        if(sizeof($data)==0)
        {
            return response()->json(0);
        }
        else
        {
            return response()->json(1);

        }
    }

    public function assign_teacher()
    {
        $t = DB::table('teachers')->get();
        return view('Admin.Pages.Settings.assign_teacher',compact('t'));
    }

    public function get_subject(Request $request)
    {
        $request = $request->query();
        $sub = DB::table('sub_categories as subc')
        ->select(
            'subc.*',
            's.*',
            's.id as s_id'
            )
        ->join('subjects as s','s.sub_id','subc.id')
        ->join('teachers as t','t.sp_sub','subc.id')
        ->where('t.id',$request['t_id'])
        // ->where('s.as_t',null)
        ->get();

        return response()->json($sub);
    }

    public function assign_teacher_insert(Request $request)
    {
        if($request->has('sub')==true)
        {
            foreach ($request->sub as $key => $value) {
                DB::table('subjects')
                ->where('id',$value)
                ->update([
                    'as_t'=>$request->tea_id
                ]);
            }
            return back();
        }
        else
        {
            return back();
        }

    }

    public function get_other_subject(Request $request)
    {
        $request = $request->query();
        $data = DB::table('sub_categories')
        ->whereNotIn('id',[$request['s_id']])
        ->where('sub_status',1)
        ->get();

        return response()->json($data);
    }

    public function get_other_subject_2(Request $request)
    {
        $sub = DB::table('sub_categories as subc')
        ->select(
            'subc.*',
            's.*',
            's.id as s_id'
            )
        ->join('subjects as s','s.sub_id','subc.id')
        ->join('teachers as t','t.sp_sub','subc.id')
        ->where('sub_id',$request['o_s'])
        ->get();

        return response()->json($sub);
    }


}

