@extends('layouts')

@section('styles')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
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

@section('title', 'Order Tracking')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Order Tracking</h5>
            <p class="card-text">Cari Order Number atau Payment Number untuk tracking status order.</p>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchOrderInput"
                    placeholder="Search Order Number or Payment Number" aria-label="Search" minlength="10">
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-center detail-data-table" id="orderTrackingTable"
                    style="table-layout: auto; width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">No</th>
                            <th style="width: 10%;">Order Code</th>
                            <th style="width: 15%;">Service No</th>
                            <th style="width: 12%;">Assign Date</th>
                            <th style="width: 15%;">Service Area</th>
                            <th style="width: 15%;">Team</th>
                            <th style="width: 15%;">Assign Labels</th>
                            <th style="width: 15%;">Action</th>
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
            <form id="reassign-form" action="{{ route('work-order-management.updateOrInsertOrder') }}" method="POST"
                class="modal-content">
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
                        <select name="service_area_id" id="service_area_id" class="form-control select2"
                            style="width: 100%"></select>
                    </div>
                    <div class="mb-3">
                        <label for="team_id" class="form-label">Team</label>
                        <select name="team_id" id="team_id" class="form-control select2" style="width: 100%"></select>
                    </div>
                    <div class="mb-3">
                        <label for="assign_labels" class="form-label">Assign Labels</label>
                        <select name="assign_labels[]" id="assign_labels" class="form-control select2"
                            multiple="multiple" style="width: 100%"></select>
                    </div>
                    <div class="mb-3">
                        <label for="assign_date" class="form-label">Assign Date</label>
                        <div class="input-group" id="assign_date_picker">
                            <input type="text" name="assign_date" id="assign_date" class="form-control"
                                placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                data-date-container='#assign_date_picker' data-provide="datepicker"
                                data-date-autoclose="true" required autocomplete="off">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>&nbsp;
                        Assign</button>
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

            $('#assign_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                orientation: "top"
            });

            $('#service_area_id').select2({
                dropdownParent: $('#modal-reassign'),
                allowClear: true,
                placeholder: "Pilih Service Area",
                ajax: {
                    url: '/ajax/organization-structure/service-area',
                    processResults: data => ({
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    }),
                    cache: true
                }
            });

            $('#team_id').select2({
                dropdownParent: $('#modal-reassign'),
                allowClear: true,
                placeholder: "Pilih Team"
            });

            $('#service_area_id').on('change', function() {
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
                                results: filtered.map(item => ({
                                    id: item.id,
                                    text: item.name
                                }))
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

            let table = $("#orderTrackingTable").DataTable({
                responsive: true,
                searching: false,
                paging: true,
                pageLength: 10,
                lengthChange: true,
                info: false,
                data: [],
                columns: [{
                        data: null,
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    {
                        data: 'order_code',
                        defaultContent: '-'
                    },
                    {
                        data: 'service_no',
                        defaultContent: '-'
                    },
                    {
                        data: 'assign_date',
                        defaultContent: '-'
                    },
                    {
                        data: 'service_area_name',
                        defaultContent: '-'
                    },
                    {
                        data: 'team_name',
                        defaultContent: '-'
                    },
                    {
                        data: 'assign_labels',
                        render: function(data) {
                            if (!data) return '-';
                            try {
                                let arr = typeof data === 'string' ? JSON.parse(data) : data;
                                if (Array.isArray(arr)) return arr.join(', ');
                                return data;
                            } catch {
                                return data;
                            }
                        },
                        defaultContent: '-'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            let viewButton =
                                `<a href="/order/${row.id || ''}" class="btn btn-sm btn-info" style="color: white !important;"><i class="fas fa-eye"></i> View</a>`;
                            if (!row.assign_date || !row.order_code || !row.order_id) {
                                return `
                                ${viewButton}

                                &nbsp;

                                <div style="display: flex; gap: 5px;">
                                    <button type="button" class="btn btn-sm btn-primary btn-assign"
                                        data-id="${row.id || ''}"
                                        data-order_code="${row.order_code || ''}"
                                        data-order_id="${row.order_id || ''}"
                                        data-team_id="${row.team_id || ''}"
                                        data-team_name="${row.team_name || ''}"
                                        data-service_area_id="${row.service_area_id || ''}"
                                        data-service_area_name="${row.service_area_name || ''}"
                                        data-assign_labels='${row.assign_labels ? JSON.stringify(row.assign_labels) : "[]"}'
                                        data-assign_date="${row.assign_date || ''}"
                                        data-assign_notes="${row.assign_notes || row.notes || ''}"
                                        data-service_no="${row.service_no || ''}"
                                        data-customer_name="${row.customer_name || ''}"
                                        data-contact_phone="${row.contact_phone || ''}"
                                        data-odp_name="${row.odp_name || ''}"
                                        data-region_name="${row.region_name || ''}"
                                        data-witel="${row.witel || ''}"
                                        data-workzone="${row.workzone || ''}"
                                        data-order_status_name="${row.order_status_name || ''}"
                                        data-order_segment_id="${row.order_segment_id || ''}"
                                        data-order_segment_name="${row.order_segment_name || ''}"
                                        data-order_action_id="${row.order_action_id || ''}"
                                        data-order_action_name="${row.order_action_name || ''}"
                                        data-bs-toggle="modal" data-bs-target="#modal-reassign">
                                        <i class="fas fa-paper-plane"></i> Assign
                                    </button>
                                </div>
                            `;
                            }
                            return `
                                ${viewButton}

                                &nbsp;

                                <button type="button" class="btn btn-sm btn-warning btn-reassign"
                                    data-id="${row.id}"
                                    data-order_code="${row.order_code}"
                                    data-order_id="${row.order_id}"
                                    data-team_id="${row.team_id || ''}"
                                    data-team_name="${row.team_name || ''}"
                                    data-service_area_id="${row.service_area_id || ''}"
                                    data-service_area_name="${row.service_area_name || ''}"
                                    data-assign_labels='${row.assign_labels ? JSON.stringify(row.assign_labels) : "[]"}'
                                    data-assign_date="${row.assign_date || ''}"
                                    data-assign_notes="${row.assign_notes || row.notes || ''}"
                                    data-service_no="${row.service_no || ''}"
                                    data-customer_name="${row.customer_name || ''}"
                                    data-contact_phone="${row.contact_phone || ''}"
                                    data-odp_name="${row.odp_name || ''}"
                                    data-region_name="${row.region_name || ''}"
                                    data-witel="${row.witel || ''}"
                                    data-workzone="${row.workzone || ''}"
                                    data-order_status_name="${row.order_status_name || ''}"
                                    data-order_segment_id="${row.order_segment_id || ''}"
                                    data-order_segment_name="${row.order_segment_name || ''}"
                                    data-order_action_id="${row.order_action_id || ''}"
                                    data-order_action_name="${row.order_action_name || ''}"
                                    data-bs-toggle="modal" data-bs-target="#modal-reassign">
                                    <i class="fas fa-sync-alt"></i> Re-Assign
                                </button>
                        `;
                        }
                    }
                ]
            });

            function renderResult(data) {
                if (!data || !Array.isArray(data) || data.length === 0) {
                    table.clear().draw();
                    return;
                }
                let rows = data.map(function(item) {
                    return {
                        id: item.id ?? '-',
                        order_code: item.order_code ?? '-',
                        order_id: item.order_id ?? '-',
                        team_id: item.team_id ?? '',
                        team_name: item.team_name ?? '',
                        service_area_id: item.service_area_id ?? '',
                        service_area_name: item.service_area_name ?? '',
                        assign_labels: item.assign_labels ?? '',
                        assign_date: item.assign_date ?? '',
                        assign_notes: item.assign_notes ?? item.notes ?? '',
                        service_no: item.service_no ?? '',
                        customer_name: item.customer_name ?? '',
                        contact_phone: item.contact_phone ?? '',
                        odp_name: item.odp_name ?? '',
                        region_name: item.region_name ?? '',
                        witel: item.witel ?? '',
                        workzone: item.workzone ?? '',
                        order_status_name: item.order_status_name ?? '',
                        order_segment_id: item.order_segment_id ?? '',
                        order_segment_name: item.order_segment_name ?? '',
                        order_action_id: item.order_action_id ?? '',
                        order_action_name: item.order_action_name ?? ''
                    };
                });
                table.clear().rows.add(rows).draw();
            }

            function searchOrder() {
                let id = $('#searchOrderInput').val().trim();
                if (!id || id.length < 10) {
                    table.clear().draw();
                    return;
                }
                $.ajax({
                    url: '/ajax/support/order-tracking/search/' + encodeURIComponent(id),
                    method: 'GET',
                    success: function(res) {
                        renderResult(res);
                    },
                    error: function() {
                        table.clear().draw();
                    }
                });
            }

            let debounceTimer;
            $('#searchOrderInput').on('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    searchOrder();
                }, 400);
            });

            $('#searchOrderInput').on('keypress', function(e) {
                if (e.which === 13) {
                    searchOrder();
                }
            });

            $(document).on('click', '.btn-reassign, .btn-assign', function() {
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

                let rawLabels = $(this).data('assign_labels');
                let labels = [];
                if (Array.isArray(rawLabels)) {
                    labels = rawLabels;
                } else if (typeof rawLabels === 'string') {
                    try {
                        let parsed = JSON.parse(rawLabels);
                        if (Array.isArray(parsed)) {
                            labels = parsed;
                        } else if (parsed && typeof parsed === 'string') {
                            labels = [parsed];
                        } else {
                            labels = [];
                        }
                    } catch {
                        if (rawLabels.trim() !== '') {
                            labels = [rawLabels];
                        } else {
                            labels = [];
                        }
                    }
                } else if (rawLabels && typeof rawLabels === 'object') {
                    labels = Object.values(rawLabels);
                } else {
                    labels = [];
                }
                labels.forEach(function(label, idx) {
                    if (Array.isArray(label)) {
                        label = label.join(', ');
                        labels[idx] = label;
                    }
                    if (typeof label !== 'string') {
                        label = String(label);
                    }

                    label = label.replace(/^\[+|]+$/g, '').replace(/^"+|"+$/g, '').trim();
                    labels[idx] = label;

                    if ($('#assign_labels option[value="' + label + '"]').length === 0) {
                        let newOption = new Option(label, label, true, true);
                        $('#assign_labels').append(newOption);
                    }
                });
                $('#assign_labels').val(labels).trigger('change');

                $('#reassign-form input[name="order_code"]').val($(this).data('order_code'));
                $('#reassign-form input[name="order_id"]').val($(this).data('order_id'));
                $('#reassign-form input[name="assign_notes"]').val($(this).data('assign_notes'));

                $('#order_code').val($(this).data('order_code') || '');
                $('#service_no').val($(this).data('service_no') || '');
                $('#customer_name').val(maskText($(this).data('customer_name') || ''));
                $('#contact_phone').val(maskText($(this).data('contact_phone') || ''));
                $('#odp_name').val($(this).data('odp_name') || '');
                $('#notes').val($(this).data('assign_notes') || $(this).data('notes') || '');
                $('#assign_date').val($(this).data('assign_date'));
            });

            let today = new Date();
            let yyyy = today.getFullYear();
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let dd = String(today.getDate()).padStart(2, '0');
            let formattedToday = yyyy + '-' + mm + '-' + dd;
            $('#assign_date').val(formattedToday);
        });
    </script>
@endsection
