@extends('layouts.general')

@section('css')
<link rel="stylesheet" crossorigin href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
@endsection

@section('title', 'Data Witel')

@section('content')
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-circle"></i>&nbsp; Tambah Data
        </button>
        <table class="table table-striped text-center" id="table1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Regional</th>
                    <th>Witel</th>
                    <th>Alias</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $k => $v)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td>{{ $v->regional_name }}</td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->alias }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $v->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $v->id }})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $v->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $v->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $v->id }}">Edit Witel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/regional-unit/witel/store" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                    <div class="mb-3">
                                        <label for="regional_id_{{ $v->id }}" class="form-label">Regional</label>
                                        <select class="choices form-select" style="width: 100%;" id="regional_id_{{ $v->id }}" name="regional_id" required>
                                            <option value="" disabled>Silahkan Pilih Regional</option>
                                            @foreach($get_regional as $regional)
                                                <option value="{{ $regional->id }}" {{ $regional->id == $v->regional_id ? 'selected' : '' }}>
                                                    {{ $regional->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name_{{ $v->id }}" class="form-label">Nama Witel</label>
                                        <input type="text" class="form-control" id="name_{{ $v->id }}" name="name" value="{{ $v->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alias_{{ $v->id }}" class="form-label">Alias</label>
                                        <input type="text" class="form-control" id="alias_{{ $v->id }}" name="alias" value="{{ $v->alias }}" required>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i>&nbsp; Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Witel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/regional-unit/witel/store" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="regional_id_add" class="form-label">Regional</label>
                        <select class="choices form-select`" style="width: 100%;" id="regional_id_add" name="regional_id" required>
                            <option></option>
                            @foreach($get_regional as $regional)
                                <option value="{{ $regional->id }}">{{ $regional->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_add" class="form-label">Nama Witel</label>
                        <input type="text" class="form-control" id="name_add" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="alias_add" class="form-label">Alias</label>
                        <input type="text" class="form-control" id="alias_add" name="alias" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i>&nbsp; Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable();
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
@endsection
