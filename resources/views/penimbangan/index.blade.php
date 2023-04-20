@extends('layout.master')
@section('content')
<div class="border border-1 rounded shadow shadow-lg p-4">
<table class="table table-striped border border-1 rounded shadow shadow-lg" id="datatables">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">ID Anak</th>
        <th scope="col">NIK</th>
        <th scope="col">Nama Anak</th>
        <th scope="col">Nama Ibu</th>
        <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anaks as $anak)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td>{{ $anak->id_anak }}</td>
                <td>{{ $anak->nik }}</td>
                <td>{{ $anak->nama_anak }}</td>
                <td>{{ $anak->ibu->nama_istri }}</td>
                <td>
                    <a href="/penimbangan/{{ $anak->id }}" class="btn btn-info">Penimbangan</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection