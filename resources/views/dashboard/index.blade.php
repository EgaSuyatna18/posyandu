@extends('layout.master')
@section('content')
    <h3>Wellcome back, {{ auth()->user()->name }}!</h3>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <i class="fa fa-baby fa-2xl fa-2xl me-auto"></i>
                        Anak
                    <h3>{{ $anak }}</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/anak">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <i class="fa fa-person-breastfeeding fa-2xl me-auto"></i>
                        Ibu
                    <h3>{{ $ibu }}</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/ibu">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <i class="fa fa-scale-balanced fa-2xl me-auto"></i>
                        Penimbangan
                    <h3>{{ $penimbangan }}</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/penimbangan">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <i class="fa fa-eye-dropper fa-2xl me-auto"></i>
                        Imunisasi
                    <h3>{{ $imunisasi }}</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/imunisasi">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
@endsection