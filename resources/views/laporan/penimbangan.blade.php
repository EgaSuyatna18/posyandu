@extends('layout.master')
@section('content')
<div class="table-responsive border border-1 rounded shadow shadow-lg p-4">
  <table border="0" cellspacing="5" cellpadding="5" class="mb-4">
    <tbody>
      <tr>
          <td>Minimum date:</td>
          <td><input type="text" id="min" name="min"></td>
      </tr>
      <tr>
          <td>Maximum date:</td>
          <td><input type="text" id="max" name="max"></td>
      </tr>
    </tbody>
  </table>
<table class="table table-striped border border-1 shadow shadow-lg rounded" id="dtReport">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal Timbang</th>
        <th scope="col">NIK</th>
        <th scope="col">Nama Anak</th>
        <th scope="col">Nama Ibu</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Umur</th>
        <th scope="col">BB</th>
        <th scope="col">PB</th>
        <th scope="col">LK</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($penimbangans as $penimbangan)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $penimbangan->tanggal_timbang }}</td>
            <td>{{ $penimbangan->anak->ibu->nik }}</td>
            <td>{{ $penimbangan->anak->nama_anak }}</td>
            <td>{{ $penimbangan->anak->ibu->nama_istri }}</td>
            <td>{{ $penimbangan->anak->jenis_kelamin }}</td>
            <td>{{ $penimbangan->umur }}</td>
            <td>{{ $penimbangan->bb }}</td>
            <td>{{ $penimbangan->pb }}</td>
            <td>{{ $penimbangan->lk }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection