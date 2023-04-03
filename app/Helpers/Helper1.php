<?php

namespace app\Helpers;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Helper1
{

    public static function unique_check($table_name, $field_name, $field_value)
    {
        $data = DB::table($table_name)->where($field_name, $field_value)->get();
        if (sizeof($data) == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function multi_check($table_name, $field_name)
    {
        $res = collect((array)json_decode($field_name));
        $data = DB::table($table_name)->where(
            function ($q) use ($res) {
                foreach ($res as $key => $values) {
                    $q->where($key, '=', $values);
                }
            }
        )->get();

        if (sizeof($data) == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function multi_get($table_name, $field_name)
    {

        $res = collect((array)json_decode($field_name));
        $data = DB::table($table_name)->where(
            function ($q) use ($res) {
                foreach ($res as $key => $values) {
                    $q->where($key, '=', $values);
                }
            }
        )->get();
        // dd($data);
        return $data;
    }
    public static function multi_get_order($table_name, $field_name,$order)
    {
        $res = collect((array)json_decode($field_name));
        $odr = collect((array)json_decode($order));
        $data = DB::table($table_name)->where(
            function ($q) use ($res) {
                foreach ($res as $key => $values) {
                    $q->where($key, '=', $values);
                }
            }
        )
        ->orderBy($odr[0],$odr[1] )
        ->get();

        return $data;
    }

    public static function id_generate($model,$field_name, $con, $len,$prefix)
    {
        $s = DB::table($model)->select('*')->orderBy('id', 'desc')->first();
        if (!$s) {
            $serialString = '';
            $date2 = date('Ym');
            $number = str_pad(++$serialString, $len, '0', STR_PAD_LEFT);
            return ($prefix.$date2.$number);
        } else {
            $dateget = $s->$field_name;
            $o_date = substr($dateget, 3, $len);

            $number2 = substr($dateget, -$len);
            if($con == 'month')
            {
            $o_month = DateTime::createFromFormat('Ym', $o_date)->format('m');
            }
            else
            {
                 $o_year = DateTime::createFromFormat('Ym', $o_date)->format('Y');
            }
            $n_date = date('Ym');
            if($con == 'month')
            {
                $n_month = date('m', strtotime($n_date));
                $number = (($n_month - $o_month) == 0 ? str_pad(++$number2, $len, '0', STR_PAD_LEFT) : str_pad(1, $len, '0', STR_PAD_LEFT));
            }
            else
            {
                $n_year = date('Y', strtotime($n_date));
                $number = (($n_year - $o_year) == 0 ? str_pad(++$number2, $len, '0', STR_PAD_LEFT) : str_pad(1, $len, '0', STR_PAD_LEFT));
            }
           return ($prefix.$n_date.$number);
        }
    }
    public static function image_upload($f_name,$prefix,$updated_name,$des_f,$w,$h)
    {
        $image = $f_name;
        $new_name = $prefix.'-'.$updated_name;
        $new_ext = $image->getClientOriginalExtension();
        $full_name = $new_name.'.'.$new_ext;

        $des = storage_path('app\\public\\'.$des_f.'\\'.$updated_name);
        if (!file_exists($des)) {
            mkdir($des, 666, true);
        }
        $realpath = $image->getRealPath();
        $imagefile = Image::make($realpath);
        $imagefile->resize($w,$h,function($con){
            $con->aspectRatio();
        })->save($des.'\\'.$full_name);
        return $full_name;
    }

    public static function multi_image_upload_2($file_name,$prefix,$pos,$updated_name,$des_f,$w,$h)
    {
        $file_string = "";
        foreach ($file_name as $key => $f_name) {
            $image = $f_name;
            $new_name = $prefix.'-'.$updated_name;
            $new_ext = $image->getClientOriginalExtension();
            $full_name = $new_name.'-'.$pos.'.'.$new_ext;
            $file_string .= $full_name.",";

            $des = storage_path('app\\public\\'.$des_f.'\\'.$updated_name);
            if (!file_exists($des)) {
                mkdir($des, 666, true);
            }
            $realpath = $image->getRealPath();
            $imagefile = Image::make($realpath);
            $imagefile->resize($w,$h,function($con){
                $con->aspectRatio();
            })->save($des.'\\'.$full_name);
            $pos++;
        }
        return $file_string;
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

            $des = storage_path('app\\public\\'.$des_f.'\\'.$updated_name);
            if (!file_exists($des)) {
                mkdir($des, 666, true);
            }
            $realpath = $image->getRealPath();
            $imagefile = Image::make($realpath);
            $imagefile->resize($w,$h,function($con){
                $con->aspectRatio();
            })->save($des.'\\'.$full_name);
        }
        return $file_string;
    }

    public static function update_image($update_table,$find_field,$update_g_id,$update_field,$return_path)
    {
        DB::table($update_table)
        ->where($find_field,$update_g_id)
        ->update([
            $update_field=>$return_path
        ]);
    }

    public static function unlink_image($update_type,$update_g_id,$image_name)
    {
        $check_path = 'app\\public\\'.$update_type.'\\'.$update_g_id.'\\'.$image_name;
        if(file_exists(storage_path($check_path)))
        {
            unlink((storage_path($check_path)));
        }
    }

    public static function remove_folder($type,$folder_name)
    {
        $path = 'app\\public\\'.$type.'\\'.$folder_name;
        if(file_exists(storage_path($path)))
        {
            File ::deleteDirectory(storage_path($path));
        }
    }
}
