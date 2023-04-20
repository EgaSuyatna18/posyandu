@extends('layout.master')
@section('content')
    <div class="container border border-1 shadow shadow-lg rounded p-5">
        <h1>Informasi</h1>
        <form action="/informasi" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ (isset($informasi)) ? $informasi->judul : '' }}">
            </div>
            <div class="mb-3">
                <label>Isi</label>
                <textarea name="isi" class="form-control" style="height: 200px;">{{ (isset($informasi)) ? $informasi->isi : '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-success form-control">Ubah</button>
        </form>
    </div>
@endsection