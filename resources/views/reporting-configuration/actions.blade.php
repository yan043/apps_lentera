@extends('layouts')

@section('styles')
	<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
		type="text/css" />
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

		.modal-body {
			text-align: left;
		}
	</style>
@endsection

@section('title', 'Order Actions')

@section('content')
	<div class="card">
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
				<i class="fas fa-plus-circle"></i>&nbsp; Add Data
			</button>
			<div class="table-responsive">
				<table class="table table-striped table-hover text-center detail-data-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Segment</th>
							<th>Action</th>
							<th width="7%"></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Action</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="/reporting-configuration/actions/store" method="POST">
						@csrf
						<div class="mb-3">
							<label class="form-label">Segment Name</label>
							<select class="form-control select2" name="order_segment_id" required>
								<option value="" selected disabled>Silahkan Pilih Nama Segment</option>
								@foreach ($get_order_segment as $order_segment)
									<option value="{{ $order_segment->id }}">{{ $order_segment->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Action Name</label>
							<input type="text" class="form-control" name="name" placeholder="Masukkan Nama Action" required>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary">
								<i class="fas fa-save"></i>&nbsp; Save
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Action</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="/reporting-configuration/actions/store" method="POST">
						@csrf
						<input type="hidden" name="id">
						<div class="mb-3">
							<label class="form-label">Segment Name</label>
							<select class="form-control select2" name="order_segment_id" required>
								<option value="" disabled>Silahkan Pilih Nama Segment</option>
								@foreach ($get_order_segment as $order_segment)
									<option value="{{ $order_segment->id }}">{{ $order_segment->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Action Name</label>
							<input type="text" class="form-control" name="name" placeholder="Masukkan Nama Action" required>
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary">
								<i class="fas fa-save"></i>&nbsp; Save
							</button>
						</div>
					</form>
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
	<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
	<script>
		$(document).ready(function() {
			$(".select2").select2({
				allowClear: true,
				placeholder: "Silahkan Pilih Segment"
			});

			let table = $(".detail-data-table").DataTable({
				processing: true,
				ajax: {
					url: '/ajax/reporting-configuration/actions',
					dataSrc: ''
				},
				columns: [{
						data: 'id'
					},
					{
						data: 'order_segment_name'
					},
					{
						data: 'name'
					},
					{
						data: 'id',
						render: function(data, type, row) {
							return `
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit" onclick="openEditModal(${data}, '${row.order_segment_id}', '${row.name}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(${data})">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
						}
					}
				]
			});

			$('#modal-add, #modal-edit').on('shown.bs.modal', function() {
				$(this).find('.select2').select2({
					dropdownParent: $(this),
					allowClear: true,
					placeholder: "Silahkan Pilih Segment"
				});
			});
		});

		function openEditModal(id, orderSegmentId, name) {
			$('#modal-edit input[name="id"]').val(id);
			$('#modal-edit select[name="order_segment_id"]').val(orderSegmentId).trigger('change');
			$('#modal-edit input[name="name"]').val(name);
			$('#modal-edit').modal('show');
		}

		function confirmDelete(id) {
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = '/reporting-configuration/actions/destroy/' + id;
				}
			});
		}
	</script>
@endsection

