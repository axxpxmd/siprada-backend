@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-users mr-2"></i>
                        {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-home2"></i>Semua Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content my-3" id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="card no-b mb-2">
                    <div class="card-body">
                        <!-- Status Verifikasi -->
                        <div class="form-group row" style="margin-top: -10px !important">
                            <label for="status" class="col-form-label s-12 col-md-4 text-right font-weight-bolder">Status Verifikasi : </label>
                            <div class="col-sm-4">
                                <select name="status" id="status" class="select2 form-control r-0 light s-12">
                                    <option value="">Pilih</option>
                                    <option value="0">Belum</option>
                                    <option value="1">Sudah</option>
                                    <option value="2">Ditolak</option>
                                </select>
                            </div>
                        </div> 
                        <!-- Status User -->
                        <div class="form-group row" style="margin-top: -10px !important">
                            <label for="status_user" class="col-form-label s-12 col-md-4 text-right font-weight-bolder">Status User : </label>
                            <div class="col-sm-4">
                                <select name="status_user" id="status_user" class="select2 form-control r-0 light s-12">
                                    <option value="">Pilih</option>
                                    <option value="individual">Individual</option>
                                    <option value="kelompok">Kelompok</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row" style="margin-top: -10px !important">
                            <label class="col-form-label s-12 col-md-4 text-right font-weight-bolder"></label>
                            <div class="col-sm-5 row">
                                <button class="btn btn-success btn-sm ml-3" onclick="pressOnChange()"><i class="icon-filter mr-2"></i>Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th width="25%">Nama</th>
                                            <th width="20%">Email</th>
                                            <th width="20%">NIK</th>
                                            <th width="10%">Status User</th>
                                            <th width="10%">Status Verifikasi</th>
                                            <th width="10%">Jumlah Aspirasi</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    var table = $('#dataTable').dataTable({
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        ajax: {
            url: "{{ route($route.'api') }}",
            method: 'POST',
            data: function (data) {
                data.status = $('#status').val();
                data.status_user = $('#status_user').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'nama', name: 'nama'},
            {data: 'email', name: 'email'},
            {data: 'nik', name: 'nik'},
            {data: 'status_user', name: 'status_user', orderable: false, searchable: false, className: 'text-center'},
            {data: 'status', name: 'status', orderable: false, searchable: false, className: 'text-center'},
            {data: 'jumlah_aspirasi', name: 'jumlah_aspirasi', orderable: false, searchable: false, className: 'text-center'}
        ]
    });

    function pressOnChange(){
        table.api().ajax.reload();
    }
</script>
@endsection
