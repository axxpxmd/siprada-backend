@extends('layouts.app')
@section('title', '| Dashboard  ')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-dashboard"></i> 
                        Dashboard
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content pb-3" id="v-pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="card">
                            <h6 class="card-header font-weight-bold text-white" style="background: #FFCE3B">Total User</h6>
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="icon-users amber-text fs-40"></i>
                                    <p class="fs-32 mt-3 mb-0"><span class="badge badge-pill badge-light ">{{ $totalUser }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <h6 class="card-header bg-danger font-weight-bold text-white">Total Aspirasi</h6>
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="icon-document-text4 text-danger fs-40"></i>
                                    <p class="fs-32 mt-3 mb-0"><span class="badge badge-pill badge-light ">{{ $totalAspirasi }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card no-b mr-n15">
                            <h6 class="card-header bg-primary font-weight-bold text-white">Total komentar</h6>
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="icon-comments text-primary fs-40"></i>
                                    <p class="fs-32 mt-3 mb-0"><span class="badge badge-pill badge-light ">{{ $totalKomentar }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card no-b mr-n15">
                            <h6 class="card-header bg-success font-weight-bold text-white">Total Perda</h6>
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="icon-documents4 text-success fs-40"></i>
                                    <p class="fs-32 mt-3 mb-0"><span class="badge badge-pill badge-light ">{{ $totalPerda }}</span></p>
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
