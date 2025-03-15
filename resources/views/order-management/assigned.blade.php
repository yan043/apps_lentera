@extends('layouts.general')

@section('css')
<link rel="stylesheet" crossorigin href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
@endsection

@section('title', 'Assigned Orders')

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-striped text-center" id="table-detail">
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
