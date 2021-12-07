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
                        @include('layouts.alert')
                        <div class="card mt-2">
                            <h6 class="card-header"><strong>Data {{ $title }}</strong></h6>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label class="col-md-3 text-right s-12"><strong>Perda :</strong></label>
                                            <label class="col-md-9 s-12">{{ $data->perda->judul }}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 text-right s-12"><strong>Aspirator :</strong></label>
                                            <label class="col-md-9 s-12">{{ $data->pengguna->nama }}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 text-right s-12"><strong>Aspirasi :</strong></label>
                                            <label class="col-md-9 s-12">{{ $data->aspirasi }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card">
                                            <h6 class="card-header text-center"><strong>Terdapat {{ $komentars->count() }} balasan dari aspirasi ini.</strong></h6>
                                            <div class="card-body">
                                                <div class="">
                                                    @foreach ($komentars as $k)
                                                    <div class="mb-3 bg-light rounded p-2">
                                                        <p class="mb-0 s-12"><i class="icon-clock-o mr-2"></i>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $k->created_at)->format('d M Y | H:i:s') }}</p>
                                                        <p class="mt-0 mb-0 s-12"><span class="font-weight-bold">{{ $k->pengguna->nama }}</span> - {{ $k->komentar }}</p>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <hr class="mb-0">
                                                <form class="needs-validation" novalidate method="POST" action="{{ route('aspirasi.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="aspirasi_id" value="{{ $data->id }}">
                                                    <div class="form-group">
                                                        <label for="komentar" class="font-weight-bold s-12"></label>
                                                        <textarea type="text" rows="3" class="form-control s-12" name="komentar" id="komentar"  placeholder="Berikan balasan sebagai admin SIPRADA" autocomplete="off" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="font-weight-bold"></label>
                                                        <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-send mr-2"></i>Kirim Balasan</button>
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection