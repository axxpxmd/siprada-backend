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
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#edit-data" role="tab"><i class="icon icon-plus"></i>Rekam Jejak</a>
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
                            <div class="card-body no-b">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th width="10%">Tahapan</th>
                                            <th width="10%">Sub Tahapan</th>
                                            <th width="30%">Judul</th>
                                            <th width="25%">Keterangan</th>
                                            <th width="10%">Tanggal Kegiatan</th>
                                            <th width="5%">File</th>
                                            <th width="5%"></th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane animated fadeInUpShort" id="edit-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert"></div>
                        <div class="card">
                            <h6 class="card-header"><strong>Tambah Rekam Jejak</strong></h6>
                            <div class="card-body">
                                <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                                    {{ method_field('POST') }}
                                    @csrf
                                    <input type="hidden" name="perda_id" id="perda_id" value="{{ $data->id }}">
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label class="form-control label-input-custom col-md-2 font-weight-normal">Tahapan<span class="text-danger ml-1">*</span></label>
                                                <div class="col-md-4 p-0 bg-light">
                                                    <select class="select2 form-control r-0 light s-12" id="tahap_id" name="tahap_id" autocomplete="off">
                                                        <option value="">Pilih</option>
                                                        @foreach ($tahaps as $i)
                                                            <option value="{{ $i->id }}">{{ $i->judul }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label class="form-control label-input-custom col-md-2 font-weight-normal">Sub Tahapan<span class="text-danger ml-1">*</span></label>
                                                <div class="col-md-4 p-0 bg-light">
                                                    <select class="select2 form-control r-0 light s-12" id="sub_tahap_id" name="sub_tahap_id" autocomplete="off">
                                                        <option value="">Pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label class="form-control label-input-custom col-md-2 font-weight-normal">Kegiatan<span class="text-danger ml-1">*</span></label>
                                                <div class="col-md-4 p-0 bg-light">
                                                    <select class="select2 form-control r-0 light s-12" id="status_kegiatan" name="status_kegiatan" autocomplete="off">
                                                        <option value="">Pilih</option>
                                                        <option value="1">Ada</option>
                                                        <option value="0">Tidak ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="judul" class="form-control label-input-custom col-md-2 font-weight-normal">Judul<span class="text-danger ml-1">*</span></label>
                                                <textarea rows="3" type="text" name="judul" id="judul" placeholder="Masukan Nama Kegiatan" class="form-control r-0 light s-12 col-md-4" autocomplete="off" required></textarea>
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="tgl_kegiatan" class="form-control label-input-custom col-md-2 font-weight-normal">Tanggal Kegiatan<span class="text-danger ml-1">*</span></label>
                                                <input type="datetime-local" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control r-0 light s-12 col-md-4" autocomplete="off" required/>
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="keterangan" class="form-control label-input-custom col-md-2 font-weight-normal">keterangan</label>
                                                <textarea rows="2" type="text" name="keterangan" id="keterangan" placeholder="Masukan keterangan (optional)" class="form-control r-0 light s-12 col-md-4" autocomplete="off"></textarea>
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="file" class="form-control label-input-custom col-md-2 font-weight-normal">File</label>
                                                <input type="file" name="file[]" id="file" class="form-control r-0 light s-12 col-md-4" onchange="javascript:updateList()" multiple/>
                                            </div>
                                            <div class="form-group m-0">
                                                <label class="form-control label-input-custom col-md-2 font-weight-normal"></label>
                                                <div class="col-md-4 mt-2 text-primary mb-2" id="fileList"></div>
                                            </div>
                                            <div class="form-group m-0">
                                                <label class="form-control label-input-custom col-md-2 font-weight-normal"></label>
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="icon icon-plus"></i>Tambah Rekam Jejak</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    updateList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');
        var children = "";
        for (var i = 0; i < input.files.length; ++i) {
            children += '<li type="1">'+ input.files.item(i).name + '</li>';
        }
        output.innerHTML = children;
        $('#fileTitle').html(input.files.length + ' File dipilih');
    }

    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route($route.'api2') }}",
            method: 'POST',
            data: function (data) {
                data.perda_id = $('#perda_id').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'tahap_id', name: 'tahap_id'},
            {data: 'sub_tahap_id', name: 'sub_tahap_id'},
            {data: 'judul', name: 'judul'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'tgl_kegiatan', name: 'tgl_kegiatan'},
            {data: 'file', name: 'file', className: 'text-center'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
        ]
    });

    $('#tahap_id').on('change', function(){
        val = $(this).val();
        option = "<option value=''>&nbsp;</option>";
        if(val == ""){
            $('#sub_tahap_id').html(option);
        }else{
            $('#sub_tahap_id').html("<option value=''>Loading...</option>");
            url = "{{ route('perda.subTahapanByTahapan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.judul +"</li>";
                    });
                    $('#sub_tahap_id').empty().html(option);

                    $("#sub_tahap_id").val($("#sub_tahap_id option:first").val()).trigger("change.select2");
                }else{
                    $('#sub_tahap_id').html(option);
                }
            }, 'JSON'); 
        }
    });

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action').attr('disabled', true);
            url = "{{ route($route.'storeRekamJejak') }}";
            $.ajax({
                url : url,
                type : 'POST',
                data: new FormData(($(this)[0])),
                contentType: false,
                processData: false,
                success : function(data) {
                    $.confirm({
                        title: 'Success',
                        content: data.message,
                        icon: 'icon icon-check', 
                        theme: 'modern',
                        animation: 'scale',
                        autoClose: 'ok|3000',
                        type: 'green',
                        buttons: {
                            ok: {
                                text: "ok!",
                                btnClass: 'btn-primary',
                                keys: ['enter'],
                                action: function () {
                                    location.reload();
                                }
                            }
                        }
                    });
                },
                error : function(data){
                    err = '';
                    respon = data.responseJSON;
                    if(respon.errors){
                        $.each(respon.errors, function( index, value ) {
                            err = err + "<li>" + value +"</li>";
                        });
                    }
                    $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                    $('#action').removeAttr('disabled');
                }
            });
            return false;
        }
        $(this).addClass('was-validated');
    });
</script>
@endsection