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
        <th scope="col">Tanggal Pemberian</th>
        <th scope="col">Nama Anak</th>
        <th scope="col">Nama Ibu</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Umur</th>
        <th scope="col">Vitamin A</th>
        <th scope="col">Obat Cacing</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($aocs as $aoc)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $aoc->tanggal_pemberian }}</td>
            <td>{{ $aoc->anak->nama_anak }}</td>
            <td>{{ $aoc->anak->ibu->nama_istri }}</td>
            <td>{{ $aoc->anak->jenis_kelamin }}</td>
            <td>{{ $aoc->umur }}</td>
            <td>{{ $aoc->vitamin_a }}</td>
            <td>{{ ($aoc->obat_cacing == '1') ? 'Ya' : 'Tidak' }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection