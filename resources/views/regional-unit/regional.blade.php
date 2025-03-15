@extends('layouts.general')

@section('css')
<link rel="stylesheet" crossorigin href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
@endsection

@section('title', 'Data Regional')

@section('content')
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add-">
            <i class="bi bi-plus-circle"></i>&nbsp; Add Data
        </button>
        <table class="table table-striped text-center" id="table-detail">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Regional</th>
                    <th>Alias</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $k => $v)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->alias }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $v->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $v->id }})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>

                    <div class="modal fade" id="modal-edit-{{ $v->id }}" tabindex="-1" aria-labelledby="modal-edit-label{{ $v->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-edit-label{{ $v->id }}">Edit Regional</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/regional-unit/regional/store" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $v->id }}">
                                        <div class="mb-3">
                                            <label for="name_{{ $v->id }}" class="form-label">Regional Name</label>
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

                    <form id="deleteForm{{ $v->id }}" action="/regional-unit/regional/delete/{{ $v->id }}" method="GET" style="display: none;">
                        @csrf
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-add-" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-label"Add Regional</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/regional-unit/regional/store" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="name_add" class="form-label">Regional Name</label>
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
        $('#table-detail').DataTable();
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/regional-unit/regional/destroy/' + id;
            }
        })
    }
</script>
@endsection
