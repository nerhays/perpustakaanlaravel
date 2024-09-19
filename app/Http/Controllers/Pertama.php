<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pertama extends Controller
{
    public function Get_Data_User(){
        $hasil = DB::table('user')->get()->toArray();
        echo json_encode($hasil);
    }
}
