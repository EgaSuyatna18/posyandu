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
        <th scope="col">Tanggal</th>
        <th scope="col">Nama Anak</th>
        <th scope="col">Nama Ibu</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Umur</th>
        <th scope="col">Nasihat / Isi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pmbas as $pmba)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $pmba->tanggal }}</td>
            <td>{{ $pmba->anak->nama_anak }}</td>
            <td>{{ $pmba->anak->ibu->nama_istri }}</td>
            <td>{{ $pmba->anak->jenis_kelamin }}</td>
            <td>{{ $pmba->umur }}</td>
            <td>{{ $pmba->nasihat }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection