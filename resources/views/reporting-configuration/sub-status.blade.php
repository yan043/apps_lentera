@extends('layouts.general')

@section('css')
<link rel="stylesheet" crossorigin href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
@endsection

@section('title', 'Order Sub-Status')

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
                    <th>Status</th>
                    <th>Sub-Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $k => $v)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td>{{ $v->order_status_name }}</td>
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

                <div class="modal fade" id="modal-edit-{{ $v->id }}" tabindex="-1" aria-labelledby="modal-edit-label-{{ $v->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-label-{{ $v->id }}">Edit Order Sub-Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/reporting-configuration/sub-status/store" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                    <div class="mb-3">
                                        <label for="order_status_id_{{ $v->id }}" class="form-label">Status Name</label>
                                        <select class="choices form-select" id="order_status_id_{{ $v->id }}" name="order_status_id" required>
                                            <option value="" disabled>Silahkan Pilih Nama Status</option>
                                            @foreach($get_order_status as $order_status)
                                                <option value="{{ $order_status->id }}" {{ $order_status->id == $v->order_status_id ? 'selected' : '' }}>
                                                    {{ $order_status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name_{{ $v->id }}" class="form-label">Sub-Status Name</label>
                                        <input type="text" class="form-control" id="name_{{ $v->id }}" name="name" value="{{ $v->name }}" required>
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

<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-label">Add Sub-Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reporting-configuration/sub-status/store" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="order_status_id_add" class="form-label">Status Name</label>
                        <select class="choices form-select" id="order_status_id_add" name="order_status_id" required>
                            <option value="" selected disabled>Silahkan Pilih Nama Status</option>
                            @foreach($get_order_status as $order_status)
                                <option value="{{ $order_status->id }}">{{ $order_status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_add" class="form-label">Sub-Status Name</label>
                        <input type="text" class="form-control" id="name_add" name="name" required>
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

        let choices = document.querySelectorAll(".choices");
        for (let i = 0; i < choices.length; i++) {
            new Choices(choices[i], {
                placeholder: true,
                allowHTML: true,
                removeItemButton: true,
                shouldSort: false
            });
        }
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
                window.location.href = '/reporting-configuration/sub-status/destroy/' + id;
            }
        });
    }
</script>
@endsection
