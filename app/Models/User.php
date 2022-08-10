<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{

    //via stored procedure di mysql
    public function getlistcallversi1($param)
    {
        $start      = $param['start'];
        $length     = $param['length'];
        $draw       = $param['draw'];
        $cari       = ($_POST['search']['value']) ? "'%" . $_POST['search']['value'] . "%'" : "NULL";
        $col        = ($_POST['order'][0]['column']) ? "'" . $_POST['order'][0]['column'] . "'" : "NULL";
        $dir        = ($_POST['order'][0]['dir']) ? "'" . $_POST['order'][0]['dir'] . "'" : "NULL";

        $list = DB::select("call sp_getdata(" . $start . "," . $length . "," . $cari . "," . $col . "," . $dir . ",@pResult);");
        $rs = DB::select('SELECT @pResult AS result');

        $option['draw']            = $draw;
        $option['recordsTotal']    = $rs[0]->result;
        $option['recordsFiltered'] = $rs[0]->result;
        $option['data']            = $list;

        return $option;
    }

    //via query builder
    public function getlistcallversi2($param)
    {
        $start      = $param['start'];
        $length     = $param['length'];
        $draw       = $param['draw'];
        $cari       = ($_POST['search']['value']) ? "'%" . $_POST['search']['value'] . "%'" : "NULL";
        $col        = ($_POST['order'][0]['column']) ? $_POST['order'][0]['column']  : "NULL";
        $dir        = ($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : "NULL";

        $columnSort = array("id", "name", "email", "instansi", "divisi", "jabatan");

        $list = DB::table('users')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS users.id,users.name,users.email,users.instansi,users.divisi,users.jabatan,users.status'))
            ->WhereRaw('name like coalesce(' . $cari . ',name)')
            ->orWhereRaw('email like coalesce(' . $cari . ',email)')
            ->orWhereRaw('instansi like coalesce(' . $cari . ',instansi)')
            ->orWhereRaw('divisi like coalesce(' . $cari . ',divisi)')
            ->orWhereRaw('jabatan like coalesce(' . $cari . ',jabatan)')
            ->orderBy($columnSort[$col], $dir)
            ->offset($start)
            ->limit($length)
            ->get();

        $rs = DB::select('SELECT FOUND_ROWS() AS result');

        $option['draw']            = $draw;
        $option['recordsTotal']    = $rs[0]->result;
        $option['recordsFiltered'] = $rs[0]->result;
        $option['data']            = $list;

        return $option;
    }
}
