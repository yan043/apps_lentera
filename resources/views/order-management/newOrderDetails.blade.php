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

<div class="modal fade" id="modal-assign" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="assign-form" action="#" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Assign Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="incident" class="form-label">Incident</label>
                            <input type="text" name="incident" id="incident" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="service_no" class="form-label">Service No</label>
                            <input type="text" name="service_no" id="service_no" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" disabled>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="text" name="contact_phone" id="contact_phone" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="odp_name" class="form-label">ODP Name</label>
                            <input type="text" name="odp_name" id="odp_name" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <textarea name="summary" id="summary" class="form-control" rows="4" disabled></textarea>
                </div>
                <div class="mb-3">
                    <label for="sector_id" class="form-label">Sector</label>
                    <select name="sector_id" id="sector_id" class="form-control select2" style="width: 100%"></select>
                </div>
                <div class="mb-3">
                    <label for="team_id" class="form-label">Team</label>
                    <select name="team_id" id="team_id" class="form-control select2" style="width: 100%"></select>
                </div>
                <div class="mb-3">
                    <label for="assign_date" class="form-label">Assign Date</label>
                    <input type="date" name="assign_date" id="assign_date" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>&nbsp; Assign</button>
            </div>
        </form>
    </div>
</div>

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
    function maskText(text, masked = 3)
    {
        return text
            .toUpperCase()
            .split(' ')
            .map(word =>
            {
                if (word.length <= masked)
                {
                    return '*'.repeat(word.length);
                }

                return word.substring(0, word.length - masked) + '*'.repeat(masked);
            })
            .join(' ');
    }

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
            {
                data: 'contact_phone',
                render: function(data, type, row) {
                    return maskText(data || '');
                }
            },
            {
                data: 'customer_name',
                render: function(data, type, row) {
                    return maskText(data || '');
                }
            },
            { data: 'service_no' },
            { data: 'odp_name' },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <button type="button" class="btn btn-sm btn-primary btn-assign"
                            data-incident="${row.incident}"
                            data-customer_name="${row.customer_name}"
                            data-contact_phone="${row.contact_phone}"
                            data-service_no="${row.service_no}"
                            data-odp_name="${row.odp_name}"
                            data-summary="${row.summary || ''}"
                            data-bs-toggle="modal" data-bs-target="#modal-assign">
                            <i class="fas fa-paper-plane"></i>
                            &nbsp;
                            Assign
                        </button>
                    `;
                }
            }
        ]
    });

    $('.select2').select2({
        dropdownParent: $('#modal-assign')
    });

    $('#sector_id').select2({
        dropdownParent: $('#modal-assign'),
        ajax: {
            url: '/ajax/sector',
            processResults: data => ({
                results: data.map(item => ({ id: item.id, text: item.name }))
            }),
            cache: true
        }
    });

    $('#sector_id').on('change', function () {
        let id = $(this).val();
        $('#team_id').val(null).trigger('change');
        $('#team_id').select2({
            dropdownParent: $('#modal-assign'),
            ajax: {
                url: `/ajax/${id}/team`,
                processResults: data => ({
                    results: data.map(item => ({ id: item.id, text: item.name }))
                }),
                cache: true
            }
        });
    });

    $(document).on('click', '.btn-assign', function () {
        let customerName = String($(this).data('customer_name') || '');
        let contactPhone = String($(this).data('contact_phone') || '');

        $('#assign-form input[name="incident"]').val($(this).data('incident'));
        $('#assign-form input[name="customer_name"]').val(maskText(customerName));
        $('#assign-form input[name="contact_phone"]').val(maskText(contactPhone));
        $('#assign-form input[name="service_no"]').val($(this).data('service_no'));
        $('#assign-form input[name="odp_name"]').val($(this).data('odp_name'));
        $('#assign-form textarea[name="summary"]').val($(this).data('summary'));
    });


});
</script>
@endsection
