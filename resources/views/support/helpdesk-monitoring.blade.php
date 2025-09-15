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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .summary-card .icon {
            font-size: 2rem;
            opacity: 0.8;
        }

        .badge-status {
            padding: 0.4em 0.8em;
            border-radius: 20px;
            font-size: 0.7rem;
        }

        .bg-gradient-ready {
            background: linear-gradient(45deg, #bdbdbd, #757575);
        }

        .bg-gradient-onprogress {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }

        .bg-gradient-custissue {
            background: linear-gradient(45deg, #f6c23e, #e59400);
        }

        .bg-gradient-techissue {
            background: linear-gradient(45deg, #36b9cc, #178ca4);
        }

        .bg-gradient-externalissue {
            background: linear-gradient(45deg, #fd7e14, #b85c00);
        }

        .bg-gradient-done {
            background: linear-gradient(45deg, #1cc88a, #0f9d58);
        }
    </style>
@endsection

@section('title', 'Helpdesk Monitoring')

@section('content')
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="summary-card bg-gradient-ready">
                <div>
                    <h6 class="mb-1">READY</h6>
                    <h4 class="mb-0">{{ $summary['READY'] ?? 0 }}</h4>
                </div>
                <div class="icon"><i class="fas fa-bolt"></i></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="summary-card bg-gradient-onprogress">
                <div>
                    <h6 class="mb-1">ON-PROGRESS</h6>
                    <h4 class="mb-0">{{ $summary['ON-PROGRESS'] ?? 0 }}</h4>
                </div>
                <div class="icon"><i class="fas fa-spinner"></i></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="summary-card bg-gradient-custissue">
                <div>
                    <h6 class="mb-1">CUST-ISSUE</h6>
                    <h4 class="mb-0">{{ $summary['CUST-ISSUE'] ?? 0 }}</h4>
                </div>
                <div class="icon"><i class="fas fa-user-times"></i></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="summary-card bg-gradient-techissue">
                <div>
                    <h6 class="mb-1">TECH-ISSUE</h6>
                    <h4 class="mb-0">{{ $summary['TECH-ISSUE'] ?? 0 }}</h4>
                </div>
                <div class="icon"><i class="fas fa-tools"></i></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="summary-card bg-gradient-externalissue">
                <div>
                    <h6 class="mb-1">OTHER-ISSUE</h6>
                    <h4 class="mb-0">{{ $summary['OTHER-ISSUE'] ?? 0 }}</h4>
                </div>
                <div class="icon"><i class="fas fa-network-wired"></i></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="summary-card bg-gradient-done">
                <div>
                    <h6 class="mb-1">DONE</h6>
                    <h4 class="mb-0">{{ $summary['DONE'] ?? 0 }}</h4>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
    </div>

    @if (isset($data))
        @foreach ($data as $s => $t)
            <div class="d-flex align-items-center mb-0">
                <div style="height:32px;width:6px;background:#4e73df;border-radius:3px;margin-right:12px;"></div>
                <h5 class="mb-0 fw-bold">{{ $s }}</h5>
            </div>
            <div class="card shadow-sm border-0 rounded mb-4" style="margin-top:0;">
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table text-center detail-data-table mb-0">
                            <thead>
                                <tr>
                                    <th rowspan="2">TEAM</th>
                                    <th rowspan="2">ORDER</th>
                                    <th colspan="6">STATUS</th>
                                    <th rowspan="2">TOTAL</th>
                                </tr>
                                <tr>
                                    <th>READY</th>
                                    <th>ON-PROGRESS</th>
                                    <th>CUST-ISSUE</th>
                                    <th>TECH-ISSUE</th>
                                    <th>OTHER-ISSUE</th>
                                    <th>DONE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_status_ready = $total_status_on_progress = $total_status_cust_issue = $total_status_tech_issue = $total_status_other_issue = $total_status_done = $total_order = 0;
                                @endphp
                                @foreach ($t as $team => $list_order)
                                    <tr>
                                        <td>{{ $team }}</td>
                                        <td>
                                            @php
                                                $amount_status_ready = $amount_status_on_progress = $amount_status_cust_issue = $amount_status_tech_issue = $amount_status_other_issue = $amount_status_done = $amount_order = 0;
                                            @endphp
                                            @foreach ($list_order as $order)
                                                @php
                                                    $amount_order++;
                                                    $badgeClass = 'badge bg-gradient-ready text-black';
                                                    if ($order->order_status_group == 'ON-PROGRESS') {
                                                        $badgeClass = 'badge bg-gradient-onprogress text-white';
                                                    } elseif ($order->order_status_group == 'CUST-ISSUE') {
                                                        $badgeClass = 'badge bg-gradient-custissue text-white';
                                                    } elseif ($order->order_status_group == 'TECH-ISSUE') {
                                                        $badgeClass = 'badge bg-gradient-techissue text-white';
                                                    } elseif ($order->order_status_group == 'OTHER-ISSUE') {
                                                        $badgeClass = 'badge bg-gradient-externalissue text-white';
                                                    } elseif ($order->order_status_group == 'DONE') {
                                                        $badgeClass = 'badge bg-gradient-done text-white';
                                                    }

                                                    if (
                                                        $order->order_status_group == 'READY' ||
                                                        $order->order_status_group == null
                                                    ) {
                                                        $amount_status_ready++;
                                                    } elseif ($order->order_status_group == 'ON-PROGRESS') {
                                                        $amount_status_on_progress++;
                                                    } elseif ($order->order_status_group == 'CUST-ISSUE') {
                                                        $amount_status_cust_issue++;
                                                    } elseif ($order->order_status_group == 'TECH-ISSUE') {
                                                        $amount_status_tech_issue++;
                                                    } elseif ($order->order_status_group == 'OTHER-ISSUE') {
                                                        $amount_status_other_issue++;
                                                    } elseif ($order->order_status_group == 'DONE') {
                                                        $amount_status_done++;
                                                    }
                                                @endphp
                                                <span class="badge-status {{ $badgeClass }} mb-1 d-inline-block"
                                                    style="min-width:60px;">
                                                    {{ $order->order_code }}
                                                </span>
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $amount_status_ready }}</td>
                                        <td>{{ $amount_status_on_progress }}</td>
                                        <td>{{ $amount_status_cust_issue }}</td>
                                        <td>{{ $amount_status_tech_issue }}</td>
                                        <td>{{ $amount_status_other_issue }}</td>
                                        <td>{{ $amount_status_done }}</td>
                                        <td>{{ $amount_order }}</td>
                                        @php
                                            $total_status_ready += $amount_status_ready;
                                            $total_status_on_progress += $amount_status_on_progress;
                                            $total_status_cust_issue += $amount_status_cust_issue;
                                            $total_status_tech_issue += $amount_status_tech_issue;
                                            $total_status_other_issue += $amount_status_other_issue;
                                            $total_status_done += $amount_status_done;
                                            $total_order += $amount_order;
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">TOTAL</td>
                                    <td>{{ $total_status_ready }}</td>
                                    <td>{{ $total_status_on_progress }}</td>
                                    <td>{{ $total_status_cust_issue }}</td>
                                    <td>{{ $total_status_tech_issue }}</td>
                                    <td>{{ $total_status_other_issue }}</td>
                                    <td>{{ $total_status_done }}</td>
                                    <td>{{ $total_order }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

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
            $('.detail-data-table').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                lengthChange: false,
                responsive: true,
                autoWidth: false,
            });

            $('.select2').select2({
                width: '100%'
            });

            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
@endsection
