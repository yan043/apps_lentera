@extends('layouts.general')

@section('styles')
<link rel="stylesheet" href="/assets/extensions/choices.js/public/assets/styles/choices.css">
<link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('title', 'Order Order Actions')

@section('content')
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
            <i class="bi bi-plus-circle"></i>&nbsp; Add Data
        </button>
        <div class="table-responsive">
            <table class="table table-striped text-center detail-data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Segments</th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $v)
                    <tr>
                        <td>{{ ++$k }}</td>
                        <td>{{ $v->order_segment_name }}</td>
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
                                    <h5 class="modal-title" id="modal-edit-label-{{ $v->id }}">Edit Actions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/reporting-configuration/actions/store" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $v->id }}">
                                        <div class="mb-3">
                                            <label for="order_segment_id_{{ $v->id }}" class="form-label">Segment Name</label>
                                            <select class="choices form-select" id="order_segment_id_{{ $v->id }}" name="order_segment_id" required>
                                                <option value="" disabled>Silahkan Pilih Nama Segment</option>
                                                @foreach($get_order_segment as $order_segment)
                                                    <option value="{{ $order_segment->id }}" {{ $order_segment->id == $v->order_segment_id ? 'selected' : '' }}>
                                                        {{ $order_segment->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_{{ $v->id }}" class="form-label">Action Name</label>
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
</div>

<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-label">Add Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reporting-configuration/actions/store" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="order_segment_id_add" class="form-label">Segment Name</label>
                        <select class="choices form-select" id="order_segment_id_add" name="order_segment_id" required>
                            <option value="" selected disabled>Silahkan Pilih Nama Segment</option>
                            @foreach($get_order_segment as $order_segment)
                                <option value="{{ $order_segment->id }}">{{ $order_segment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_add" class="form-label">Action Name</label>
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
<script src="/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        let choices = document.querySelectorAll(".choices");
        for (let i = 0; i < choices.length; i++) {
            new Choices(choices[i], {
                placeholder: true,
                allowHTML: true,
                removeItemButton: true,
                shouldSort: false
            });
        }

        let jquery_datatable = $(".detail-data-table").DataTable({
            responsive: true
        });

        let customized_datatable = $(".detail-data-table-jquery").DataTable({
            responsive: true,
            pagingType: 'simple',
            dom:
                "<'row'<'col-3'l><'col-9'f>>" +
                "<'row dt-row'<'col-sm-12'tr>>" +
                "<'row'<'col-4'i><'col-8'p>>",
            "language": {
                "info": "Page _PAGE_ of _PAGES_",
                "lengthMenu": "_MENU_ ",
                "search": "",
                "searchPlaceholder": "Search.."
            }
        });

        const setTableColor = () => {
            document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
                dt.classList.add('pagination-primary')
            });
        };

        setTableColor();
        jquery_datatable.on('draw', setTableColor);
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
                window.location.href = '/reporting-configuration/actions/destroy/' + id;
            }
        });
    }
</script>
@endsection
