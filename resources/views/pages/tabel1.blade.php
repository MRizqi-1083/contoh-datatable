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
            <li class="breadcrumb-item active">Daftar User</li>
        </ul>
        <h1 class="page-header d-flex justify-content-between">
            <span>Daftar User <small>Menggunakan Store Procedure...</small></span>
            <button class="btn btn-sm btn-success">User Baru</button>
        </h1>
        @csrf
        <table id="tableUser" class="table table-bordered table-hover table-striped w-100">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $("#tableUser").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": true,
                ajax: {
                    url: "/user/list-user/sp",
                    type: "post",
                    data: function(d) {
                        d._token = $("input[name=_token]").val();
                    },
                },
                order: [
                    [1, 'asc']
                ],
                columns: [{
                    data: 'id',
                    width: 5,
                }, {
                    data: 'name',
                }, {
                    data: 'email',
                }, {
                    data: 'instansi',
                }, {
                    data: 'divisi',
                }, {
                    data: 'jabatan',
                }, {
                    data: 'status',
                    "orderable": false,
                    width: 75,
                    className: 'text-center',
                    render: function(data) {
                        if (data === "aktif") {
                            return '<button type="button" class="btn btn-sm btn-success">Aktif</button>'
                        } else if (data === "non-aktif") {
                            return '<button type="button" class="btn btn-sm btn-danger">Non Aktif</button>'
                        }
                    }
                }],
                "rowCallback": function(row, data, iDisplayIndex) {
                    var pg = $("#tableUser").DataTable().page.info();
                    var index = iDisplayIndex + 1;
                    $('td:eq(0)', row).html(index + pg.start);
                    return row;

                }
            });
        });
    </script>
@endsection
