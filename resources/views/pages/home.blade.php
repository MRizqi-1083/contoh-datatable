@extends('layouts.index')

@section('title')
    <title>Halaman Utama :: Contoh DataTable</title>
@endsection

@section('styles')
    <style type="text/css">
        body {
            font-size: 12px;
        }

        .dataTables_processing.card {
            background-color: #d3d3d3d4;
            color: black;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="app-content">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Welcome</li>
        </ul>
        <h1 class="page-header d-flex justify-content-between">
            <span>Contoh Datatable <small>2 Contoh menggunakan Datatable Ajax...</small></span>
        </h1>
    </div>
@endsection
