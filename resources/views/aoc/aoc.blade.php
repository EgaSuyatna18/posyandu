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
            <th scope="col">Tanggal Pemberian</th>
            <th scope="col">Vitamin A</th>
            <th scope="col">Obat Cacing</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anak->aoc as $aoc)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $aoc->umur }}</td>
                    <td>{{ $aoc->tanggal_pemberian }}</td>
                    <td>{{ $aoc->vitamin_a }}</td>
                    <td>{{ ($aoc->obat_cacing == 1) ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $aoc->id }}', '{{ $aoc->tanggal_pemberian }}', '{{ $aoc->vitamin_a }}', '{{ $aoc->obat_cacing }}')">
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
          <form action="/aoc/{{ $anak->id }}" method="post" id="formTambah">
            @csrf
            <div class="mb-3">
              <label>Tanggal Pemberian</label>
              <input type="date" name="tanggal_pemberian" class="form-control">
            </div>
            <div class="mb-3">
              <label>Vitamin A</label>
              <input type="text" name="vitamin_a" class="form-control">
            </div>
            <div class="mb-3">
              <label>Obat Cacing</label>
              <div class="d-flex justify-content-evenly">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="obat_cacing" id="ya" value="true">
                  <label class="form-check-label" for="ya">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="obat_cacing" id="tidak" value="false">
                  <label class="form-check-label" for="tidak">Tidak</label>
                </div>
              </div>
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
          <form action="/aoc/{{ $anak->id }}" method="post" id="formUbah">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <div class="mb-3">
              <label>Tanggal Pemberian</label>
              <input type="date" name="tanggal_pemberian" class="form-control" id="ubahTanggalPemberian">
            </div>
            <div class="mb-3">
              <label>Vitamin A</label>
              <input type="text" name="vitamin_a" class="form-control" id="ubahVitaminA">
            </div>
            <div class="mb-3">
              <label>Obat Cacing</label>
              <div class="d-flex justify-content-evenly">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="obat_cacing" id="ubahYA" value="true">
                  <label class="form-check-label" for="ya">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="obat_cacing" id="ubahTidak" value="false">
                  <label class="form-check-label" for="tidak">Tidak</label>
                </div>
              </div>
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
    function setData(id, tanggalPemberian, vitaminA, obatCacing) {
        ubahID.value = id;
        ubahTanggalPemberian.value = tanggalPemberian;
        ubahVitaminA.value = vitaminA;
        if(obatCacing == '1') {
          ubahYA.checked = true;
        }else {
          ubahTidak.checked = true;
        }
    }
  </script>
@endsection