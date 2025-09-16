@extends('layouts')

@section('styles')
	<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
		type="text/css" />
	<link href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">

	<style>
		#reportTable th,
		#reportTable td {
			padding: 4px 6px !important;
			font-size: 12px !important;
			vertical-align: middle !important;
			text-align: center;
		}

		#reportTable th {
			font-weight: 600;
		}

		td.details-control {
			cursor: pointer;
			font-weight: bold;
		}
	</style>
@endsection

@section('title', 'Daily Reports')

@section('content')
	<div class="d-flex align-items-center mb-0">
		<div style="height:32px;width:6px;background:#4e73df;border-radius:3px;margin-right:12px;"></div>
		<h5 class="mb-0 fw-bold">Order Reports by Status Group</h5>
	</div>
	<div class="card shadow-sm border-0 rounded mb-4" style="margin-top:0">
		<div class="card-body p-2">
			<div class="table-responsive">
				<table id="reportTable" class="table table-sm table-bordered w-100">
					<thead>
						<tr>
							<th rowspan="2" style="width:20px;"></th>
							<th rowspan="2" class="text-center">SERVICE AREA</th>
							<th colspan="6">STATUS GROUP</th>
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
					<tbody></tbody>
					<tfoot>
						<tr>
							<th></th>
							<th class="text-center">TOTAL</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>
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
	<script>
		$(document).ready(function() {
			var table = $('#reportTable').DataTable({
				processing: true,
				paging: false,
				info: false,
				searching: false,
				ordering: false,
				ajax: {
					url: "{{ route('ajax.reports-payment.reports.status-group', ['start_date' => $start_date, 'end_date' => $end_date]) }}",
					type: "GET",
					dataType: "json",
				},
				columns: [{
						className: 'details-control text-center',
						orderable: false,
						data: null,
						defaultContent: '+'
					},
					{
						data: 'service_area_name',
						className: 'text-start'
					},
					{
						data: 'sg_ready'
					},
					{
						data: 'sg_on_progress'
					},
					{
						data: 'sg_cust_issue'
					},
					{
						data: 'sg_tech_issue'
					},
					{
						data: 'sg_other_issue'
					},
					{
						data: 'sg_done'
					},
					{
						data: 'total_orders'
					},
				],
				footerCallback: function(row, data, start, end, display) {
					let api = this.api();

					let intVal = function(i) {
						return typeof i === 'string' ?
							i.replace(/[\$,]/g, '') * 1 :
							typeof i === 'number' ?
							i : 0;
					};

					for (let col = 2; col <= 8; col++) {
						let total = api
							.column(col, {
								page: 'current'
							})
							.data()
							.reduce((a, b) => intVal(a) + intVal(b), 0);

						$(api.column(col).footer()).html(total);
					}
				}
			});

			$('#reportTable tbody').on('click', 'td.details-control', function() {
				let tr = $(this).closest('tr');
				let row = table.row(tr);

				if (tr.hasClass('shown')) {
					tr.removeClass('shown');
					$(this).text('+');
					tr.nextUntil('tr:not(.child-row)').remove();
				} else {
					tr.addClass('shown');
					$(this).text('-');

					let children = row.data().children;
					if (children && children.length > 0) {
						children.forEach(c => {
							let childRow = `
								<tr class="child-row">
									<td></td>
									<td class="text-start ps-4">↳ ${c.work_zone_name ?? '-'}</td>
									<td>${c.sg_ready}</td>
									<td>${c.sg_on_progress}</td>
									<td>${c.sg_cust_issue}</td>
									<td>${c.sg_tech_issue}</td>
									<td>${c.sg_other_issue}</td>
									<td>${c.sg_done}</td>
									<td>${c.total_orders}</td>
								</tr>
							`;
							tr.after(childRow);
							tr = tr.next();
						});
					}
				}
			});
		});
	</script>
@endsection

