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
            <th scope="col">Tanggal Penyuluhan</th>
            <th scope="col">Materi</th>
            <th scope="col">Media</th>
            <th scope="col">Dokumentasi</th>
            <th scope="col">Kader</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penyuluhans as $penyuluhan)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $penyuluhan->tanggal_penyuluhan }}</td>
                    <td>{{ $penyuluhan->materi }}</td>
                    <td>{{ $penyuluhan->media }}</td>
                    <td><a href="{{ asset('/storage/' . $penyuluhan->dokumentasi) }}">Download</a></td>
                    <td>{{ $penyuluhan->kader->nama_kader }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $penyuluhan->id }}', '{{ $penyuluhan->tanggal_penyuluhan }}', '{{ $penyuluhan->materi }}', '{{ $penyuluhan->media }}', '{{ $penyuluhan->kader->id }}')">
                            Ubah
                        </button>
                        <form action="/penyuluhan/{{ $penyuluhan->id }}/delete" method="post" class="d-inline">
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
            <form action="/penyuluhan" method="post" id="formTambah" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Kader</label>
                    <select name="kader_id" class="form-control">
                        @foreach ($kaders as $kader)
                            <option value="{{ $kader->id }}">{{ $kader->nama_kader }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Tanggal Penyluhan</label>
                    <input type="date" name="tanggal_penyuluhan" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Materi</label>
                    <input type="text" name="materi" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Media</label>
                    <input type="text" name="media" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Dokumentasi</label>
                    <input type="file" name="dokumentasi" class="form-control">
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
            <form action="/penyuluhan" method="post" id="formUbah" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="ubahID">
                <div class="mb-3">
                    <label>Kader</label>
                    <select name="kader_id" class="form-control" id="ubahKaderID">
                        @foreach ($kaders as $kader)
                            <option value="{{ $kader->id }}">{{ $kader->nama_kader }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Tanggal Penyluhan</label>
                    <input type="date" name="tanggal_penyuluhan" class="form-control" id="ubahTanggalPenyuluhan">
                </div>
                <div class="mb-3">
                    <label>Materi</label>
                    <input type="text" name="materi" class="form-control" id="ubahMateri">
                </div>
                <div class="mb-3">
                    <label>Media</label>
                    <input type="text" name="media" class="form-control" id="ubahMedia">
                </div>
                <div class="mb-3">
                    <label>Dokumentasi</label>
                    <input type="file" name="dokumentasi" class="form-control">
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
    function setData(id, tanggalPenyuluhan, materi, media, kaderID) {
        ubahID.value = id;
        ubahKaderID.value = kaderID;
        ubahTanggalPenyuluhan.value = tanggalPenyuluhan;
        ubahMateri.value = materi;
        ubahMedia.value = media;
    }

</script>
@endsection