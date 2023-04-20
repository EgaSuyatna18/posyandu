@extends('layout.master')
@section('content')
    <div class="container-fluid border border-1 rounded shadow shadow-lg p-4">
        <h3>Data Penimbangan {{ $anak->nama_anak }}</h3>
        <table class="w-25">
            <tr>
                <td>NIK</td>
                <td>: {{ $anak->nik }}</td>
            </tr>
            <tr>
                <td>Nama Anak</td>
                <td>: {{ $anak->nama_anak }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ $anak->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $anak->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>: {{ $anak->ibu->nama_istri }}</td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>: {{ $anak->ibu->nama_suami }}</td>
            </tr>
        </table>
    </div>

<div class="container-fluid border border-1 rounded shadow shadow-lg my-5">
    <div class="container-fluid my-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
            Tambah
        </button>
    </div>

    <table class="table table-striped border border-1 rounded shadow shadow-lg" id="datatables">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Umur</th>
            <th scope="col">Tanggal Imunisasi</th>
            <th scope="col">Vaksin</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anak->imunisasi as $imunisasi)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $imunisasi->umur }}</td>
                    <td>{{ $imunisasi->tanggal_imunisasi }}</td>
                    <td>{{ $imunisasi->vaksin->nama_vaksin }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $imunisasi->id }}', '{{ $imunisasi->tanggal_imunisasi }}', '{{ $imunisasi->vaksin_id }}')">
                            Ubah
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/imunisasi/{{ $anak->id }}" method="post" id="formTambah">
            @csrf
            <div class="mb-3">
              <label>Tanggal Imunisasi</label>
              <input type="date" name="tanggal_imunisasi" class="form-control">
            </div>
            <div class="mb-3">
              <label>Vaksin</label>
              <select name="vaksin_id" class="form-control">
                @foreach ($vaksins as $vaksin)
                    <option value="{{ $vaksin->id }}">{{ $vaksin->nama_vaksin }}</option>
                @endforeach
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="formTambah">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ubahModalLabel">Ubah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/imunisasi/{{ $anak->id }}" method="post" id="formUbah">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <div class="mb-3">
              <label>Tanggal Imunisasi</label>
              <input type="date" name="tanggal_imunisasi" class="form-control" id="ubahTanggalImunisasi">
            </div>
            <div class="mb-3">
              <label>Vaksin</label>
              <select name="vaksin_id" class="form-control" id="ubahVaksinID">
                @foreach ($vaksins as $vaksin)
                    <option value="{{ $vaksin->id }}">{{ $vaksin->nama_vaksin }}</option>
                @endforeach
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="formUbah">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function setData(id, tanggalImunisasi, vaksinID) {
        ubahID.value = id;
        ubahTanggalImunisasi.value = tanggalImunisasi;
        ubahVaksinID.value = vaksinID;
    }
  </script>
@endsection