@extends('layouts')

@section('styles')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<style>
    .dashboard-header {
        margin-bottom: 1.5rem;
    }

    .summary-card {
        border-radius: 1rem;
        padding: 1rem;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .summary-card .icon {
        font-size: 2rem;
        opacity: 0.8;
    }
    .bg-gradient-blue { background: linear-gradient(45deg,#4e73df,#224abe); }
    .bg-gradient-green { background: linear-gradient(45deg,#1cc88a,#0f9d58); }
    .bg-gradient-orange { background: linear-gradient(45deg,#f6c23e,#e59400); }
    .bg-gradient-red { background: linear-gradient(45deg,#e74a3b,#be2617); }

    .table-modern thead {
        background-color: #f8f9fc;
    }
    .table-modern tbody tr:hover {
        background-color: #f1f5fb;
        transition: 0.2s;
    }

    .badge-status {
        padding: 0.4em 0.8em;
        border-radius: 20px;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('title', 'Helpdesk Monitoring')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="summary-card bg-gradient-blue">
            <div>
                <h6>Total Active</h6>
                <h4>120</h4>
            </div>
            <div class="icon"><i class="bi bi-check-circle"></i></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="summary-card bg-gradient-green">
            <div>
                <h6>Processing</h6>
                <h4>80</h4>
            </div>
            <div class="icon"><i class="bi bi-hourglass-split"></i></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="summary-card bg-gradient-orange">
            <div>
                <h6>Pending</h6>
                <h4>45</h4>
            </div>
            <div class="icon"><i class="bi bi-exclamation-triangle"></i></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="summary-card bg-gradient-red">
            <div>
                <h6>On Hold</h6>
                <h4>25</h4>
            </div>
            <div class="icon"><i class="bi bi-pause-circle"></i></div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle text-center detail-data-table">
                <thead>
                    <tr>
                        <th>Field 1</th>
                        <th>Field 2</th>
                        <th>Field 3</th>
                        <th>Field 4</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td><span class="badge-status bg-danger text-white">Inactive</span></td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td><span class="badge-status bg-success">Active</span></td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td><span class="badge-status bg-warning text-dark">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td><span class="badge-status bg-info text-dark">Processing</span></td>
                    </tr>
                    <tr>
                        <td>Isi Field 1</td>
                        <td>Isi Field 2</td>
                        <td>Isi Field 3</td>
                        <td>Isi Field 4</td>
                        <td><span class="badge-status bg-secondary">On Hold</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/assets/libs/select2/js/select2.min.js"></script>
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(document).ready(function()
    {
        let jquery_datatable = $(".detail-data-table").DataTable({
            responsive: true,
            pageLength: 5,
            language: {
                searchPlaceholder: "Cari data...",
                search: "",
                lengthMenu: "_MENU_ data per halaman",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data"
            }
        });
    });
</script>
@endsection
