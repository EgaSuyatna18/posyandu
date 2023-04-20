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
            <th scope="col">ID Kader</th>
            <th scope="col">Nama Kader</th>
            <th scope="col">Alamat</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kaders as $kader)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $kader->id_kader }}</td>
                    <td>{{ $kader->nama_kader }}</td>
                    <td>{{ $kader->alamat }}</td>
                    <td>{{ $kader->no_telepon }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#lihatModal"
                            onclick="setData2('{{ $kader->nama_kader }}', '{{ $kader->alamat }}', '{{ $kader->no_telepon }}')">
                            Lihat
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $kader->id }}', '{{ $kader->nama_kader }}', '{{ $kader->alamat }}', '{{ $kader->no_telepon }}')">
                            Edit
                        </button>
                        <form action="/kader/{{ $kader->id }}/delete" method="post" class="d-inline">
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
            <form action="/kader" method="post" id="formTambah">
                @csrf
                <div class="mb-3">
                    <label>Nama Kader</label>
                    <input type="text" name="nama_kader" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>No Telepon</label>
                    <input type="number" name="no_telepon" class="form-control">
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
            <form action="/kader" method="post" id="formUbah">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="ubahID">
                <div class="mb-3">
                    <label>Nama Kader</label>
                    <input type="text" name="nama_kader" class="form-control" id="ubahNamaKader">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" id="ubahAlamat"></textarea>
                </div>
                <div class="mb-3">
                    <label>No Telepon</label>
                    <input type="number" name="no_telepon" class="form-control" id="ubahNoTelepon">
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
                    <label>Nama Kader</label>
                    <input type="text" name="nama_kader" class="form-control" id="lihatNamaKader" readonly>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" id="lihatAlamat" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label>No Telepon</label>
                    <input type="number" name="no_telepon" class="form-control" id="lihatNoTelepon" readonly>
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
    function setData(id, namaKader, alamat, noTelepon) {
        ubahID.value = id;
        ubahNamaKader.value = namaKader;
        ubahAlamat.value = alamat;
        ubahNoTelepon.value = noTelepon;
    }

    function setData2(namaKader, alamat, noTelepon) {
        lihatNamaKader.value = namaKader;
        lihatAlamat.value = alamat;
        lihatNoTelepon.value = noTelepon;
    }
</script>
@endsection