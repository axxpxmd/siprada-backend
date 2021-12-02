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
                        <i class="icon icon-document-list mr-2"></i>
                        Edit {{ $title }} | {{ $data->nm_wajib_pajak }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route($route.'index') }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
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
                        <div id="alert"></div>
                        <div class="card">
                            <h6 class="card-header"><strong>Edit Data</strong></h6>
                            <div class="card-body">
                                <form class="needs-validation" id="form" method="PATCH"  enctype="multipart/form-data" novalidate>
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" id="id" name="id" value="{{ $data->id }}"/>
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group m-0">
                                                        <label for="judul" class="form-control label-input-custom col-md-4 font-weight-normal">Judul<span class="text-danger ml-1">*</span></label>
                                                        <textarea rows="3" type="text" name="judul" id="judul" placeholder="Masukan judul PERDA" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required>{{ $data->judul }}</textarea>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label class="form-control label-input-custom col-md-4 font-weight-normal">Jenis<span class="text-danger ml-1">*</span></label>
                                                        <div class="col-md-8 p-0 bg-light">
                                                            <select class="select2 form-control r-0 light s-12" id="jenis" name="jenis" autocomplete="off">
                                                                <option value="">Pilih</option>
                                                                <option value="baru">Baru</option>
                                                                <option value="amandemen">Amandemen</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-1" id="perda_amandemen_display">
                                                        <label for="perda_amandemen" class="form-control label-input-custom col-md-4 font-weight-normal">Perda Amandemen<span class="text-danger ml-1">*</span></label>
                                                        <textarea rows="3" type="text" name="perda_amandemen" id="perda_amandemen" placeholder="Masukan Perda Amandemen" class="form-control r-0 light s-12 col-md-8" autocomplete="off">{{ $data->perda_amandemen }}</textarea>
                                                    </div>
                                                    <div class="form-group mt-1">
                                                        <label class="form-control label-input-custom col-md-4 font-weight-normal">Periode<span class="text-danger ml-1">*</span></label>
                                                        <input type="number" name="periode1" id="periode1" value="{{ substr($data->periode, 0,4) }}" class="form-control r-0 light s-12 col-md-2" autocomplete="off" required/>
                                                        <span>&nbsp;&nbsp; - &nbsp;&nbsp;</span>
                                                        <input type="number" name="periode2" id="periode2"  value="{{ substr($data->periode, 7) }}" class="form-control r-0 light s-12 col-md-2" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="tahun_angrn" class="form-control label-input-custom col-md-4 font-weight-normal">Tahun Anggaran<span class="text-danger ml-1">*</span></label>
                                                        <input type="number" name="tahun_angrn" id="tahun_angrn" value="{{ $data->tahun_angrn }}" class="form-control r-0 light s-12 col-md-2" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="pengusul" class="form-control label-input-custom col-md-4 font-weight-normal">Pengusul<span class="text-danger ml-1">*</span></label>
                                                        <input type="text" name="pengusul" id="pengusul" value="{{ $data->pengusul }}" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="pemrakarsa" class="form-control label-input-custom col-md-4 font-weight-normal">Pemrakarsa<span class="text-danger ml-1">*</span></label>
                                                        <div class="col-md-8 p-0 bg-light">
                                                            <select class="select2 form-control r-0 light s-12" id="pemrakarsa" name="pemrakarsa" autocomplete="off">
                                                                <option value="">Pilih</option>
                                                                <option value="legislatif">Legislatif</option>
                                                                <option value="eksekutif">Eksekutif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group m-0">
                                                        <label for="dokumen" class="form-control label-input-custom col-md-4 font-weight-normal">Dokumen<span class="text-danger ml-1">*</span></label>
                                                        <input type="file" name="dokumen" id="dokumen" class="form-control r-0 light s-12 col-md-8" autocomplete="off"/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="tgl_inpt_dok" class="form-control label-input-custom col-md-4 font-weight-normal">Tgl Input Dok.<span class="text-danger ml-1">*</span></label>
                                                        <input type="datetime-local" name="tgl_inpt_dok" id="tgl_inpt_dok" value="{{ date('Y-m-d\TH:i', strtotime($data->tgl_inpt_dok))}}" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="naskah_akdmk" class="form-control label-input-custom col-md-4 font-weight-normal">Naskah Akademik</label>
                                                        <textarea rows="2" type="text" name="naskah_akdmk" id="naskah_akdmk" placeholder="Masukan naskah akademik (optional)" class="form-control r-0 light s-12 col-md-8" autocomplete="off">{{ $data->naskah_akdmk }}</textarea>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="keterangan" class="form-control label-input-custom col-md-4 font-weight-normal">keterangan</label>
                                                        <textarea rows="2" type="text" name="keterangan" id="keterangan" placeholder="Masukan keterangan (optional)" class="form-control r-0 light s-12 col-md-8" autocomplete="off">{{ $data->keterangan }}</textarea>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="tgl_terbit" class="form-control label-input-custom col-md-4 font-weight-normal">Tanggal Terbit<span class="text-danger ml-1">*</span></label>
                                                        <input type="datetime-local" name="tgl_terbit" id="tgl_terbit" value="{{ date('Y-m-d\TH:i', strtotime($data->tgl_terbit))}}" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-2">
                                                        <div class="col-md-4"></div>
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="icon-save mr-2"></i>Perbarui Data</button>
                                                    </div>  
                                                </div>
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
    $('#jenis').val("{{ $data->jenis }}");
    $('#jenis').trigger('change.select2');
    $('#pemrakarsa').val("{{ $data->pemrakarsa }}");
    $('#pemrakarsa').trigger('change.select2');

    $(function() {
        var jenis = $('#jenis').val();
        if(jenis == 'baru' || jenis == '') {
            $('#perda_amandemen_display').hide(); 
            $('#perda_amandemen').prop('required', false); 
        } else {
            $('#perda_amandemen_display').show(); 
            $('#perda_amandemen').prop('required', true); 
        } 

        $('#jenis').change(function(){
            var jenis = $('#jenis').val();
            if(jenis == 'baru' || jenis == '') {
                $('#perda_amandemen_display').hide(); 
                $('#perda_amandemen').prop('required', false); 
                $('#perda_amandemen').val(''); 
            } else {
                $('#perda_amandemen_display').show(); 
                $('#perda_amandemen').prop('required', true); 
            } 
        });
    });

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action').attr('disabled', true);
            url = "{{ route($route.'update', ':id') }}".replace(':id', $('#id').val());
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