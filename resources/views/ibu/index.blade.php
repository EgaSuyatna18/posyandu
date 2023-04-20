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
            <th scope="col">Nik</th>
            <th scope="col">Nama Istri</th>
            <th scope="col">Nama Suami</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ibus as $ibu)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $ibu->nik }}</td>
                    <td>{{ $ibu->nama_istri }}</td>
                    <td>{{ $ibu->nama_suami }}</td>
                    <td>{{ $ibu->alamat }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#lihatModal"
                            onclick="setData2('{{ $ibu->nik }}', '{{ $ibu->nama_istri }}', '{{ $ibu->tanggal_lahir }}', '{{ $ibu->alamat }}', '{{ $ibu->telepon }}', '{{ $ibu->golongan_darah }}', '{{ $ibu->nama_suami }}')">
                            Lihat
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $ibu->id }}', '{{ $ibu->nik }}', '{{ $ibu->nama_istri }}', '{{ $ibu->tanggal_lahir }}', '{{ $ibu->alamat }}', '{{ $ibu->telepon }}', '{{ $ibu->golongan_darah }}', '{{ $ibu->nama_suami }}')">
                            Ubah
                        </button>
                        <form action="/ibu/{{ $ibu->id }}/delete" method="post" class="d-inline">
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
            <form action="/ibu" method="post" id="formTambah">
                @csrf
                <div class="mb-3">
                    <label>NIK</label>
                    <input type="number" name="nik" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Nama Istri</label>
                    <input type="text" name="nama_istri" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="number" name="telepon" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Golongan Darah</label>
                    <select name="golongan_darah" class="form-control">
                        <option>A</option>
                        <option>B</option>
                        <option>O</option>
                        <option>AB</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nama Suami</label>
                    <input type="text" name="nama_suami" class="form-control">
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
            <form action="/ibu" method="post" id="formUbah">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="ubahID">
                <div class="mb-3">
                    <label>NIK</label>
                    <input type="number" name="nik" class="form-control" id="ubahNIK">
                </div>
                <div class="mb-3">
                    <label>Nama Istri</label>
                    <input type="text" name="nama_istri" class="form-control" id="ubahNamaIstri">
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="ubahTanggalLahir">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" id="ubahAlamat"></textarea>
                </div>
                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="number" name="telepon" class="form-control" id="ubahTelepon">
                </div>
                <div class="mb-3">
                    <label>Golongan Darah</label>
                    <select name="golongan_darah" class="form-control" id="ubahGolonganDarah">
                        <option>A</option>
                        <option>B</option>
                        <option>O</option>
                        <option>AB</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nama Suami</label>
                    <input type="text" name="nama_suami" class="form-control" id="ubahNamaSuami">
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
                    <label>NIK</label>
                    <input type="number" name="nik" class="form-control" id="lihatNIK" readonly>
                </div>
                <div class="mb-3">
                    <label>Nama Istri</label>
                    <input type="text" name="nama_istri" class="form-control" id="lihatNamaIstri" readonly>
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="lihatTanggalLahir" readonly>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" id="lihatAlamat" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="number" name="telepon" class="form-control" id="lihatTelepon" readonly>
                </div>
                <div class="mb-3">
                    <label>Golongan Darah</label>
                    <select name="golongan_darah" class="form-control" id="lihatGolonganDarah" disabled>
                        <option>A</option>
                        <option>B</option>
                        <option>O</option>
                        <option>AB</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nama Suami</label>
                    <input type="text" name="nama_suami" class="form-control" id="lihatNamaSuami" readonly>
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
    function setData(id, nik, namaIstri, tanggalLahir, alamat, telepon, golonganDarah, namaSuami) {
        ubahID.value = id;
        ubahNIK.value = nik;
        ubahNamaIstri.value = namaIstri;
        ubahTanggalLahir.value = tanggalLahir;
        ubahAlamat.value = alamat;
        ubahTelepon.value = telepon;
        ubahGolonganDarah.value = golonganDarah;
        ubahNamaSuami.value = namaSuami;
    }

    function setData2(nik, namaIstri, tanggalLahir, alamat, telepon, golonganDarah, namaSuami) {
        lihatNIK.value = nik;
        lihatNamaIstri.value = namaIstri;
        lihatTanggalLahir.value = tanggalLahir;
        lihatAlamat.value = alamat;
        lihatTelepon.value = telepon;
        lihatGolonganDarah.value = golonganDarah;
        lihatNamaSuami.value = namaSuami;
    }
</script>
@endsection