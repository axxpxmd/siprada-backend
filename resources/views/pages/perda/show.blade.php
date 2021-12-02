@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
         <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-document-text4 mr-2"></i>
                        Menampilkan {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route($route.'index') }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-document-list"></i>{{ $title  }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content my-3" id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-2">
                            <h6 class="card-header"><strong>Data {{ $title }}</strong></h6>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Judul :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->judul }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Jenis :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->jenis }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Perda Amandemen :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->perda_amandemen }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Periode :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->periode }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Tahun Anggaran :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->tahun_angrn }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Tahap :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->tahap == null ? 'Belum ada' : $data->tahap->judul }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Sub Tahap :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->subTahap == null ? 'Belum ada' : $data->subTahap->judul }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Pengusul :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->pengusul }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Pemrakarsa :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->pemrakarsa }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Dokumen :</strong></label>
                                        <label class="col-md-10 s-12">
                                            <a href="{{ config('app.sftp_src').'perda/'.$data->dokumen }}" target="blank">{{ $data->dokumen }}</a>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Tanggal Input Dokumen :</strong></label>
                                        <label class="col-md-10 s-12">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->tgl_inpt_dok)->format('d F Y | H:i:s') }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Naskah Akademik :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->naskah_akdmk }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Keterangan :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->keterangan }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Ditarik :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->ditarik }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Tampilkan :</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->tampilkan == 1 ? 'Ya' : 'Tidak' }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Tanggal Terbit :</strong></label>
                                        <label class="col-md-10 s-12">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->tgl_terbit)->format('d F Y | H:i:s') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <h6 class="card-header"><strong>Rekam Jejak</strong></h6>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th width="10%">No</th>
                                            <th width="10%">Tahap</th>
                                            <th width="10%">Sub Tahap</th>
                                            <th width="40%">Judul</th>
                                            <th width="10%">Tanggal Kegiatan</th>
                                            <th width="10%">Keterangan</th>
                                            <th width="10%"></th>
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
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route($route.'api2') }}",
            method: 'POST'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'tahap_id', name: 'tahap_id'},
            {data: 'sub_tahap_id', name: 'sub_tahap_id'},
            {data: 'judul', name: 'judul'},
            {data: 'tgl_kegiatan', name: 'tgl_kegiatan'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
        ]
    });
</script>
@endsection