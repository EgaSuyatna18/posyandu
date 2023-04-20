@extends('layout.master2')
@section('content')
    @foreach (session()->get('ibu')->anak as $anak)
        <div class="container border border-1 shadow shadow-lg rounded mb-4 p-4">
            <p>ID Anak: {{ $anak->id_anak }}</p>
            <p>NIK Anak: {{ $anak->nik }}</p>
            <p>Tanggal Lahir: {{ $anak->tanggal_lahir }}</p>
            <p>Jenis Kelamin: {{ $anak->jenis_kelamin }}</p>
            <div class="text-end">
                <form action="/hasil_penimbangan" method="post">
                    @csrf
                    <input type="hidden" name="nik" value="{{ $anak->nik }}">
                    <button type="submit" class="btn btn-success">Lihat Data Penimbangan</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection