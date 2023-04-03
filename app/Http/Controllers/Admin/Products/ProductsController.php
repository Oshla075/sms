<?php

namespace App\Http\Controllers\Admin\Products;

use app\Helpers\Helper2;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
// use App\Exports\ExportUser;
use App\Models\User;

class ProductsController extends Controller
{
    public function add_product(Request $request)
    {
        DB::table('products')
        ->insert([
            "p_id" => $request->p_id,
            "p_name"=>$request->p_name,
            "p_form_id"=>$request->p_form,
            "d_id"=>$request->d_id,
            "p_vol"=>$request->vol
        ]);
        $id = DB::table('products')
        ->select('id')
        ->where('p_id',$request->p_id)
        ->first();
        foreach ($request->strenhide as $key => $value) {
            DB::table('products_details')
            ->insert([
                "p_id"=>$id->id,
                "strength"=>$value,
                "volume"=>$request->volhide[$key],
                "count"=>$request->counthide[$key],
                "mrp"=>null,
                "discount"=>null,
                "price"=>$request->price[$key],
                "r_price"=>$request->r_price[$key]
            ]);
        }
        return back();
    }
    public function search_product()
    {
        $products =  DB::table('products')->get();
        return view('Admin.Pages.products_search',compact('products'));
    }

    public function product_details(Request $request)
    {
        $request = $request->query();
        $p = DB::table('products')
        ->where('id',$request['p_id'])
        ->get();

        $strength = DB::table('products_details')
        ->select(DB::raw('distinct strength'))
        ->where('p_id',$request['p_id'])
        ->get();

        $volume = DB::table('products_details')
        ->select(DB::raw('distinct volume'))
        ->where('p_id',$request['p_id'])
        ->get();

        $count = DB::table('products_details')
        ->select(DB::raw('distinct count'))
        ->where('p_id',$request['p_id'])
        ->get();
        // dd($p);
        return view('Admin.Pages.products_filter',compact('p','strength','volume','count'));
    }

    public function add_p_form()
    {
        return view('Admin.Pages.add_product_form');
    }
    public function insert_p_form(Request $request)
    {
        DB::table('p_form')
        ->insert([
            "p_form"=>$request->p_form
        ]);
        Alert::success('Product Form Successfully Inserted');
        return back();
    }

    public function add_disease()
    {
        return view('Admin.Pages.add_disease');
    }

    public function insert_disease(Request $request)
    {
        DB::table('diseases')
        ->insert([
            "d_name"=>$request->d_name
        ]);
        Alert::success('Disease Name Successfully Inserted');
        return back();
    }

    public function importView(Request $request){
        return view('importFile');
    }


    // It takes data from the excel variation wise
    public function import(Request $request){
        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        // Helper2::create_table('custom_products',$data[0][0],$data[0][1],$data[0][2]);
        // $c = 1;
        foreach ($data as $key => $value) {
            $count0 = 0;
            $count1 = 1;
            $count2 = 2;
            $count3 = 3;
            $count4 = 4;
            $count5 = 5;
            $count6 = 6;
            if($key!=0)
            {
                $hcn= $data[$key][0];
                $p_name= $data[$key][1];
                $str = $data[$key][2];
                $vol = explode('-',$data[$key][3]);
                $count= explode('-',$data[$key][4]);
                $price= explode('-',$data[$key][5]);
                $cat= $data[$key][6];

                $p = 0;
                if(sizeof($vol)*sizeof($count) == sizeof($price))
                {
                    // foreach ($str as $key => $st) {
                        foreach ($vol as $k1 => $v) {
                            foreach ($count as $k2 => $cou) {

                                // echo "<pre>";
                                // print_r($hcn." - ". $p_name." - ".$str." - ".$v." - ".$cou." - ".$price[$p]." - ".$cat);
                                // echo "</pre>";
                                DB::table('products2')
                                ->insert([
                                    $data[0][$count0] =>$hcn,
                                    $data[0][$count1] =>$p_name,
                                    $data[0][$count2] =>$str,
                                    $data[0][$count3] =>$v,
                                    $data[0][$count4] =>$cou,
                                    $data[0][$count5] =>$price[$p],
                                    $data[0][$count6] =>$cat,
                                    // $data[0][$count3] =>,
                                ]);
                                $p++;
                            }
                        }
                    // }
                }


                // echo "<pre>";
                // print_r($data3);
                // echo "</pre>";


            }

        }

        return redirect()->back();
    }

    public function import2(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach ($data as $key => $value) {
               DB::table('medicines')
            ->insert([
                "GPI"=>$value[0],
                "GCN"=>$value[1],
                "Group"=>$value[2],
                "Drug_Generic"=>$value[3],
                "Strength"=>$value[4],
                "Drug_Brand"=>$value[5],
                "Categories"=>$value[6],
                "form"=>$value[7],
                "1mo_Price"=>($value[8]!='' || $value[8]!='-')?$value[8]:null,
                "1mo_Qty"=>($value[9]!='' || $value[9]!='-')?$value[9]:null,
                "1mo_Retail"=>($value[10]!='' || $value[10]!='-')?$value[10]:null,
                "3mo_Price"=>($value[11]!='' || $value[11]!='-')?$value[11]:null,
                "3mo_Qty"=>($value[12]!='' || $value[12]!='-')?$value[12]:null,
                "3mo_Retail"=>($value[13]!='' || $value[13]!='-')?$value[13]:null,
                "6mo_Price"=>($value[14]!='' || $value[14]!='-')?$value[14]:null,
                "6mo_Qty"=>($value[15]!='' || $value[15]!='-')?$value[15]:null,
                "6mo_Retail"=>($value[16]!='' || $value[16]!='-')?$value[16]:null,
                "Status"=>($value[17]!='' || $value[17]!='-')?$value[17]:null,
            ]);

        }
        Alert::success('Records inserted successfully');
        return redirect()->back();
    }

    public function addproduct2()
    {
        return view('Admin.Pages.add_product2');
    }

}
