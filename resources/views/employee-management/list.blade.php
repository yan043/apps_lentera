@extends('layouts.general')

@section('styles')
<link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('title', 'Employee List')

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
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Regional</th>
                        <th>Witel</th>
                        <th>Mitra</th>
                        <th>Sub Unit</th>
                        <th>Sub Group</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->nik }}</td>
                        <td>{{ $v->full_name }}</td>
                        <td>{{ $v->regional_name }}</td>
                        <td>{{ $v->witel_name }}</td>
                        <td>{{ $v->mitra_name }}</td>
                        <td>{{ $v->sub_unit_name }}</td>
                        <td>{{ $v->sub_group_name }}</td>
                        <td>{{ $v->role_name }}</td>
                        <td>
                            @if ($v->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
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
</div>
@endsection

@section('scripts')
<script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
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
</script>
@endsection
