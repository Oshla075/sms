<?php

namespace App\Http\Controllers\Admin;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;

class Maincontroller extends Controller
{
    public function index()
    {
        Alert::info('Welcome');
        return view('Admin.Pages.dashboard');
    }
    public function system()
    {
        $x = DB::table('systems')->get();
        return view('Admin.Pages.system', compact('x'));
    }
    public function section()
    {
        //join
        $data = DB::table('sections as s')
        ->select(
            's.c_id',
            's.r_id',
            's.s_name',
            's.id',
            'r.r_no',
            'c.c_name'
        )
        ->join('rooms as r','s.r_id','r.id')
        ->join('classes as c','s.c_id','c.id')
        ->orderBy('s.s_name','asc')
        ->get();

        // dd($data);

        $y = DB::table('classes')->get();
        $x= DB::table('rooms')->where('r_status',0)->get();
        $x1= DB::table('rooms')->get();
        return view('Admin.Pages.section',compact('y','x','data','x1'));
    }
    public function class()
    {
        $y = DB::table('classes')->get();
        return view('Admin.Pages.class',compact('y'));
    }
    public function subject_categories()
    {
        $y = DB::table('sub_categories')->get();
        return view('Admin.Pages.sub_categories',compact('y'));
    }
    public function subjects()
    {
        $s = DB::table('sub_categories as subc')
        ->select(
            'sub.sub_code',
            'subc.sub_name',
            'subc.sub_status',
            'subc.id as subc_id',
            )
        ->join('subjects as sub','sub.sub_id','subc.id')
        ->get();
        $y = DB::table('sub_categories as subc')
        ->where('subc.sub_status',1)
        ->get();
        return view('Admin.Pages.Settings.subjects',compact('s','y'));
    }
    public function room()
    {
        $y = DB::table('rooms')->get();
        return view('Admin.Pages.room',compact('y'));
    }

    public function chk_any(Request $request)
    {
        $res = Helper1::unique_check($request->t_n,$request->f_n,$request->f_v);
        return response()->json($res);
    }

    public function chk_any2(Request $request)
    {
        $res = Helper1::multi_check($request->t_n,$request->f_n);
        return response()->json($res);
    }

    public function get_any2(Request $request)
    {
        $res = Helper1::multi_get($request->t_n,$request->f_n);
        return response()->json($res);
    }
    public function get_any2_order(Request $request)
    {
        $res = Helper1::multi_get_order($request->t_n,$request->f_n,$request->order);
        return response()->json($res);
    }
    public function guardian()
    {
        $g = DB::table('guardians')->get();
        return view('Admin.Pages.addguardian',compact('g'));
    }
    public function student()
    {
        $y = DB::table('classes')->get();
        $student_id =  Helper1::id_generate('students','student_id','month',6,'STU');
        return view('Admin.Pages.addstudent',compact('y','student_id'));
    }
    public function test()
    {
        $product_id =  Helper1::id_generate('products','p_id','month',6,'PRO');
        $product_form = DB::table('p_form')->get();
        $disease = DB::table('diseases')->get();
        // $disease = DB::table('products as p')
        // ->select(
        //     '*',
        //     )
        // ->join('diseases as d','p.d_id','d.id')
        // ->get();
        return view('Admin.Pages.test',compact('product_id','product_form','disease'));
    }
    public function test1(Request $request)
    {
        // dd($request);
        $rules = [
            // 'image'=>'required|max:12|min:5'
            'image'=> 'required|image|mimes:jpg,jpeg,png|max:20'
        ];
        $c_msg = [
            'image.required'=>'The field is required',
            'image.mimes'=>'Only JPG, PNG and JPEG formats are allowed',
            'image.max'=>'Only 20 KB file size allowed'
            // 'image.max'=>'Maximum 12 Characters are allowed',
            // 'image.min'=>'Minimum 5 Characters are allowed',
        ];
        // $this->validate($request,$rules,$c_msg);
        $v_data = $request->validate($rules,$c_msg);
        // dd($v_data);
        return back()->with('success','inserted sucessfully');
    //    $student_id =  Helper1::id_generate('students','student_id','month',6,'STU');
    }
    public function class_fees()
    {
        $y = DB::table('classes')->get();
        return view('Admin.Pages.Settings.class_fees',compact('y'));
    }
    public function upload_image()
    {
        return view('Admin.Pages.test');
    }
    // public function insert_image(Request $request)
    // {
    //     $data = Storage::disk('public')->exists('parents/PAR202302000004/02-02-2023-PAR202302000004.jpg');
    //     // $b = array();
    //     $url = url('/storage/app/');
    //     if($data == true)
    //     {
    //       $data2 =  Storage::get('public/parents/PAR202302000004/','02-02-2023-PAR202302000004.jpg');
    //     }
    //     // dd($data2);
    //     // echo "<img src='parents/PAR202302000004/02-02-2023-PAR202302000004.jpg'>";
    //     // dd(Storage::disk('public')->file())
    // }
    public function insert_image(Request $request)
    {
            $rules = [
                'updated_g_photo'=> 'required|image|mimes:jpg,jpeg,png|max:20'
            ];
            $c_msg = [
                'updated_g_photo.required'=>'The field is required',
                'updated_g_photo.mimes'=>'Only JPG, PNG and JPEG formats are allowed',
                'updated_g_photo.max'=>'Only 20 KB file size allowed'
            ];

            // $v_data = $request->validate($rules,$c_msg, $c_msg);
            $validator = Validator::make($request->all(),$rules, $c_msg );

            if ($validator->fails()) {
                Alert::error('Image updation Failure');
                return back();
            }

            $image = $request->file('updated_g_photo');
            $new_updated_field = $request->update_field;
            // dd($image);

            $data = DB::table($request->update_table)
            ->select($request->update_field)
            ->where($request->find_field,$request->update_g_id)
            ->get();


            if($data[0]->$new_updated_field == null)
            {
                $return_path = Helper1::image_upload(
                    $request->file('updated_g_photo'),
                    date('d-m-Y'),
                    $request->update_g_id,
                    $request->update_type,
                    300,
                    300
                );
            Helper1::update_image(
                $request->update_table,
                $request->find_field,
                $request->update_g_id,
                $request->update_field,
                $return_path);
            }
            else
            {
                Helper1::unlink_image(
                    $request->update_type,
                    $request->update_g_id,
                    $data[0]->$new_updated_field);
                $return_path = Helper1::image_upload(
                    $request->file('updated_g_photo'),
                    date('d-m-Y'),
                    $request->update_g_id,
                    $request->update_type,
                    300,
                    300
                );
                Helper1::update_image(
                    $request->update_table,
                    $request->find_field,
                    $request->update_g_id,
                    $request->update_field,
                    $return_path);

            }
            Alert::success('Image Successfully Updated');
            return back();
    }

