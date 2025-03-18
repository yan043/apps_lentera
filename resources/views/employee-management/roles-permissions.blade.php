@extends('layouts.general')

@section('css')
<link rel="stylesheet" crossorigin href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
@endsection

@section('title', 'Roles & Permissions')

@section('content')
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
            <i class="bi bi-plus-circle"></i>&nbsp; Add Data
        </button>
        <table class="table table-striped text-center" id="table-detail">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $k => $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->name }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $v->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $v->id }})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
</script>
@endsection
