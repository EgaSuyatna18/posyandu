@extends('layout.master')
@section('content')
<div class="border border-1 rounded shadow shadow-lg p-4">
<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">
    Tambah
</button>
    <table class="table table-striped border border-1 rounded shadow shadow-lg" id="datatables">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">ID Anak</th>
            <th scope="col">NIK</th>
            <th scope="col">Nama Anak</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Nama Ibu</th>
            <th scope="col">Jenis Kelamin</th>
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
                    <td>{{ $anak->tanggal_lahir }}</td>
                    <td>{{ $anak->ibu->nama_istri }}</td>
                    <td>{{ $anak->jenis_kelamin }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#lihatModal"
                            onclick="setData2('{{ $anak->ibu->id }}', {{ $anak->nik }},'{{ $anak->nama_anak }}', '{{ $anak->tanggal_lahir }}', '{{ $anak->jenis_kelamin }}', '{{ $anak->bb }}', '{{ $anak->pb }}')">
                            Lihat
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $anak->id }}', '{{ $anak->ibu->id }}', {{ $anak->nik }}, '{{ $anak->nama_anak }}', '{{ $anak->tanggal_lahir }}', '{{ $anak->jenis_kelamin }}', '{{ $anak->bb }}', '{{ $anak->pb }}')">
                            Ubah
                        </button>
                        <form action="/anak/{{ $anak->id }}/delete" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                        </form>
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
            <form action="/anak" method="post" id="formTambah">
                @csrf
                <div class="mb-3">
                    <select name="ibu_id" class="form-control">
                        @foreach ($ibus as $ibu)
                            <option value="{{ $ibu->id }}">{{ $ibu->nik . ' - ' .$ibu->nama_istri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>NIK Anak</label>
                    <input type="text" name="nik" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Nama Anak</label>
                    <input type="text" name="nama_anak" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <div class="d-flex justify-content-evenly">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki">
                            <label class="form-check-label" for="laki">
                            Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan">
                            <label class="form-check-label" for="perempuan">
                            Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>BB</label>
                    <input type="number" name="bb" step="0.01" class="form-control">
                </div>
                <div class="mb-3">
                    <label>PB</label>
                    <input type="number" name="pb" class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" form="formTambah">Submit</button>
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
            <form action="/anak" method="post" id="formUbah">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="ubahID">
                <div class="mb-3">
                    <select name="ibu_id" class="form-control" id="ubahIbuID">
                        @foreach ($ibus as $ibu)
                            <option value="{{ $ibu->id }}">{{ $ibu->nik . ' - ' .$ibu->nama_istri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>NIK Anak</label>
                    <input type="text" name="nik" class="form-control" id="ubahNik">
                </div>
                <div class="mb-3">
                    <label>Nama Anak</label>
                    <input type="text" name="nama_anak" class="form-control" id="ubahNamaAnak">
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="ubahTanggalLahir">
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <div class="d-flex justify-content-evenly">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="ubahLaki" value="Laki-laki">
                            <label class="form-check-label" for="laki">
                            Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="ubahPerempuan" value="perempuan">
                            <label class="form-check-label" for="perempuan">
                            Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>BB</label>
                    <input type="number" name="bb" class="form-control" step="0.01" id="ubahBB">
                </div>
                <div class="mb-3">
                    <label>PB</label>
                    <input type="number" name="pb" class="form-control" id="ubahPB">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" form="formUbah">Submit</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="lihatModal" tabindex="-1" aria-labelledby="lihatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="lihatModalLabel">Lihat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                    <select name="ibu_id" class="form-control" id="lihatIbuID" disabled>
                        @foreach ($ibus as $ibu)
                            <option value="{{ $ibu->id }}">{{ $ibu->nik . ' - ' .$ibu->nama_istri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>NIK Anak</label>
                    <input type="text" name="nik" class="form-control" id="lihatNik" readonly>
                </div>
                <div class="mb-3">
                    <label>Nama Anak</label>
                    <input type="text" name="nama_anak" class="form-control" id="lihatNamaAnak" readonly>
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="lihatTanggalLahir" readonly>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <div class="d-flex justify-content-evenly">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="lihatLaki" value="Laki-laki" disabled>
                            <label class="form-check-label" for="laki">
                            Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="lihatPerempuan" value="perempuan" disabled>
                            <label class="form-check-label" for="perempuan">
                            Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>BB</label>
                    <input type="number" name="bb" class="form-control" step="0.01" id="lihatBB" readonly>
                </div>
                <div class="mb-3">
                    <label>PB</label>
                    <input type="number" name="pb" class="form-control" id="lihatPB" readonly>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<script>
    function setData(id, ibuID, nik, namaAnak, tanggalLahir, jenisKelamin, bb, pb) {
        ubahID.value = id;
        ubahIbuID.value = ibuID;
        ubahNik.value = nik;
        ubahNamaAnak.value = namaAnak;
        ubahTanggalLahir.value = tanggalLahir;
        if(jenisKelamin == 'Laki-laki') {
            ubahLaki.checked = true;
        }else if(jenisKelamin == 'Perempuan') {
            ubahPerempuan.checked = true;
        }
        ubahBB.value = bb;
        ubahPB.value = pb;
    }

    function setData2(ibuID, nik, namaAnak, tanggalLahir, jenisKelamin, bb, pb) {
        lihatIbuID.value = ibuID;
        lihatNik.value = nik;
        lihatNamaAnak.value = namaAnak;
        lihatTanggalLahir.value = tanggalLahir;
        if(jenisKelamin == 'Laki-laki') {
            lihatLaki.checked = true;
        }else if(jenisKelamin == 'Perempuan') {
            lihatPerempuan.checked = true;
        }
        lihatBB.value = bb;
        lihatPB.value = pb;
    }
</script>
@endsection