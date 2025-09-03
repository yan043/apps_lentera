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
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        padding-left: 4px !important;
        padding-right: 4px !important;
        font-size: 12px !important;
    }
    .detail-data-table tr {
        height: 22px
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
    #filter-form .form-control,
    #filter-form .select2-container .select2-selection--single {
        height: 38px !important;
        min-height: 38px !important;
        box-sizing: border-box;
        font-size: 14px;
    }
    #filter-form .input-group-text {
        height: 38px !important;
        min-height: 38px !important;
        padding-top: 6px;
        padding-bottom: 6px;
    }
    #filter-form .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
    }
    #filter-form .select2-container--default .select2-selection--single {
        line-height: 38px !important;
    }
    .card-body {
        border-radius: 50px / 25px !important;
    }
</style>
@endsection

@section('title', 'Assigned Orders')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end" id="filter-form">
            <div class="col-md-4">
                <label for="start_date" class="form-label fw-bold">Start Date</label>
                <div class="input-group" id="start_date">
                    <input type="text" class="form-control" id="start_date_input" name="start_date" placeholder="yyyy-mm-dd"
                        data-date-format="yyyy-mm-dd" data-date-container='#start_date' data-provide="datepicker" data-date-autoclose="true" value="{{ old('start_date') ?: date('Y-m-01') }}">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label fw-bold">End Date</label>
                <div class="input-group" id="end_date">
                    <input type="text" class="form-control" id="end_date_input" name="end_date" placeholder="yyyy-mm-dd"
                        data-date-format="yyyy-mm-dd" data-date-container='#end_date' data-provide="datepicker" data-date-autoclose="true" value="{{ old('end_date') ?: date('Y-m-d') }}">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-4">
                <label for="sourcedata" class="form-label fw-bold">Source Data</label>
                <select class="form-control select2" id="sourcedata" name="sourcedata" style="width: 100%">
                    <option value="">All Source</option>
                    <option value="insera">Insera</option>
                    <option value="manual">Manual</option>
                    <option value="bima">Bima</option>
                </select>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center detail-data-table" id="assignedOrdersTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Assign Date</th>
                        <th>Sub Status</th>
                        <th>Service Area</th>
                        <th>Team</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reassign" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="reassign-form" action="{{ route('work-order-management.updateOrInsertOrder') }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="order_code" id="order_code">
            <input type="hidden" name="order_id" id="order_id">
            <input type="hidden" name="assign_notes" id="assign_notes">
            <div class="modal-header">
                <h5 class="modal-title">Re-Assign Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="order_code" class="form-label">Order Code</label>
                            <input type="text" name="order_code" id="order_code" class="form-control" disabled>
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
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" class="form-control" rows="4" disabled></textarea>
                </div>
                <div class="mb-3">
                    <label for="service_area_id" class="form-label">Service Area</label>
                    <select name="service_area_id" id="service_area_id" class="form-control select2" style="width: 100%"></select>
                </div>
                <div class="mb-3">
                    <label for="team_id" class="form-label">Team</label>
                    <select name="team_id" id="team_id" class="form-control select2" style="width: 100%"></select>
                </div>
                <div class="mb-3">
                    <label for="assign_labels" class="form-label">Assign Labels</label>
                    <select name="assign_labels[]" id="assign_labels" class="form-control select2" multiple="multiple" style="width: 100%"></select>
                </div>
                <div class="mb-3">
                    <label for="assign_date" class="form-label">Assign Date</label>
                    <div class="input-group" id="assign_date_picker">
                        <input type="text" name="assign_date" id="assign_date" class="form-control" placeholder="yyyy-mm-dd"
                            data-date-format="yyyy-mm-dd" data-date-container='#assign_date_picker' data-provide="datepicker" data-date-autoclose="true" required autocomplete="off">
                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>&nbsp; Re-Assign</button>
            </div>
        </form>
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
    function maskText(text, masked = 3) {
        if (!text) return '';
        return String(text)
            .toUpperCase()
            .split(' ')
            .map(word => {
                if (word.length <= masked) {
                    return '*'.repeat(word.length);
                }
                return word.substring(0, word.length - masked) + '*'.repeat(masked);
            })
            .join(' ');
    }

    $(document).ready(function() {
        $('.select2').select2();

        $('#start_date_input, #end_date_input').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        let table = $('#assignedOrdersTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '/ajax/work-order-management/assigned/details',
                type: 'GET',
                data: function(d) {
                    d.sourcedata = $('#sourcedata').val() || null;
                    d.startdate = $('#start_date_input').val() || "{{ date('Y-m-01') }}";
                    d.enddate = $('#end_date_input').val() || "{{ date('Y-m-d') }}";
                },
                dataSrc: ''
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { data: 'order_code' },
                { data: 'assign_date', defaultContent: '-' },
                { data: 'order_substatus_name', defaultContent: '-' },
                { data: 'service_area_name' },
                { data: 'team_name' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-sm btn-warning btn-reassign"
                                data-order_code="${row.order_code}"
                                data-order_id="${row.order_id}"
                                data-team_id="${row.team_id}"
                                data-team_name="${row.team_name || ''}"
                                data-service_area_id="${row.service_area_id}"
                                data-service_area_name="${row.service_area_name || ''}"
                                data-assign_labels='${row.assign_labels}'
                                data-assign_date="${row.assign_date}"
                                data-assign_notes="${row.assign_notes || ''}"
                                data-service_no="${row.service_no || ''}"
                                data-customer_name="${row.customer_name || ''}"
                                data-contact_phone="${row.contact_phone || ''}"
                                data-odp_name="${row.odp_name || ''}"
                                data-bs-toggle="modal" data-bs-target="#modal-reassign">
                                <i class="fas fa-sync-alt"></i> Re-Assign
                            </button>
                        `;
                    }
                }
            ],
            responsive: true
        });

        $('#filter-form').on('change', 'input, select', function() {
            table.ajax.reload();
        });

        $('#service_area_id').select2({
            dropdownParent: $('#modal-reassign'),
            allowClear: true,
            placeholder: "Pilih Service Area",
            ajax: {
                url: '/ajax/organization-structure/service-area',
                processResults: data => ({
                    results: data.map(item => ({ id: item.id, text: item.name }))
                }),
                cache: true
            }
        });

        $('#team_id').select2({
            dropdownParent: $('#modal-reassign'),
            allowClear: true,
            placeholder: "Pilih Team"
        });

        $('#service_area_id').on('change', function () {
            let id = $(this).val();
            $('#team_id').val(null).trigger('change');
            $('#team_id').select2({
                dropdownParent: $('#modal-reassign'),
                allowClear: true,
                placeholder: "Pilih Team",
                ajax: {
                    url: `/ajax/organization-structure/team`,
                    data: function(params) {
                        return {
                            service_area_id: id,
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        let filtered = data.filter(item => item.service_area_id == id);
                        return {
                            results: filtered.map(item => ({ id: item.id, text: item.name }))
                        };
                    },
                    cache: true
                }
            });
        });

        $('#assign_labels').select2({
            dropdownParent: $('#modal-reassign'),
            allowClear: true,
            placeholder: "Pilih Assign Labels",
            ajax: {
                url: '/ajax/reporting-configuration/labels',
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.name,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });

        $(document).on('click', '.btn-reassign', function () {
            let serviceAreaId = $(this).data('service_area_id') || null;
            let teamId = $(this).data('team_id') || null;
            let serviceAreaText = $(this).data('service_area_name') || '';
            let teamText = $(this).data('team_name') || '';

            if (serviceAreaId) {
                if ($('#service_area_id option[value="' + serviceAreaId + '"]').length === 0) {
                    let newOption = new Option(serviceAreaText, serviceAreaId, true, true);
                    $('#service_area_id').append(newOption).trigger('change');
                } else {
                    $('#service_area_id').val(serviceAreaId).trigger('change');
                }
            } else {
                $('#service_area_id').val(null).trigger('change');
            }

            if (teamId) {
                if ($('#team_id option[value="' + teamId + '"]').length === 0) {
                    let newOption = new Option(teamText, teamId, true, true);
                    $('#team_id').append(newOption).trigger('change');
                } else {
                    $('#team_id').val(teamId).trigger('change');
                }
            } else {
                $('#team_id').val(null).trigger('change');
            }

            let labels = [];
            let rawLabels = $(this).data('assign_labels');
            if (typeof rawLabels === 'string' && rawLabels.length > 0) {
                try { labels = JSON.parse(rawLabels); } catch { labels = [rawLabels]; }
            } else if (Array.isArray(rawLabels)) {
                labels = rawLabels;
            }
            labels.forEach(function(label) {
                if ($('#assign_labels option[value="' + label + '"]').length === 0) {
                    let newOption = new Option(label, label, true, true);
                    $('#assign_labels').append(newOption);
                }
            });
            $('#assign_labels').val(labels).trigger('change');

            $('#reassign-form input[name="order_code"]').val($(this).data('order_code'));
            $('#reassign-form input[name="order_id"]').val($(this).data('order_id'));
            $('#reassign-form input[name="assign_notes"]').val($(this).data('assign_notes'));
            $('#assign_date').val($(this).data('assign_date'));

            $('#service_no').val($(this).data('service_no') || '');
            $('#customer_name').val(maskText($(this).data('customer_name') || ''));
            $('#contact_phone').val(maskText($(this).data('contact_phone') || ''));
            $('#odp_name').val($(this).data('odp_name') || '');
            $('#notes').val($(this).data('assign_notes') || '');
        });

        let today = new Date();
        let yyyy = today.getFullYear();
        let mm = String(today.getMonth() + 1).padStart(2, '0');
        let dd = String(today.getDate()).padStart(2, '0');
        let formattedToday = yyyy + '-' + mm + '-' + dd;
        $('#assign_date').val(formattedToday);

        $('#assign_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            orientation: "top"
        });
    });
</script>
@endsection