    public function data_fetch(Request $request)
    {
        $data = $request->query();
        $sec_id = $data['f_n'];
        $total_student = DB::table('students')->where('s_sec_id',$sec_id)
        ->count();
        $room_capacity = DB::table('rooms as r')
        ->select('r.r_capacity')
        ->join('sections as sec','sec.r_id','r.id')
        ->where('sec.id',$sec_id)
        ->get();
        // dd($total_student.' '.$room_capacity['r_capacity']);
        $r_c =  $room_capacity[0]->r_capacity;
        return response()->json($r_c - $total_student);
    }
    public function multi_data_remove($id,$all_doc,$g_id,$chk_id,$up_field,$tb,$dir)
    {
       $path =  str_replace($id.',','',$all_doc);
       Helper1::unlink_image(
        $dir,
        $g_id,
        $id);
        if($path == "")
        {
            $path = null;
        }
        Helper1::update_image(
            $tb,
            $chk_id,
            $g_id,
            $up_field,
            $path);
        Alert::success('Document Removed Successfully');
        return back();
    }
    public function edit_multi_docs(Request $request)
    {
        if($request->hasFile('update_g_doc'))
        {
            $multi_return_path = Helper1::multi_image_upload(
                $request->update_g_doc,
                date('d-m-Y'),
                $request->update_g_id,
                $request->des_f,
                300,
                300
            );

            Helper1::update_image(
                $request->update_table,
                $request->find_field,
                $request->update_g_id,
                $request->update_field,
                $multi_return_path);

        Alert::success('Documents Updated Successfully');
        return back();
        }
        else
        {
            Alert::error('Upload a Document to edit');
            return back();
        }
    }

    public function edit_multi_docs_2(Request $request)//Guardian Multi Doc Edit
    {
        $update_field = $request->goal_field;
       $doc = DB::table($request->tb_name)
        ->select($request->goal_field)
        ->where($request->search_field,$request->id)
        ->get();

        $sub = Str::substr($doc[0]->$update_field,0,Str::length($doc[0]->$update_field)-1);
        $b = explode(',',$sub);
        $d = ($b[(sizeof($b)-1)]);
        $pos = (strrpos($d,'.')-1);
        $sub_str = (int)substr($d,$pos,1);


        if($request->hasFile('update_g_doc'))
        {
            $multi_return_path = Helper1::multi_image_upload_2(
                $request->update_g_doc,
                date('d-m-Y'),
                $sub_str + 1,
                $request->id,
                "parents",
                300,
                300
            );

            Helper1::update_image(
                $request->tb_name,
                $request->search_field,
                $request->id,
                $request->goal_field,
                $doc[0]->$update_field.$multi_return_path);

        Alert::success('Documents Updated Successfully');
        return back();
        }
        else
        {
            Alert::error('Upload a Document to edit');
            return back();
        }
    }

