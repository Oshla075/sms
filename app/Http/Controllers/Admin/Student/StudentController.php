<?php

namespace App\Http\Controllers\Admin\Student;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function create(Request $request)
    {
        $rule = [
            's_photo'=> 'image|mimes:jpg,jpeg,png|max:20'
        ];
        $c_msg = [
            's_photo.required'=>'The field is required',
            's_photo.mimes'=>'Only JPG, PNG and JPEG formats are allowed',
            's_photo.max'=>'Only 20 KB file size allowed'
        ];

        $v_data = $request->validate($rule,$c_msg);

        $image = $request->file('s_photo');
        $return_path = Helper1::image_upload(
            $request->file('s_photo'),
            date('d-m-Y'),
            $request->stu_id_no,
            "students",
            400,
            400
        );

        if($request->hasFile('s_doc'))
        {
            $multi_return_path = Helper1::multi_image_upload(
                $request->s_doc,
                date('d-m-Y'),
                $request->stu_id_no,
                "students",
                300,
                300
            );
        }


       DB::table('students')
       ->insert([
        "s_adh_no" =>$request->stu_card_no,
        "s_name"=>  $request->stu_name,
        "s_contact"	=> $request->stu_contact1,
        "g_id" => $request->gurdian_id,
        "s_address"	=>  $request->stu_add,
        "s_post_office"	=>  $request->stu_post_office,
        "s_pin_code"=>  $request->stu_pin,
        "s_dob"	=>  $request->stu_dob,
        "s_cls_id"=>  $request->stu_class,
        "s_sec_id"	=>  $request->stu_section,
        "s_roll"=>  $request->stu_roll,
        "s_photo"=>$return_path,
        "s_doc"=>$multi_return_path,
        "student_id"=>  $request->stu_id_no,
        "s_gender"=>$request->s_gender
       ]);

       DB::table('student_payments')
       ->insert([
        "stu_id" => $request->stu_id_no,
        "s_cls_id" =>$request->stu_class,
        "s_sec_id" =>$request->stu_section,
        "s_roll" =>$request->stu_roll,
        "s_year" =>date('Y'),
        "s_r_fees" =>$request->stu_r_fees,
        "s_t_fees" =>$request->stu_t_fees,
        "s_o_fees" =>$request->stu_o_fees
       ]);
       Alert::success('Student Name '.$request->stu_name.' Successfully Inserted');
       return back();
    }
    public function student_view()
    {
        $y = DB::table('classes')->get();
       return view('Admin.Pages.student_view',compact('y'));
    }
    public function student_list(Request $request)
    {
        $request = $request->query();
        $a = [
            'cls'=>$request['stu_class'],
            'sec'=>$request['stu_section'],
            'year'=>$request['aca_year'],
        ];

        // $qu = http_build_query(array('key'=>$a));
        $qu = urlencode(serialize($a));

        // $z = unserialize(urldecode($qu));
        if($request['stu_class'] != null && $request['stu_section'] != null && $request['aca_year'] != null)
        {
            $data =  DB::table('students as s')
            ->select([
            's.student_id',
            's.id',
            's.s_sec_id',
            's.s_name',
            'c.c_name',
            'sec.s_name as sec_name',
            's.s_contact',
            's.s_adh_no',
            's.s_gender',
            's.s_cls_id',
            's.s_roll',
            's.s_address',
            's.s_post_office',
            's.s_pin_code',
            's.s_dob',
            's.s_photo',
            'g.g_name',
            'g.g_contact_1',
            'g.g_address',
            'g.g_post_office',
            'g.g_pin_code',
            'g.g_v_doc',
            'g.adh_no',
            'spay.s_r_fees',
            'spay.s_t_fees',
            'spay.s_o_fees',
            'spay.s_year'
        ])
        ->join('classes as c','s.s_cls_id','c.id')
        ->join('sections as sec','s.s_sec_id','sec.id')
        ->join('guardians as g','s.g_id','g.id')
        ->join('student_payments as spay','s.student_id','spay.stu_id')
        ->where('spay.s_year',$request['aca_year'])
        ->where('c.id',$request['stu_class'])
        ->where('sec.id',$request['stu_section'])
        ->get();


        $class = DB::table('classes')->get();
        $section = null;
        if(sizeof($data) == null)
        {
            $section = null;
        }
        else
        {
        $section = DB::table('sections')->where('c_id',$data[0]->s_cls_id)->orderBy('s_name','asc')->get();
        }
        return view('Admin.Pages.student_list',compact('data','class','section','qu'));
        }
        else
        {
            return back();
        }
    }
    public function update(Request $request)
    {
        $new_dob = Carbon::createFromFormat('d/m/Y', $request->stu_dob)->format('Y/m/d');
        $years = Carbon::parse($new_dob)->diff(Carbon::now());
        // $years = Carbon::parse($new_dob)->diff(Carbon::parse('2023/01/01'));
        // dd($years);
        // dd(date("l",strtotime('2023/02/17')));


        DB::table('students')
        ->where('student_id',$request->update_student_id)
        ->update([
            "s_adh_no" => $request->update_stu_card_no,
            "s_name"=>$request->update_stu_name,
            "s_gender"=>$request->update_s_gender,
            "s_contact"=>$request->update_stu_contact1,
            "s_address"=>$request->update_stu_add,
            "s_post_office"=>$request->update_stu_post_office,
            "s_pin_code"=>$request->update_stu_pin,
            "s_dob"=>$request->stu_dob,
            // "s_cls_id"=>$request->update_stu_class,
            // "s_sec_id"=>$request->update_stu_section,
            "s_roll"=>$request->update_stu_roll
        ]);

        DB::table('student_payments')
        ->where('stu_id',$request->update_student_id)
        ->update([
            // "s_cls_id"=>$request->update_stu_class,
            // "s_sec_id"=>$request->update_stu_section,
            "s_roll"=>$request->update_stu_roll,
            // "s_t_fees"=>$request->update_stu_t_fees,
            // "s_o_fees"=>$request->update_stu_o_fees
        ]);

        // $y = DB::table('classes')->get();
        // return view('Admin.Pages.student_view',compact('y'));

        Alert::success('Student Name '.$request->update_stu_name.' updated successfully');
        return back();
    }

    public function update_class(Request $request)
    {
        DB::table('students')
        ->where('student_id',$request->update_student_id)
        ->update([
            "s_cls_id"=>$request->update_stu_class,
            "s_sec_id"=>$request->update_stu_section,
        ]);

        DB::table('student_payments')
        ->where('stu_id',$request->update_student_id)
        ->update([
            "s_cls_id"=>$request->update_stu_class,
            "s_sec_id"=>$request->update_stu_section,
            "s_t_fees"=>$request->update_stu_t_fees,
            "s_o_fees"=>$request->update_stu_o_fees
        ]);
        Alert::success('Class and Fees updated successfully');
        $y = DB::table('classes')->get();
        return view('Admin.Pages.student_view',compact('y'));
    }

    public function edit($id,$data)
    {
        $z = unserialize(urldecode($data));
        $item =  DB::table('students as s')
        ->select([
        's.student_id',
        's.id',
        's.s_sec_id',
        's.s_name',
        'c.c_name',
        'sec.s_name as sec_name',
        's.s_contact',
        's.s_adh_no',
        's.s_gender',
        's.s_cls_id',
        's.s_roll',
        's.s_doc',
        's.s_address',
        's.s_post_office',
        's.s_pin_code',
        's.s_dob',
        's.s_photo',
        'g.g_name',
        'g.g_contact_1',
        'g.g_address',
        'g.g_post_office',
        'g.g_pin_code',
        'g.g_v_doc',
        'g.adh_no',
        'spay.s_r_fees',
        'spay.s_t_fees',
        'spay.s_o_fees',
        'spay.s_year'
    ])
    ->join('classes as c','s.s_cls_id','c.id')
    ->join('sections as sec','s.s_sec_id','sec.id')
    ->join('guardians as g','s.g_id','g.id')
    ->join('student_payments as spay','s.student_id','spay.stu_id')
    ->where('spay.s_year',$z['year'])
    ->where('c.id',$z['cls'])
    ->where('sec.id',$z['sec'])
    ->where('s.student_id',$id)
    ->get();
    // dd($item);

    $class = DB::table('classes')->get();
    $section = DB::table('sections')->where('c_id',$z['cls'])->orderBy('s_name','asc')->get();

        return view('Admin.Pages.student_edit',compact('item','class','section'));

    }

    public function delete(Request $request)
    {
        $query = $request->query();
        Helper1::remove_folder('students',$query['id']);

        // DB::table('students')
        // ->where('student_id',$query['id'])
        // ->delete();
        // DB::table('student_payments')
        // ->where('stu_id',$query['id'])
        // ->delete();
        return response()->json($query['id']);
    }

    public function getqual($id)
    {
        return view('Admin.Pages.student_details');
    }

    public function student_attendance()
    {
        $y = DB::table('classes')->get();
        return view('Admin.Pages.student_attendance',compact('y'));
    }
}
