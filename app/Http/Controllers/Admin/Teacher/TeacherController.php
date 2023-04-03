<?php

namespace App\Http\Controllers\Admin\Teacher;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{
    public function create(Request $request)
    {
        $rule = [
            't_photo'=> 'image|mimes:jpg,jpeg,png|max:20'
        ];
        $c_msg = [
            't_photo.required'=>'The field is required',
            't_photo.mimes'=>'Only JPG, PNG and JPEG formats are allowed',
            't_photo.max'=>'Only 20 KB file size allowed'
        ];

        $v_data = $request->validate($rule,$c_msg);

        $image = $request->file('t_photo');
        $return_path = Helper1::image_upload(
            $request->file('t_photo'),
            date('d-m-Y'),
            $request->t_id_no,
            "teachers",
            400,
            400
        );

        if($request->hasFile('t_doc'))
        {
            $multi_return_path = Helper1::multi_image_upload(
                $request->t_doc,
                date('d-m-Y'),
                $request->t_id_no,
                "teachers",
                300,
                300
            );
        }

        DB::table('teachers')
        ->insert([
           "t_id"=> $request->t_id_no,
            "t_adh_no"=> $request->t_card_no,
            "t_name"=>$request->t_name,
            "t_gender"=>$request->t_gender,
            "t_contact"=>$request->t_contact,
            "t_dob"=>$request->t_dob,
            "sp_sub"=>$request->sub_id,
            "t_photo"=>$return_path,
            "t_doc"=>$multi_return_path
        ]);
        Alert::success('Teacher Name '.$request->t_name.' Successfully Inserted');
       return back();
    }

    public function view()
    {
        $t = DB::table('teachers as t')
        ->select(
            '*',
            't.id as tea_id'
            )
        ->join('sub_categories as subc','t.sp_sub','subc.id')
        ->join('subjects as sub','sub.as_t','t.id')
        ->where('subc.sub_status',1)
        ->get()
        ->groupBy('t_id');

        $subject = DB::table('subjects')->get();
        $classes= DB::table('classes')->get();
        $sections = DB::table('classes as cs')
        ->select('sec.s_name','sec.id','cs.c_name')
        ->join('sections as sec','cs.id','sec.c_id')
        ->where('sec.t_ass',null)
        ->get();

        return view('Admin.Pages.view_teacher',compact('t','subject','classes','sections'));
    }

    public function edit($id)
    {
        $data = DB::table('teachers')
        ->where('t_id',$id)
        ->get();
        return view('Admin.Pages.teacher_edit',compact('data'));
    }

    public function update(Request $request)
    {
        DB::table('teachers')
            ->where('t_id',$request->update_t_id)
            ->update([
                "t_adh_no" => $request->update_t_card_no,
                "t_name"=>$request->update_t_name,
                "t_dob"=>$request->update_t_dob,
                "t_gender" => $request->update_t_gender,
                "t_contact" => $request->update_t_contact
            ]);
        Alert::success('Teacher Name '.$request->update_t_name.' updated successfully');
        return back();
    }

    public function other_sub_assign(Request $request)
    {
        $o_sub_id =  $request->o_sub;
        if($o_sub_id == null)
        {
            DB::table('teachers')
                ->where('id',$request->n_t_id)
                ->update([
                    "op_sub" =>null,
                ]);
            Alert::success('Other Subjects Reset Successfully');
            return back();
        }
        else
        {
            $str = implode(',',$o_sub_id );
            $new_o_sub_id = $str.',';
            DB::table('teachers')
                ->where('id',$request->n_t_id)
                ->update([
                    "op_sub" =>$new_o_sub_id,
                ]);
            Alert::success('Other Subjects Assigned Successfully');
            return back();
        }
    }

    public function assign_cls_teacher(Request $request)
    {
        DB::table('sections')
        ->where('id',$request->t_sec_assign)
        ->update([
            "t_ass"=>$request->t_id
        ]);
        Alert::success('Class and Section Assigned Successfully');
        return back();
    }
}
