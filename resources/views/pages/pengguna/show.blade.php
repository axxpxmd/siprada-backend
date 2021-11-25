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
                        {{ $title }} | {{ $data->nama }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route($route.'index') }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-document-list"></i>User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link show" id="tab1" data-toggle="tab" href="#edit-data" role="tab"><i class="icon icon-verified_user"></i>Update Status</a>
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
                        <div class="card mt-2">
                            <h6 class="card-header"><strong>Data User</strong></h6>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Email :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->email }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Nama :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->nama }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>NIK :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->nik }} | <a href="#" onclick="cek_nik({{ $data->nik }})"><i class="icon icon-search3"></i> Cek NIK</a></label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Status User :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->status_user }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Nama Perusahaan / Kelompok :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->nama_perusahaan != null ? $data->nama_perusahaan : '-' }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>No Telp :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->no_telp }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Keterangan :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->keterangan }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Status Verifikasi :</strong></label>
                                        <label class="col-md-8 s-12">
                                            @if ($data->status == 0)
                                                <span class="badge badge-warning">Belum</span>
                                            @elseif($data->status == 1)
                                                <span class="badge badge-success">Sudah</span>
                                            @elseif($data->status == 2)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </label>
                                    </div>
                                    @if ($data->status == 2)
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12"><strong>Alasan :</strong></label>
                                        <label class="col-md-8 s-12">{{ $data->alasan }}</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane animated fadeInUpShort show" id="edit-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h6 class="card-header"><strong>Edit Data</strong></h6>
                            <div class="card-body">
                                <form class="needs-validation" action="{{ route('pengguna.updateStatus', $data->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="status" class="form-control label-input-custom col-md-2">Status<span class="text-danger ml-1">*</span></label>
                                                <div class="col-md-2 p-0 bg-light">
                                                    <select class="select2 form-control r-0 light s-12" name="status" id="status" autocomplete="off">
                                                        <option value="" {{ $data->status == '' ? 'selected' : '' }}>Pilih</option>
                                                        <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Verifikasi</option>
                                                        <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Tolak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-1" id="alasan_display">
                                                <label for="alasan" class="form-control label-input-custom col-md-2">Alasan<span class="text-danger ml-1">*</span></label>
                                                <textarea type="text" rows="4" name="alasan" id="alasan" class="form-control r-0 light s-12 col-md-4" autocomplete="off">{{ $data->alasan }}</textarea>
                                            </div> 
                                            <div class="form-group mt-2">
                                                <div class="col-md-2"></div>
                                                <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Update Status</button>
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
<!-- Data NIK -->
<div class="modal fade" id="data_nik" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold">Data NIK User</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="row">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>Nama </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="nama">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>TTL </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="ttl">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>Kelamin </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="jenis_kelamin">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>No KK </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="no_kk">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>Alamat </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="alamat">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>&nbsp;&nbsp;&nbsp;&nbsp;RT/RW </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="rtrw">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Kel/Desa </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="kelurahan">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="kecamatan">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>Agama </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="agama">:</label>
                    </div>
                    <div class="row" style="margin-top: -5px !important">
                        <label class="col-md-2 s-12 font-weight-bold"><strong>Perkerjaan </strong></label>
                        <label class="col-md-9 s-12 font-weight-bold" id="pekerjaan">:</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    var status = $('#status').val();
    if(status == '' || status == 1) {
        $('#alasan_display').hide(); 
    } else {
        $('#alasan_display').show(); 
    } 
    
    $('#status').change(function(){
        var status = $('#status').val();
        if(status == '' || status == 1) {
            $('#alasan_display').hide(); 
            $('#alasan').prop('required', false); 
            $('#alasan').html('');
        } else {
            $('#alasan_display').show(); 
            $('#alasan').prop('required', true); 
        } 
    });

    function cek_nik(id) {
        $('#data_nik').modal('show');
        $('#data_nik').modal({keyboard: false});

        // get data nik
        url = "{{ route('pengguna.cekNIK', ':id') }}".replace(':id', id);
        $.get(url, function(data){
            $('#nama').html(': '+data.nama_lengkap)
            $('#ttl').html(': '+data.tempat_lahir+','+data.tgl_lahir)
            $('#no_kk').html(': '+data.no_kk)
            $('#alamat').html(': '+data.alamat)
            $('#rtrw').html(': '+data.no_rt+'/'+data.no_rw)
            $('#kelurahan').html(': '+data.kelurahan)
            $('#kecamatan').html(': '+data.kecamatan)
            $('#agama').html(': '+data.agama)
            $('#pekerjaan').html(': '+data.jenis_pekerjaan)
            $('#jenis_kelamin').html(': '+data.jenis_kelamin)
        }, 'JSON');
    }
</script>
@endsection
