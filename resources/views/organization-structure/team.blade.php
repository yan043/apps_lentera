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
		}

		.modal-body {
			text-align: left;
		}
	</style>
@endsection

@section('title', 'Data Team')

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
							<th>Service Area</th>
							<th>Team Name</th>
							<th>Technician 1</th>
							<th>Technician 2</th>
							<th>Status</th>
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
					<h5 class="modal-title">Add Team</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="{{ route('organization-structure.team.store') }}" method="POST">
						@csrf
						<input type="hidden" name="is_active" value="1">
						<div class="mb-3">
							<label class="form-label">Service Area</label>
							<select class="form-control select2" id="service_area_id_add" name="service_area_id" required>
								<option value="" selected disabled>Pilih Service Area</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Team Name</label>
							<input type="text" class="form-control" name="name" placeholder="Enter Team Name" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Technician 1</label>
							<select class="form-control select2" id="technician1_id_add" name="technician1" required>
								<option value="" selected disabled>Pilih Technician 1</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Technician 2</label>
							<select class="form-control select2" id="technician2_id_add" name="technician2">
								<option value="" selected disabled>Pilih Technician 2</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Status</label>
							<div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="is_active" id="active_add" value="1" checked>
									<label class="form-check-label" for="active_add">Active</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="is_active" id="inactive_add" value="0">
									<label class="form-check-label" for="inactive_add">Inactive</label>
								</div>
							</div>
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
					<h5 class="modal-title">Edit Team</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="edit-form" action="{{ route('organization-structure.team.store') }}" method="POST">
						@csrf
						<input type="hidden" name="id">
						<div class="mb-3">
							<label class="form-label">Service Area</label>
							<select class="form-control select2" id="service_area_id_edit" name="service_area_id" required>
								<option value="" selected disabled>Pilih Service Area</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Team Name</label>
							<input type="text" class="form-control" id="name_edit" name="name" placeholder="Enter Team Name"
								required>
						</div>
						<div class="mb-3">
							<label class="form-label">Technician 1</label>
							<select class="form-control select2" id="technician1_id_edit" name="technician1" required>
								<option value="" selected disabled>Pilih Technician 1</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Technician 2</label>
							<select class="form-control select2" id="technician2_id_edit" name="technician2">
								<option value="" selected disabled>Pilih Technician 2</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Status</label>
							<div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="is_active" id="active_edit" value="1">
									<label class="form-check-label" for="active_edit">Active</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="is_active" id="inactive_edit" value="0">
									<label class="form-check-label" for="inactive_edit">Inactive</label>
								</div>
							</div>
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
				placeholder: "Pilih opsi"
			});

			$('#modal-add, #modal-edit').on('shown.bs.modal', function() {
				$(this).find('.select2').select2({
					dropdownParent: $(this),
					allowClear: true,
					placeholder: function() {
						return $(this).attr('id').includes('service_area') ?
							"Pilih Service Area" :
							$(this).attr('id').includes('technician1') ? "Pilih Technician 1" :
							$(this).attr('id').includes('technician2') ? "Pilih Technician 2" :
							"Pilih opsi";
					}
				});
			});

			$.ajax({
				url: '/ajax/organization-structure/service-area',
				method: 'GET',
				success: function(data) {
					let saSelect = $('#service_area_id_add');
					saSelect.empty().append(
						'<option value="" selected disabled>Pilih Service Area</option>');
					data.forEach(function(item) {
						saSelect.append(`<option value="${item.id}">${item.name}</option>`);
					});
				}
			});

			$.ajax({
				url: '/ajax/employee-management/list',
				method: 'GET',
				success: function(data) {
					let tech1Select = $('#technician1_id_add');
					tech1Select.empty().append(
						'<option value="" selected disabled>Pilih Technician 1</option>');
					data.forEach(function(item) {
						tech1Select.append(
							`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
						);
					});
				}
			});

			$.ajax({
				url: '/ajax/employee-management/list',
				method: 'GET',
				success: function(data) {
					let tech2Select = $('#technician2_id_add');
					tech2Select.empty().append(
						'<option value="" selected disabled>Pilih Technician 2</option>');
					data.forEach(function(item) {
						tech2Select.append(
							`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
						);
					});
				}
			});

			let table = $(".detail-data-table").DataTable({
				processing: true,
				ajax: {
					url: '/ajax/organization-structure/team',
					dataSrc: ''
				},
				columns: [{
						data: 'id'
					},
					{
						data: 'service_area_name'
					},
					{
						data: 'name'
					},
					{
						data: null,
						render: function(data, type, row) {
							if (row.technician1) {
								return row.technician1_name + ' (' + row.technician1 + ')';
							} else {
								return row.technician1_name || '';
							}
						}
					},
					{
						data: null,
						render: function(data, type, row) {
							if (row.technician2) {
								return row.technician2_name + ' (' + row.technician2 + ')';
							} else {
								return row.technician2_name || '';
							}
						}
					},
					{
						data: 'is_active',
						render: function(data) {
							return data ?
								'<span class="badge rounded-pill badge-soft-success font-size-11">Active</span>' :
								'<span class="badge rounded-pill badge-soft-danger font-size-11">Inactive</span>';
						}
					},
					{
						data: 'id',
						render: function(data, type, row) {
							return `
                            <button type="button" class="btn btn-sm btn-primary" onclick="openEditModal(${data})">
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
		});

		function openEditModal(id) {
			$.ajax({
				url: `/ajax/organization-structure/team/${id}`,
				method: 'GET',
				success: function(data) {
					$('#edit-form').attr('action', '/organization-structure/team/store')
					$('#edit-form').append('<input type="hidden" name="_method" value="POST">');
					$('input[name="id"]').val(data.id);
					$('#name_edit').val(data.name);

					$.ajax({
						url: '/ajax/organization-structure/service-area',
						method: 'GET',
						success: function(saData) {
							let saSelect = $('#service_area_id_edit');
							saSelect.empty().append(
								'<option value="" selected disabled>Pilih Service Area</option>'
							);
							saData.forEach(function(item) {
								saSelect.append(
									`<option value="${item.id}">${item.name}</option>`);
							});
							saSelect.val(data.service_area_id).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/employee-management/list',
						method: 'GET',
						success: function(tech1Data) {
							let tech1Select = $('#technician1_id_edit');
							tech1Select.empty().append(
								'<option value="" selected disabled>Pilih Technician 1</option>'
							);
							tech1Data.forEach(function(item) {
								tech1Select.append(
									`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
								);
							});
							tech1Select.val(data.technician1).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/employee-management/list',
						method: 'GET',
						success: function(tech2Data) {
							let tech2Select = $('#technician2_id_edit');
							tech2Select.empty().append(
								'<option value="" selected disabled>Pilih Technician 2</option>'
							);
							tech2Data.forEach(function(item) {
								tech2Select.append(
									`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
								);
							});
							tech2Select.val(data.technician2).trigger('change');
						}
					});

					if (data.is_active == 1) {
						$('#active_edit').prop('checked', true);
					} else {
						$('#inactive_edit').prop('checked', true);
					}

					$('#modal-edit').modal('show');
				}
			});
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
					window.location.href = '/organization-structure/team/destroy/' + id;
				}
			});
		}
	</script>
@endsection

