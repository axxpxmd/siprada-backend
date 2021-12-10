@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<style>
    .label-input-custom{
        font-size: 12px !important;
        text-align: right !important;
        border: none !important;
        padding-right: 1.5rem !important;
        color: #86939E !important;
        font-weight: 400 !important
    }
</style>
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
         <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-document-text4 mr-2"></i>
                        Edit {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route($route.'show', $data->perda_id) }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-edit"></i>Edit Data</a>
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
                        @include('layouts.alert')
                        <div id="alert"></div>
                        <div class="card">
                            <h6 class="card-header"><strong>Edit Data</strong></h6>
                            <div class="card-body">
                                <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                                    {{ method_field('POST') }}
                                    <input type="hidden" id="id" name="id" value="{{ $data->id }}"/>
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
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
                                                        <textarea rows="3" type="text" name="judul" id="judul" placeholder="Masukan Nama Kegiatan" class="form-control r-0 light s-12 col-md-4" autocomplete="off" required>{{ $data->judul }}</textarea>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="tgl_kegiatan" class="form-control label-input-custom col-md-2 font-weight-normal">Tanggal Kegiatan<span class="text-danger ml-1">*</span></label>
                                                        <input type="datetime-local" name="tgl_kegiatan" id="tgl_kegiatan" value="{{ date('Y-m-d\TH:i', strtotime($data->tgl_kegiatan))}}" class="form-control r-0 light s-12 col-md-4" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="keterangan" class="form-control label-input-custom col-md-2 font-weight-normal">keterangan</label>
                                                        <textarea rows="2" type="text" name="keterangan" id="keterangan" placeholder="Masukan keterangan (optional)" class="form-control r-0 light s-12 col-md-4" autocomplete="off">{{ $data->keterangan }}</textarea>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="file" class="form-control label-input-custom col-md-2 font-weight-normal">File</label>
                                                        <input type="file" name="file[]" id="file" class="form-control r-0 light s-12 col-md-4" onchange="javascript:updateList()" multiple/>
                                                        <br>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label class="form-control label-input-custom col-md-2 font-weight-normal"></label>
                                                        <div class="col-md-4 mt-2 text-primary mb-2" id="fileList"></div>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <div class="col-md-2"></div>
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="icon-save mr-2"></i>Perbarui Data</button>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <h6 class="card-header"><strong>File Rekam Jejak</strong></h6>
                            <div class="card-body">
                                <ol>
                                    @foreach ($files as $i)
                                        <li>
                                            <a href="{{ config('app.sftp_src').'perda/'.$i->file }}" target="blank">{{ $i->file }}</a>
                                            <a href="#" class="text-danger" onclick="deleteFile({{ $i->id }})"><i class="icon icon-trash ml-1"></i></a>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteFile" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="needs-validation" method="GET" action="{{ route('perda.deleteFileRekamJejak') }}" enctype="multipart/form-data" novalidate>
                {{ method_field('GET') }}
                <input type="hidden" name="id" id="histori_id">
                <div class="modal-body">
                    <div class="">
                        <p class="font-weight-bold text-black-50">Apakah sudah yakin ingin menghapus file ini ?</p>
                    </div>
                    <hr>
                    <div class="text-right">
                        <a class="btn btn-danger btn-sm"><i class="icon-times mr-2"></i>Batalkan</a>
                        <button type="submit" class="btn btn-sm btn-primary ml-2"><i class="icon-trash mr-2"></i>Hapus File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('#status_kegiatan').val("{{ $data->status_kegiatan }}");
    $('#status_kegiatan').trigger('change.select2');

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

    function deleteFile(id){
        console.log(id);
        $('#deleteFile').modal('show');
        $('#histori_id').val(id);
    }

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action').attr('disabled', true);
            url = "{{ route($route.'updateRekamJejak', ':id') }}".replace(':id', $('#id').val());
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
                        closeIcon: true,
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