<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function getDataSp(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $tkt = new User();
            $list = $tkt->getlistcallversi1($input);
            return json_encode($list);
        }
    }

    public function getDataQb(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $tkt = new User();
            $list = $tkt->getlistcallversi2($input);
            return json_encode($list);
        }
    }
}
