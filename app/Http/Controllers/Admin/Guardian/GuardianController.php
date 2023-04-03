<?php

namespace App\Http\Controllers\Admin\Guardian;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;



class GuardianController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'g_photo'=> 'required|image|mimes:jpg,jpeg,png|max:2000'
        ];
        $c_msg = [
            'g_photo.required'=>'The field is required',
            'g_photo.mimes'=>'Only JPG, PNG and JPEG formats are allowed',
            'g_photo.max'=>'Only 2 MB file size allowed'
        ];

        $v_data = $request->validate($rules,$c_msg);

        $image = $request->file('g_photo');

        $multi_return_path ="";

        $parent_id =  Helper1::id_generate('guardians','g_id','year',6,'PAR');


        $return_path = Helper1::image_upload(
            $request->file('g_photo'),
            date('d-m-Y'),
            $parent_id,
            "parents",
            300,
            300
        );

        if($request->hasFile('g_doc'))
        {
            $multi_return_path = Helper1::multi_image_upload(
                $request->g_doc,
                date('d-m-Y'),
                $parent_id,
                "parents",
                300,
                300
            );
        }
        DB::table('guardians')
        ->insert([
            "g_name" => $request->g_name,
            "g_id"=>$parent_id,
            "g_gender" => $request->g_gender,
            "g_address" => $request->g_add,
            "g_post_office"=>$request->g_post_office,
            "g_pin_code" =>$request->g_pin,
            "g_contact_1" => $request->g_contact1,
            "g_contact_2" => $request->g_contact2,
            "g_photo"=>$return_path,
            "g_doc"=>$multi_return_path,
            "adh_no" => $request->g_card_no
        ]
        );
            Alert::success('Guardian Name '.$request->g_name.' Successfully inserted');
            return back();
    }

    public function update(Request $request)
    {
            DB::table('guardians')
            ->where('g_id',$request->update_g_id)
            ->update([
                "g_name" => $request->update_g_name,
                "g_gender" => $request->update_g_gender,
                "g_address" => $request->update_g_add,
                "g_post_office" => $request->update_g_post_office,
                "g_pin_code" => $request->update_g_pin,
                "g_contact_1" => $request->update_g_contact1,
                "g_contact_2" => $request->update_g_contact2
            ]);
        Alert::success('Guardian Name '.$request->update_g_name.' updated successfully');
        return back();
    }

    public function id_update(Request $request)
    {
        DB::table('guardians')
        ->where('g_id',$request->update_g_id)
        ->update([
            "adh_no"=>$request->update_g_card_no,
            'g_v_doc'=>'aadhaar',
        ]);
    Alert::success('Guardian Aadhaar No. updated successfully');
    return back();
    }

    public function edit($id)
    {
        // $d = "23.426.jpg";
        $query = DB::table('guardians')
        ->where('g_id',$id)
        ->get();
        $school = DB::table('systems')
        ->select('created_at')
        ->get();
        $estd = date('Y',strtotime($school[0]->created_at));
        return view('Admin.Pages.guardian_edit',compact('query','estd'));
    }

    public function delete(Request $request)
    {
        $query = $request->query();
        $g_id = $query['id'];

        $data = DB::table('students as s')
        ->select(
            's.student_id',
            'g.id'
            )
        ->join('guardians as g','g.id','s.g_id')
        ->where('g.g_id',$g_id)
        ->get();
        foreach ($data as $key => $value) {
            $student_id = $value->student_id;

            DB::table('students')
            ->where('student_id',$student_id)
            ->delete();
            DB::table('student_payments')
            ->where('stu_id',$student_id)
            ->delete();

            Helper1::remove_folder('students',$student_id);
        }

        Helper1::remove_folder('parents',$g_id);
        DB::table('guardians')
        ->where('g_id',$g_id)
        ->delete();

        return response()->json($query['id']);
    }

    public function getgurdetails(Request $request)
    {
        $query =$request->query();
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
    ->where('spay.s_year',$query['year'])
    ->get();
    return response()->json($item);
    }
}
