@extends('layout.master2')
@section('content')
    <div class="container border border-1 shadow shadow-lg rounded mt-5">
        <h3 class="text-center">{{ (isset($informasi)) ? $informasi->judul : 'Tidak Ada Info' }}</h3>
        <hr>
        <p>{{ (isset($informasi)) ? $informasi->isi : '' }}</p>
    </div>
@endsection