    public function edit_multi_docs_3(Request $request)//Student Multi Doc Edit
    {
        $update_field = $request->goal_field;
       $doc = DB::table($request->tb_name)
        ->select($request->goal_field)
        ->where($request->search_field,$request->id)
        ->get();

        $sub = Str::substr($doc[0]->$update_field,0,Str::length($doc[0]->$update_field)-1);
        $b = explode(',',$sub);
        $d = ($b[(sizeof($b)-1)]);
        $pos = (strrpos($d,'.')-1);
        $sub_str = (int)substr($d,$pos,1);

        if($request->hasFile('update_g_doc'))
        {
            $multi_return_path = Helper1::multi_image_upload_2(
                $request->update_g_doc,
                date('d-m-Y'),
                $sub_str + 1,
                $request->id,
                "students",
                300,
                300
            );

            Helper1::update_image(
                $request->tb_name,
                $request->search_field,
                $request->id,
                $request->goal_field,
                $doc[0]->$update_field.$multi_return_path);

        Alert::success('Documents Updated Successfully');
        return back();
        }
        else
        {
            Alert::error('Upload a Document to edit');
            return back();
        }
    }

    public static function multi_image_upload($file_name,$prefix,$updated_name,$des_f,$w,$h)
    {
        $file_string = "";
        foreach ($file_name as $key => $f_name) {
            $image = $f_name;
            $new_name = $prefix.'-'.$updated_name;
            $new_ext = $image->getClientOriginalExtension();
            $full_name = $new_name.'-'.$key.'.'.$new_ext;
            $file_string .= $full_name.",";

            // $des = storage_path('app\\public\\'.$des_f.'\\'.$updated_name);
            // if (!file_exists($des)) {
            //     mkdir($des, 666, true);
            // }
            // $realpath = $image->getRealPath();
            // $imagefile = Image::make($realpath);
            // $imagefile->resize($w,$h,function($con){
            //     $con->aspectRatio();
            // })->save($des.'\\'.$full_name);
        }
        // return $file_string;
    }

    public function vehicles()
    {
        $v = DB::table('vehicles')->get();
        return view('Admin.Pages.Settings.vehicles',compact('v'));
    }

    public function teacher()
    {
        $y = DB::table('sub_categories')->get();
        $teacher_id =  Helper1::id_generate('teachers','t_id','month',6,'TEA');
        return view('Admin.Pages.add_teacher',compact('teacher_id','y'));
    }

    public function generate_stu_roll(Request $request)
    {
        $request = $request->query();
        $class = DB::table('classes')->get();
        $student = DB::table('student_payments as spay')
        ->select('spay.s_cls_id',
                'spay.s_sec_id',
                'spay.s_year',
                'spay.s_roll',
                'c.id',
                'c.c_name',
                'sec.id',
                'sec.s_name',
                's.s_name as stu_name',
                's.student_id'
        )
        ->join('students as s','s.student_id','spay.stu_id')
        ->join('classes as c','c.id','s.s_cls_id')
        ->join('sections as sec','sec.id','s.s_sec_id')
        ->where('spay.s_year',$request['year'])
        ->where('spay.s_cls_id',$request['cls'])
        ->where('spay.s_sec_id',$request['sec'])
        ->get();
        return response()->json($student);
    }

    public function gen_roll()
    {
        $class = DB::table('classes')->get();
        return view('Admin.Pages.Settings.student_roll_generate',compact('class'));

    }

    public function roll_form_submit(Request $request)
    {
        $query = DB::table('student_payments')
        ->select('s_roll')
        ->where('s_roll','<>',null)
        ->orderBy('id','desc')
        ->first();
        if ($query->s_roll == null)
        {
            $c = 1;
            foreach ($request->s_ids as $key => $value) {
                DB::table('student_payments')
                ->where('s_cls_id',$request->cls_id)
                ->where('s_sec_id',$request->sec_id)
                ->where('stu_id',$value)
                ->where('s_year',$request->year)
                ->update([
                   "s_roll"=>$c
                ]);
                $c++;
            }
            return back();
        }
        else
        {
            $c = (int)$query->s_roll + 1;
            foreach ($request->s_ids as $key => $value) {
                DB::table('student_payments')
                ->where('s_cls_id',$request->cls_id)
                ->where('s_sec_id',$request->sec_id)
                ->where('stu_id',$value)
                ->where('s_year',$request->year)
                ->update([
                   "s_roll"=>$c
                ]);
                $c++;
            }
        }
    }

    public function excel_view()
    {
        return view('Admin.excel');
    }
}
