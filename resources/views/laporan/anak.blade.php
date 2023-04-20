@extends('layout.master')
@section('content')
<div class="table-responsive border border-1 rounded shadow shadow-lg p-4">
<table class="table table-striped border border-1 shadow shadow-lg rounded" id="dtReport">
    <thead>
      <tr>
        <th>No</th>
        <th scope="col">NIK</th>
        <th scope="col">Nama Anak</th>
        <th scope="col">Tanggal Lahir</th>
        <th scope="col">Nama Ibu</th>
        <th scope="col">Nama Ayah</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">BB Lahir</th>
        <th scope="col">PB Lahir</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($anaks as $anak)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $anak->ibu->nik }}</td>
            <td>{{ $anak->nama_anak }}</td>
            <td>{{ $anak->tanggal_lahir }}</td>
            <td>{{ $anak->ibu->nama_istri }}</td>
            <td>{{ $anak->ibu->nama_suami }}</td>
            <td>{{ $anak->jenis_kelamin }}</td>
            <td>{{ $anak->bb }}</td>
            <td>{{ $anak->pb }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection