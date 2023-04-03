<?php

namespace app\Helpers;

use DateTime;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\Facades\Image;

class Helper2
{
    public static function create_table($table_name,$col1,$col2,$col3)
    {
        if(!Schema::hasTable($table_name))
        {
            Schema::create($table_name,function (Blueprint $table) use($col1,$col2,$col3){
                $table->integer('id',true);
                $table->string($col1,200);
                $table->string($col2,200);
                $table->string($col3,200);
            }
        );
        }
    }

}

?>
