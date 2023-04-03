<?php

namespace App\Http\Controllers\Admin\Settings;

use app\Helpers\Helper1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    public function create(Request $request)
    {
        // dd($request);
        $rule = [
            's_logo'=> 'required|image|mimes:jpg,jpeg,png|max:20'
        ];

        $c_msg = [
            's_logo.required'=>'The field is required',
            's_logo.mimes'=>'Only JPG, PNG and JPEG formats are allowed',
            's_logo.max'=>'Only 20 KB file size allowed'
        ];

        $v_data = $request->validate($rule,$c_msg);

        $return_path = Helper1::image_upload(
            $request->file('s_logo'),
            date('d-m-Y'),
            '1',
            'schools',
            300,
            300
        );

        DB::table('systems')
        ->insert([
            "sys_logo" => $request->s_logo,
            "sys_name" => $request->s_name,
            "sys_add" => $request->s_add,
            "sys_contact1" => $request->s_contact1,
            "sys_contact2" => $request->s_contact2,
            "sys_contact3" => $request->s_contact3,
            "sys_type" => $request->s_type,
            "sys_body" => $request->s_body,
            "sys_mail" => $request->s_mail,
            "sys_logo"=> $return_path,
            "sys_web_address" => $request->s_web_address,
            "sys_social_link" => $request->s_social_link
        ]
        );

        Alert::success('School Details Successfully Inserted');

        return back();
    }
    public function update(Request $request)
    {
        // dd($request);
        $rule = [
            's_logo'=> 'required|image|mimes:jpg,jpeg,png|max:20'
        ];

        $c_msg = [
            's_logo.required'=>'The field is required',
            's_logo.mimes'=>'Only JPG, PNG and JPEG formats are allowed',
            's_logo.max'=>'Only 20 KB file size allowed'
        ];

            $v_data = $request->validate($rule,$c_msg);

            $image = $request->file('s_logo');

            $new_updated_field = $request->update_field;

            $data = DB::table('systems')
            ->select($request->update_field)
            ->where('id',$request->s_id)
            ->get();


            if($data[0]->$new_updated_field == null)
            {
                $return_path = Helper1::image_upload(
                    $request->file('s_logo'),
                    date('d-m-Y'),
                    $request->s_id,
                    'schools',
                    300,
                    300
                );
            Helper1::update_image(
                'systems',
                'id',
                $request->s_id,
                $new_updated_field,
                $return_path);
            }
            else
            {
                Helper1::unlink_image(
                    'schools',
                    $request->s_id,
                    $data[0]->$new_updated_field);

                $return_path = Helper1::image_upload(
                    $request->file('s_logo'),
                    date('d-m-Y'),
                    $request->s_id,
                    'schools',
                    300,
                    300
                );
                Helper1::update_image(
                    'systems',
                    'id',
                    $request->s_id,
                    $new_updated_field,
                    $return_path);
            }


        DB::table('systems')
        ->where('id', $request-> s_id)
        ->update([
            "sys_name" => $request->s_name,
            "sys_add" => $request->s_add,
            "sys_contact1" => $request->s_contact1,
            "sys_contact2" => $request->s_contact2,
            "sys_contact3" => $request->s_contact3,
            "sys_type" => $request->s_type,
            "sys_body" => $request->s_body,
            "sys_mail" => $request->update_s_mail,
            "sys_web_address" => $request->s_web_address,
            "sys_social_link" => $request->s_social_link
        ]);
        Alert::success('School Details Successfully updated');

        return back();
    }
}
