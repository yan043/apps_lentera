@extends('layouts.general')

@section('styles')
<link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/table-datatable-jquery.css">
@endsection

@section('title', 'Technician Performance')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center detail-data-table">
                <thead>
                    <tr>
                        <th>Field 1</th>
                        <th>Field 2</th>
                        <th>Field 3</th>
                        <th>Field 4</th>
                        <th>Field 5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td>
                            <span class="badge bg-danger">Inactive</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td>
                            <span class="badge bg-warning">Pending</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td>
                            <span class="badge bg-info">Processing</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td>
                            <span class="badge bg-secondary">On Hold</span>
                        </td>
                    </tr>
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
