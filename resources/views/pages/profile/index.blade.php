@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-user mr-2"></i>
                        {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#profile" role="tab"><i class="icon icon-home2"></i>My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#edit-data" role="tab"><i class="icon icon-edit"></i>Edit Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content pb-3" id="v-pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="profile">
                <div class="container col-md-6 my-3">
                    <div class="card">
                        <div class="card-header">&nbsp;</div>
                        <div class="card-body">
                            <img class="mx-auto d-block rounded-circle img-circular" src="{{ asset($path.$adminDetail->photo) }}" width="100" height="100" alt="Foto Profil">
                            <p class="text-center mt-2 font-weight-normal fs-17 text-uppercase">{{ $adminDetail->full_name }}</p>
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-md-2 text-left s-13"><strong>Username </strong></label>
                                    <label class="col-md-10 s-13">: {{ $adminDetail->admin->username }}</label>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 text-left s-13"><strong>Email </strong></label>
                                    <label class="col-md-10 s-13">: {{ $adminDetail->email }}</label>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 text-left s-13"><strong>No Telp </strong></label>
                                    <label class="col-md-10 s-13">: {{ $adminDetail->phone }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane animated fadeInUpShort" id="edit-data" role="tabpanel">
                <div class="row my-3">
                    <div class="col-md-12">
                        <div id="alert"></div>
                        <form class="needs-validation" id="form" method="PATCH"  enctype="multipart/form-data" novalidate>
                            {{ method_field('PATCH') }}
                            <div class="card">
                                <h6 class="card-header"><strong>Edit Data</strong></h6>
                                <div class="card-body">
                                    <input type="hidden" id="id" name="id" value="{{ $adminDetail->id }}"/>
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <label class="col-md-2 text-left s-13"><strong>No Telp </strong></label>
                                                <input type="text" class="form-control r-0 light s-12 col-md-10">
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="username" class="col-form-label s-12 col-md-2">Username<span class="text-danger ml-1">*</span></label>
                                                <input type="text" name="username" id="username" class="form-control r-0 light s-12 col-md-6" value="{{ $adminDetail->admin->username }}" autocomplete="off" required/>
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="full_name" class="col-form-label s-12 col-md-2">Nama Lengkap<span class="text-danger ml-1">*</span></label>
                                                <input type="text" name="full_name" id="full_name" class="form-control r-0 light s-12 col-md-6" value="{{ $adminDetail->full_name }}" autocomplete="off" required/>
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="email" class="col-form-label s-12 col-md-2">Email<span class="text-danger ml-1">*</span></label>
                                                <input type="text" name="email" id="email" class="form-control r-0 light s-12 col-md-6" value="{{ $adminDetail->email }}" autocomplete="off" required/>
                                            </div>
                                            <div class="form-group m-0">
                                                <label for="phone" class="col-form-label s-12 col-md-2">No Telp<span class="text-danger ml-1">*</span></label>
                                                <input type="text" name="phone" id="phone" class="form-control r-0 light s-12 col-md-6" value="{{ $adminDetail->phone }}" autocomplete="off" required/>
                                            </div> 
                                            <div class="form-group" style="margin-top: -3px !important">
                                                <label for="" class="col-form-label s-12 col-md-2">
                                                    Foto
                                                    <a class="ml-1 mt-1" data-toggle="popover" title="Required" data-html="true" data-content="Max File : 2MB<br/>Format File : (png, jpg, jpeg)">
                                                        <i class="icon icon-information2 s-18 red-text"></i>
                                                    </a>
                                                </label>
                                                <input type="file" name="photo" id="file" class="input-file" onchange="tampilkanPreview(this,'preview')">
                                                <label for="file" class="btn-tertiary js-labelFile col-md-6">
                                                    <i class="icon icon-image mr-2 m-b-1"></i>
                                                    <span class="js-fileName">Browse Image</span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="col-form-label s-12 col-md-2"></label>
                                                <img class="rounded-circle img-circular" id="preview" src="{{ asset($path.$adminDetail->photo) }}" height="100" width="100">
                                            </div>
                                            <div class="form-group mt-3">
                                                <div class="col-md-2"></div>
                                                <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Simpan Perubahan</button>
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
@endsection
@section('script')
<script type="text/javascript">
    (function () {
        'use strict';
        $('.input-file').each(function () {
            var $input = $(this),
                $label = $input.next('.js-labelFile'),
                labelVal = $label.html();

            $input.on('change', function (element) {
                var fileName = '';
                if (element.target.value) fileName = element.target.value.split('\\').pop();
                fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label
                    .removeClass('has-file').html(labelVal);
            });
        });
    })();

    function tampilkanPreview(gambar, idpreview) {
        var gb = gambar.files;
        for (var i = 0; i < gb.length; i++) {
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                preview.file = gbPreview;
                reader.onload = (function (element) {
                    return function (e) {
                        element.src = e.target.result;
                    };
                })(preview);
                reader.readAsDataURL(gbPreview);
            } else {
                $.confirm({
                    title: '',
                    content: 'Tipe file tidak boleh! haruf format gambar (png, jpg, jpeg)',
                    icon: 'icon icon-close',
                    theme: 'modern',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'red',
                    buttons: {
                        ok: {
                            text: "ok!",
                            btnClass: 'btn-primary',
                            keys: ['enter']
                        }
                    }
                });
            }
        }
    }
   
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
                }
            });
            return false;
        }
        $(this).addClass('was-validated');
    });
</script>
@endsection
