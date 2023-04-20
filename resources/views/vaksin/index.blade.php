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
            <th scope="col">Nama Vaksin</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vaksins as $vaksin)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $vaksin->nama_vaksin }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $vaksin->id }}', '{{ $vaksin->nama_vaksin }}')">
                            Ubah
                        </button>
                        <form action="/vaksin/{{ $vaksin->id }}/delete" method="post" class="d-inline">
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
            <form action="/vaksin" method="post" id="formTambah">
                @csrf
                <div class="mb-3">
                    <label>Nama Vaksin</label>
                    <input type="text" name="nama_vaksin" class="form-control">
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
            <form action="/vaksin" method="post" id="formUbah">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="ubahID">
                <div class="mb-3">
                    <label>Nama Vaksin</label>
                    <input type="text" name="nama_vaksin" class="form-control" id="ubahNamaVaksin">
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

<script>
    function setData(id, namaVaksin) {
        ubahID.value = id;
        ubahNamaVaksin.value = namaVaksin;
    }
</script>
@endsection