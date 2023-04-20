@extends('layout.master')
@section('content')
<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">
    Tambah
</button>
    <table class="table table-striped border border-1 rounded shadow shadow-lg" id="datatables">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama User</th>
            <th scope="col">Email</th>
            <th scope="col">Foto</th>
            <th scope="col">Role</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img src="{{ ($user->foto == '/assets/img/default-photo.png') ? asset('assets/img/default-photo.png') : asset('/storage/' . $user->foto) }}" alt="fotoRahasia" class="img-fluid" style="width: 100px;"></td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $user->id }}', '{{ $user->role }}', '{{ $user->name }}', '{{ $user->email }}')">
                            Ubah
                        </button>
                        <form action="/user/{{ $user->id }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/user" method="post" id="formTambah" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="kader">Kader</option>
                        <option value="bidan">Bidan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nama User</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control">
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
            <form method="post" id="formUbah" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="ubahID">
                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control" id="ubahRole">
                        <option value="admin">Admin</option>
                        <option value="kader">Kader</option>
                        <option value="bidan">Bidan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Nama User</label>
                    <input type="text" name="name" class="form-control" id="ubahName">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" id="ubahEmail">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" placeholder="kosongkan jika tidak ingin diubah">
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
    function setData(id, role, name, email) {
        formUbah.action = '/user/' + id;
        ubahID.value = id;
        ubahRole.value = role;
        ubahName.value = name;
        ubahEmail.value = email;
    }
</script>
@endsection