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
                                <div class="row">
                                    <label class="col-md-2 text-right s-12"><strong>User :</strong></label>
                                    <label class="col-md-10 s-12">{{ $data->user->nama }}</label>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 text-right s-12"><strong>Konseling :</strong></label>
                                    <label class="col-md-10 s-12">{{ $data->konseling }}</label>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 text-right s-12"><strong>Jawaban :</strong></label>
                                    <label class="col-md-10 s-12">{{ $data->jawaban != null ? $data->jawaban : '-' }}</label>
                                </div>
                                <hr>
                                <form class="needs-validation" action="{{ route('konseling.update', $data->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">
                                            <div class="form-group mt-1" id="alasan_display">
                                                <label for="jawaban" class="form-control label-input-custom col-md-2">Jawaban<span class="text-danger ml-1">*</span></label>
                                                <textarea type="text" rows="4" name="jawaban" id="jawaban" class="form-control r-0 light s-12 col-md-4" autocomplete="off" placeholder="Ketik disini." required>{{ $data->alasan }}</textarea>
                                            </div> 
                                            <div class="form-group mt-2">
                                                <div class="col-md-2"></div>
                                                <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Balas Konseling</button>
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
</div>
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection