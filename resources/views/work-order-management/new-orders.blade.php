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

    .chart-container {
        position: relative;
        width: 100%;
        min-height: 300px;
    }
    .chart-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #6c757d;
    }
</style>
@endsection

@section('title', 'New Order Details')

@section('content')

<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end" id="filter-form">
            <div class="col-md-4">
                <label for="start_date" class="form-label fw-bold">Start Date</label>
                <div class="input-group" id="start_date">
                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="yyyy-mm-dd"
                        data-date-format="yyyy-mm-dd" data-date-container='#start_date' data-provide="datepicker" data-date-autoclose="true" value="{{ old('start_date') ?: date('Y-m-01') }}">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label fw-bold">End Date</label>
                <div class="input-group" id="end_date">
                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="yyyy-mm-dd"
                        data-date-format="yyyy-mm-dd" data-date-container='#end_date' data-provide="datepicker" data-date-autoclose="true" value="{{ old('end_date') ?: date('Y-m-d') }}">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-4">
                <label for="work_zone" class="form-label fw-bold">Work Zone</label>
                <select name="work_zone" id="work_zone" class="form-control select2" style="width: 100%">
                    <option value="">All Work Zone</option>
                </select>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Orders by Work Zone</h5>
                <div class="chart-container">
                    <div id="barChart" class="e-charts" style="width: 100%; height: 400px;"></div>
                    <div class="chart-loading" style="display: none;">
                        <i class="bx bx-loader bx-spin font-size-24"></i>
                        <p>Loading chart data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Orders by SLA</h5>
                <div class="chart-container">
                    <div id="pieChart" class="e-charts" style="width: 100%; height: 400px;"></div>
                    <div class="chart-loading" style="display: none;">
                        <i class="bx bx-loader bx-spin font-size-24"></i>
                        <p>Loading chart data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped detail-data-table" id="newOrderDetailsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Order Date</th>
                        <th>Workzone</th>
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

<div class="modal fade" id="modal-assign" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="assign-form" action="{{ route('work-order-management.updateOrInsertOrder') }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="order_code" id="order_code">
            <input type="hidden" name="order_id" id="order_id">
            <input type="hidden" name="assign_notes" id="assign_notes">
            <div class="modal-header">
                <h5 class="modal-title">Assign Order</h5>
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
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>&nbsp; Assign</button>
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
<script src="/assets/libs/echarts/echarts.min.js"></script>
<script>
$(document).ready(function() {
    var barChart = echarts.init(document.getElementById('barChart'));
    var pieChart = echarts.init(document.getElementById('pieChart'));

    function showChartLoading(chartType) {
        $(`#${chartType}Chart`).hide();
        $(`#${chartType}Chart`).siblings('.chart-loading').show();
    }

    function hideChartLoading(chartType) {
        $(`#${chartType}Chart`).show();
        $(`#${chartType}Chart`).siblings('.chart-loading').hide();
    }

    function loadBarChart() {
        showChartLoading('bar');

        $.ajax({
            url: '/ajax/work-order-management/new/charts',
            type: 'GET',
            data: {
                type: 'bar',
                startdate: $('#start_date input').val() || "{{ date('Y-m-01') }}",
                enddate: $('#end_date input').val() || "{{ date('Y-m-d') }}"
            },
            success: function(res) {
                barChart.setOption({
                    grid: {
                        zlevel: 0,
                        x: 50,
                        x2: 50,
                        y: 30,
                        y2: 30,
                        borderWidth: 0,
                        backgroundColor: "rgba(0,0,0,0)",
                        borderColor: "rgba(0,0,0,0)"
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: res.labels,
                        axisLine: {
                            lineStyle: {
                                color: '#8791af'
                            }
                        }
                    },
                    yAxis: {
                        type: 'value',
                        axisLine: {
                            lineStyle: {
                                color: '#8791af'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: 'rgba(166, 176, 207, 0.1)'
                            }
                        }
                    },
                    series: res.datasets.map(ds => ({
                        name: ds.label,
                        type: 'bar',
                        data: ds.data,
                        itemStyle: {
                            color: ds.backgroundColor,
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }))
                });
                hideChartLoading('bar');
            },
            error: function() {
                console.error('Failed to load bar chart data');
                hideChartLoading('bar');
                $(`#barChart`).siblings('.chart-loading').html('<p class="text-danger">Failed to load chart data</p>');
            }
        });
    }

    function loadPieChart() {
        showChartLoading('pie');

        $.ajax({
            url: '/ajax/work-order-management/new/charts',
            type: 'GET',
            data: {
                type: 'pie',
                startdate: $('#start_date input').val() || "{{ date('Y-m-01') }}",
                enddate: $('#end_date input').val() || "{{ date('Y-m-d') }}"
            },
            success: function(res) {
                let pieData = res.labels.map((label, i) => ({
                    name: label,
                    value: res.datasets[0].data[i],
                    itemStyle: { color: res.datasets[0].backgroundColor[i] }
                }));

                pieChart.setOption({
                    tooltip: {
                        trigger: 'item',
                        formatter: '{a} <br/>{b}: {c}'
                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left',
                        textStyle: {
                            color: '#8791af'
                        }
                    },
                    series: [{
                        name: 'TTR',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '60%'],
                        data: pieData,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }]
                });
                hideChartLoading('pie');
            },
            error: function() {
                console.error('Failed to load pie chart data');
                hideChartLoading('pie');
                $(`#pieChart`).siblings('.chart-loading').html('<p class="text-danger">Failed to load chart data</p>');
            }
        });
    }

    function resizeCharts() {
        barChart.resize();
        pieChart.resize();
    }

    loadBarChart();
    loadPieChart();

    $(window).on('resize', function() {
        resizeCharts();
    });

    $('#work_zone, #start_date input, #end_date input').on('change', function() {
        loadBarChart();
        loadPieChart();
    });

    function maskText(text, masked = 3)
    {
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

    let newOrderDetailsTable = $('#newOrderDetailsTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '/ajax/work-order-management/new/details',
            type: 'GET',
            data: function(d) {
                d.sourcedata = $('#sourcedata').val() || null;
                d.workzone = $('#work_zone').val() || null;
                d.ttr = $('#sourcedata').val() || null;
                d.startdate = $('#start_date input').val() || "{{ date('Y-m-01') }}";
                d.enddate = $('#end_date input').val() || "{{ date('Y-m-d') }}";
            },
            dataSrc: ''
        },
        columns: [
            { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
            { data: 'order_code' },
            { data: 'order_date' },
            { data: 'workzone' },
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
                            data-order_code="${row.order_code}"
                            data-order_id="${row.order_id}"
                            data-customer_name="${row.customer_name}"
                            data-contact_phone="${row.contact_phone}"
                            data-service_no="${row.service_no}"
                            data-odp_name="${row.odp_name}"
                            data-notes="${row.notes || ''}"
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

    $('#service_area_id').select2({
        dropdownParent: $('#modal-assign'),
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
        dropdownParent: $('#modal-assign'),
        allowClear: true,
        placeholder: "Pilih Team"
    });

    $('#service_area_id').on('change', function () {
        let id = $(this).val();
        $('#team_id').val(null).trigger('change');
        $('#team_id').select2({
            dropdownParent: $('#modal-assign'),
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
        dropdownParent: $('#modal-assign'),
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

    $(document).on('click', '.btn-assign', function () {
        let customerName = String($(this).data('customer_name') || '');
        let contactPhone = String($(this).data('contact_phone') || '');

        $('#assign-form input[name="order_code"]').val($(this).data('order_code'));
        $('#assign-form input[name="order_id"]').val($(this).data('order_id'));
        $('#assign-form input[name="customer_name"]').val(maskText(customerName));
        $('#assign-form input[name="contact_phone"]').val(maskText(contactPhone));
        $('#assign-form input[name="service_no"]').val($(this).data('service_no'));
        $('#assign-form input[name="odp_name"]').val($(this).data('odp_name'));
        $('#assign-form textarea[name="notes"]').val($(this).data('notes'));
        $('#assign-form input[name="assign_notes"]').val($(this).data('notes'));

        $('#team_id').on('select2:select', function(e) {
            let teamName = e.params.data.text;
            if ($('#assign-form input[name="team_name"]').length === 0) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'team_name',
                    id: 'team_name',
                    value: teamName
                }).appendTo('#assign-form');
            } else {
                $('#assign-form input[name="team_name"]').val(teamName);
            }
        });
        $('#team_id').on('select2:clear', function(e) {
            $('#assign-form input[name="team_name"]').val('');
        });
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


    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        newOrderDetailsTable.ajax.reload();
    });

    $('#work_zone').on('change', function() {
        newOrderDetailsTable.ajax.reload();
    });

    $('#start_date input, #end_date input').on('change', function() {
        newOrderDetailsTable.ajax.reload();
    });

    $('#start_date input, #end_date input').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });

    $('#work_zone').select2({
        allowClear: true,
        placeholder: "All Work Zone",
        ajax: {
            url: '/ajax/organization-structure/work-zone',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data.map(function(item) {
                        return { id: item.name, text: item.name };
                    })
                };
            },
            cache: true
        }
    });
});
</script>
@endsection
