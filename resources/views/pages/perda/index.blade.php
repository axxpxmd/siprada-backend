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
                        List {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-home2"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#tambah-data" role="tab"><i class="icon icon-plus"></i>Tambah Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3 relative animatedParent animateOnce">
        <div class="tab-content " id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="card no-b mb-2">
                    <div class="card-body">
                        <div class="form-group row" style="margin-top: -10px !important">
                            <label for="jenis_filter" class="col-form-label s-12 col-md-4 text-right font-weight-bolder">Jenis : </label>
                            <div class="col-sm-4">
                                <select name="jenis_filter" id="jenis_filter" class="select2 form-control r-0 light s-12">
                                    <option value="">Pilih</option>
                                    <option value="baru">Baru</option>
                                    <option value="amandemen">Amandemen</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: -10px !important">
                            <label for="tahun_angrn_filter" class="col-form-label s-12 col-md-4 text-right font-weight-bolder">Tahun Anggaran : </label>
                            <div class="col-sm-4">
                                <select name="tahun_angrn_filter" id="tahun_angrn_filter" class="select2 form-control r-0 light s-12">
                                    <option value=""></option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: -8px !important">
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
                                            <th width="35%">Judul</th>
                                            <th width="7%">Jenis</th>
                                            <th width="8%">Periode</th>
                                            <th width="5%">Anggaran</th>
                                            <th width="8%">Pengusul</th>
                                            <th width="7%">Pemrakarsa</th>
                                            <th width="10%">Tahap</th>
                                            <th width="5%">Ditarik</th>
                                            <th width="5%">Tampilkan</th>
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
            <div class="tab-pane animated fadeInUpShort" id="tambah-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert"></div>
                        <div class="card">
                            <h6 class="card-header"><strong>Tambah Data</strong></h6>
                            <div class="card-body">
                                <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                                    {{ method_field('POST') }}
                                    @csrf
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group m-0">
                                                        <label for="judul" class="form-control label-input-custom col-md-4 font-weight-normal">Judul<span class="text-danger ml-1">*</span></label>
                                                        <textarea rows="3" type="text" name="judul" id="judul" placeholder="Masukan judul PERDA" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required></textarea>
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
                                                        <textarea rows="3" type="text" name="perda_amandemen" id="perda_amandemen" placeholder="Masukan Perda Amandemen" class="form-control r-0 light s-12 col-md-8" autocomplete="off"></textarea>
                                                    </div>
                                                    <div class="form-group mt-1">
                                                        <label class="form-control label-input-custom col-md-4 font-weight-normal">Periode<span class="text-danger ml-1">*</span></label>
                                                        <input type="number" name="periode1" id="periode1" class="form-control r-0 light s-12 col-md-2" autocomplete="off" required/>
                                                        <span>&nbsp;&nbsp; - &nbsp;&nbsp;</span>
                                                        <input type="number" name="periode2" id="periode2" class="form-control r-0 light s-12 col-md-2" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="tahun_angrn" class="form-control label-input-custom col-md-4 font-weight-normal">Tahun Anggaran<span class="text-danger ml-1">*</span></label>
                                                        <input type="number" name="tahun_angrn" id="tahun_angrn" class="form-control r-0 light s-12 col-md-2" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="pengusul" class="form-control label-input-custom col-md-4 font-weight-normal">Pengusul<span class="text-danger ml-1">*</span></label>
                                                        <input type="text" name="pengusul" id="pengusul" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required/>
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
                                                        <input type="file" name="dokumen" id="dokumen" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="tgl_inpt_dok" class="form-control label-input-custom col-md-4 font-weight-normal">Tgl Input Dok.<span class="text-danger ml-1">*</span></label>
                                                        <input type="datetime-local" name="tgl_inpt_dok" id="tgl_inpt_dok" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="naskah_akdmk" class="form-control label-input-custom col-md-4 font-weight-normal">Naskah Akademik</label>
                                                        <textarea rows="2" type="text" name="naskah_akdmk" id="naskah_akdmk" placeholder="Masukan naskah akademik (optional)" class="form-control r-0 light s-12 col-md-8" autocomplete="off"></textarea>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="keterangan" class="form-control label-input-custom col-md-4 font-weight-normal">keterangan</label>
                                                        <textarea rows="2" type="text" name="keterangan" id="keterangan" placeholder="Masukan keterangan (optional)" class="form-control r-0 light s-12 col-md-8" autocomplete="off"></textarea>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="tgl_terbit" class="form-control label-input-custom col-md-4 font-weight-normal">Tanggal Terbit<span class="text-danger ml-1">*</span></label>
                                                        <input type="datetime-local" name="tgl_terbit" id="tgl_terbit" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-2">
                                                        <div class="col-md-4"></div>
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="icon-save mr-2"></i>Simpan</button>
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
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route($route.'api') }}",
            method: 'POST',
            data: function (data) {
                data.jenis_filter = $('#jenis_filter').val();
                data.tahun_angrn_filter = $('#tahun_angrn_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'judul', name: 'judul'},
            {data: 'jenis', name: 'jenis'},
            {data: 'periode', name: 'periode'},
            {data: 'tahun_angrn', name: 'tahun_angrn'},
            {data: 'pengusul', name: 'pengusul'},
            {data: 'pemrakarsa', name: 'pemrakarsa'},
            {data: 'tahap_id', name: 'tahap_id'},
            {data: 'ditarik', name: 'ditarik', className: 'text-center'},
            {data: 'tampilkan', name: 'tampilkan', className: 'text-center'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
        ]
    });

    function pressOnChange(){
        table.api().ajax.reload();
    }

    $(function() {
        $('#perda_amandemen_display').hide(); 

        $('#jenis').change(function(){
            var jenis = $('#jenis').val();
            if(jenis == 'baru' || jenis == '') {
                $('#perda_amandemen_display').hide(); 
                $('#perda_amandemen').prop('required', false); 
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
            url = "{{ route($route.'store') }}";
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
                                    window.location.href = "{{ route('perda.index')}}";
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
    
  
    function remove(id){
        $.confirm({
            title: '',
            content: 'Apakah Anda yakin akan menghapus data ini ?',
            icon: 'icon icon-question amber-text',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        $.post("{{ route($route.'destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
                            $('#dataTable').DataTable().ajax.reload();
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
                                        keys: ['enter']
                                    }
                                }
                            });
                        }, "JSON").fail(function(){
                            reload();
                        });
                    }
                },
                cancel: function(){}
            }
        });
    }
</script>
@endsection
