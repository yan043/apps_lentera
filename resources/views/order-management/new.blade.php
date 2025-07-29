@extends('layouts')

@section('styles')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/assets/libs/@chenfengyuan/datepicker/datepicker.min.css">
<link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<style>
    .modal-body {
        text-align: left;
    }
    .tr, .td , .th {
        text-align: center;
		vertical-align: middle;
    }
    .select2-container .select2-selection--single {
        height: 38px !important;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
        right: 10px;
    }
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
</style>
@endsection

@section('title', 'New Orders')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end" id="filter-form">
            <div class="col-md-5">
                <label for="start_date" class="form-label">Start Date</label>
                <div class="input-group" id="start_date">
                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="yyyy-mm-dd"
                        data-date-format="yyyy-mm-dd" data-date-container='#start_date' data-provide="datepicker" data-date-autoclose="true" value="{{ old('start_date') ?: date('Y-m-01') }}">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-5">
                <label for="end_date" class="form-label">End Date</label>
                <div class="input-group" id="end_date">
                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="yyyy-mm-dd"
                        data-date-format="yyyy-mm-dd" data-date-container='#end_date' data-provide="datepicker" data-date-autoclose="true" value="{{ old('end_date') ?: date('Y-m-d') }}">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-2 text-end">
                <button type="submit" class="btn btn-primary w-100 mt-2">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center detail-data-table" id="source_insera">
                        <thead>
                            <tr>
                                <th rowspan="2">Work Zone</th>
                                <th colspan="6">Work Zone</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>0 - 2</th>
                                <th>2 - 3</th>
                                <th>3 - 12</th>
                                <th>12 - 24</th>
                                <th>24 ±</th>
                                <th>GAMAS</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center detail-data-table" id="source_manual">
                        <thead>
                            <tr>
                                <th rowspan="2">Work Zone</th>
                                <th colspan="5">Work Zone</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>0 - 2</th>
                                <th>2 - 3</th>
                                <th>3 - 12</th>
                                <th>12 - 24</th>
                                <th>24 ±</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
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
<script src="/assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
$(document).ready(function() {

    $("#witel").select2({
        allowClear: true,
        placeholder: "Pilih Witel"
    });

    function getDateRange() {
        return {
            startdate: $('#start_date input').val() || "{{ date('Y-m-d') }}",
            enddate: $('#end_date input').val() || "{{ date('Y-m-d') }}"
        };
    }

    function initDataTable(tableId, ajaxUrl, columns) {
        return $(`#${tableId}`).DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            lengthChange: false,
            searching: false,
            paging: false,
            info: false,
            sort: false,
            ajax: {
                url: ajaxUrl,
                type: 'POST',
                data: function(d) {
                    let dateRange = getDateRange();
                    d.startdate = dateRange.startdate;
                    d.enddate = dateRange.enddate;
                    d._token = '{{ csrf_token() }}';
                },
                dataSrc: ''
            },
            columns: columns,
            destroy: true
        });
    }

    let inseraColumns = [
        { data: 'workzone', title: 'Work Zone' },
        { data: 'ttr0to2', title: '0 - 2', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=insera&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr0to2&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr2to3', title: '2 - 3', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=insera&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr2to3&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr3to12', title: '3 - 12', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=insera&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr3to12&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr12to24', title: '12 - 24', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=insera&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr12to24&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr24', title: '24 ±', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=insera&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr24&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'gamas', title: 'GAMAS', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=insera&workzone=${encodeURIComponent(row.workzone)}&ttr=gamas&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'jumlah', title: 'Total', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=insera&workzone=${encodeURIComponent(row.workzone)}&ttr=total&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }}
    ];

    let manualColumns = [
        { data: 'workzone', title: 'Work Zone' },
        { data: 'ttr0to2', title: '0 - 2', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=manual&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr0to2&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr2to3', title: '2 - 3', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=manual&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr2to3&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr3to12', title: '3 - 12', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=manual&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr3to12&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr12to24', title: '12 - 24', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=manual&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr12to24&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'ttr24', title: '24 ±', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=manual&workzone=${encodeURIComponent(row.workzone)}&ttr=ttr24&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }},
        { data: 'jumlah', title: 'Total', render: function(data, type, row) {
            if (!data || Number(data) === 0) return data ?? 0;
            let url = `/order-management/new/details?sourcedata=manual&workzone=${encodeURIComponent(row.workzone)}&ttr=total&startdate=${getDateRange().startdate}&enddate=${getDateRange().enddate}`;
            return `<a href="${url}">${data}</a>`;
        }}
    ];

    let inseraTable = initDataTable('source_insera', `/ajax/order-management/new/{{ strtoupper(Session::get('witel_alias')) ?? '' }}/insera`, inseraColumns);
    let manualTable = initDataTable('source_manual', `/ajax/order-management/new/{{ strtoupper(Session::get('witel_alias')) ?? '' }}/manual`, manualColumns);

    $('#start_date input, #end_date input').on('change', function() {
        inseraTable.ajax.reload();
        manualTable.ajax.reload();
    });

    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        inseraTable.ajax.reload();
        manualTable.ajax.reload();
    });

    $('#start_date input, #end_date input').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
});
</script>
@endsection
