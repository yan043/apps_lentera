@extends('layouts')

@section('styles')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<style>
    .detail-data-table th,
    .detail-data-table td {
        text-align: center !important;
        vertical-align: middle !important;
    }
    .detail-data-table a {
        color: inherit !important;
        text-decoration: none !important;
        cursor: pointer;
    }
    .detail-data-table a:hover {
        color: inherit !important;
        text-decoration: none !important;
    }
    .dataTables_wrapper .dataTables_scroll {
        overflow-x: auto;
    }
</style>
@endsection

@section('title', 'New Order Details')

@section('content')


<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped detail-data-table" id="newOrderDetailsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Incident</th>
                        <th>Reported Date</th>
                        <th>Customer Segment</th>
                        <th>Workzone</th>
                        <th>Status</th>
                        <th>Customer Type</th>
                        <th>Contact Phone</th>
                        <th>Customer Name</th>
                        <th>Service No</th>
                        <th>ODP Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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
$(document).ready(function() {
    function getUrlVars() {
        let vars = {}, parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
            function(m,key,value) {
                vars[key] = decodeURIComponent(value);
            }
        );
        return vars;
    }
    let params = getUrlVars();

    let pathSegments = window.location.pathname.split('/');
    let sourcedata = params.sourcedata || pathSegments[4];
    let workzone = params.workzone || pathSegments[5];
    let ttr = params.ttr || pathSegments[6];
    let startdate = params.startdate || pathSegments[7];
    let enddate = params.enddate || pathSegments[8];

    $('#newOrderDetailsTable').DataTable({
        scrollX: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: '/ajax/order-management/new/details',
            type: 'GET',
            data: {
                sourcedata: sourcedata,
                workzone: workzone,
                ttr: ttr,
                startdate: startdate,
                enddate: enddate
            },
            dataSrc: ''
        },
        columns: [
            { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
            { data: 'incident' },
            { data: 'reported_date' },
            { data: 'customer_segment' },
            { data: 'workzone' },
            { data: 'status' },
            { data: 'customer_type' },
            { data: 'contact_phone' },
            { data: 'customer_name' },
            { data: 'service_no' },
            { data: 'odp_name' },
            {
                data: null,
            }
        ]
    });
});
</script>
@endsection
