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

@section('title', 'Data Service Area')

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
							<th>Regional</th>
							<th>Witel</th>
							<th>Name</th>
							<th>Chat ID</th>
							<th>Head Service Area</th>
							<th>Off Service Area</th>
							<th>Kor Lap 1</th>
							<th>Kor Lap 2</th>
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
					<h5 class="modal-title">Add Service Area</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="{{ route('organization-structure.service-area.store') }}" method="POST">
						@csrf
						<div class="mb-3">
							<label class="form-label">Regional</label>
							<select class="form-control select2" id="regional_id_add" name="regional_id" required>
								<option value="" selected disabled>Pilih Regional</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Witel</label>
							<select class="form-control select2" id="witel_id_add" name="witel_id" required>
								<option value="" selected disabled>Pilih Witel</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Service Area Name</label>
							<input type="text" class="form-control" name="name" placeholder="Enter Service Area Name" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Chat ID</label>
							<input type="text" class="form-control" name="chat_id" placeholder="Enter Chat ID" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Head of Service Area</label>
							<select class="form-control select2" id="head_service_area_id_add" name="head_service_area" required>
								<option value="" selected disabled>Pilih Head of Service Area</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Officer of Service Area</label>
							<select class="form-control select2" id="officer_service_area_id_add" name="officer_service_area" required>
								<option value="" selected disabled>Pilih Officer of Service Area</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Koordinator Lapangan 1</label>
							<select class="form-control select2" id="koordinator_lapangan_1_id_add" name="kordinator_lapangan1" required>
								<option value="" selected disabled>Pilih Koordinator Lapangan 1</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Koordinator Lapangan 2</label>
							<select class="form-control select2" id="koordinator_lapangan_2_id_add" name="kordinator_lapangan2">
								<option value="" selected disabled>Pilih Koordinator Lapangan 2</option>
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
					<h5 class="modal-title">Edit Service Area</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="edit-form" action="{{ route('organization-structure.service-area.store') }}" method="POST">
						@csrf
						<input type="hidden" name="id">
						<div class="mb-3">
							<label class="form-label">Regional</label>
							<select class="form-control select2" id="regional_id_edit" name="regional_id" required>
								<option value="" selected disabled>Pilih Regional</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Witel</label>
							<select class="form-control select2" id="witel_id_edit" name="witel_id" required>
								<option value="" selected disabled>Pilih Witel</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Service Area Name</label>
							<input type="text" class="form-control" id="name_edit" name="name"
								placeholder="Enter Service Area Name" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Chat ID</label>
							<input type="text" class="form-control" id="chat_id_edit" name="chat_id" placeholder="Enter Chat ID"
								required>
						</div>
						<div class="mb-3">
							<label class="form-label">Head of Service Area</label>
							<select class="form-control select2" id="head_service_area_id_edit" name="head_service_area" required>
								<option value="" selected disabled>Pilih Head of Service Area</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Officer of Service Area</label>
							<select class="form-control select2" id="officer_service_area_id_edit" name="officer_service_area" required>
								<option value="" selected disabled>Pilih Officer of Service Area</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Koordinator Lapangan 1</label>
							<select class="form-control select2" id="koordinator_lapangan_1_id_edit" name="kordinator_lapangan1" required>
								<option value="" selected disabled>Pilih Koordinator Lapangan 1</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Koordinator Lapangan 2</label>
							<select class="form-control select2" id="koordinator_lapangan_2_id_edit" name="kordinator_lapangan2">
								<option value="" selected disabled>Pilih Koordinator Lapangan 2</option>
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
						return $(this).attr('id').includes('regional') ? "Pilih Regional" :
							$(this).attr('id').includes('witel') ? "Pilih Witel" :
							$(this).attr('id').includes('head_service_area') ?
							"Pilih Head of Service Area" :
							$(this).attr('id').includes('officer_service_area') ?
							"Pilih Officer of Service Area" :
							$(this).attr('id').includes('koordinator_lapangan_1') ?
							"Pilih Koordinator Lapangan 1" :
							$(this).attr('id').includes('koordinator_lapangan_2') ?
							"Pilih Koordinator Lapangan 2" : "Pilih opsi";
					}
				});
			});

			$.ajax({
				url: '/ajax/organization-structure/regional',
				method: 'GET',
				success: function(data) {
					let regionalSelect = $('#regional_id_add');
					regionalSelect.empty().append(
						'<option value="" selected disabled>Pilih Regional</option>');
					data.forEach(function(item) {
						regionalSelect.append(
							`<option value="${item.id}">${item.name}</option>`);
					});
				}
			});

			$('#regional_id_add').on('change', function() {
				let regionalId = $(this).val();
				if (regionalId) {
					$.ajax({
						url: `/ajax/employee-management/get-witel-by-regional/${regionalId}`,
						method: 'GET',
						success: function(data) {
							let witelSelect = $('#witel_id_add');
							witelSelect.empty().append(
								'<option value="" selected disabled>Pilih Witel</option>');
							data.forEach(function(item) {
								witelSelect.append(
									`<option value="${item.id}">${item.name}</option>`
								);
							});
						}
					});
				}
			});

			$.ajax({
				url: '/ajax/employee-management/list',
				method: 'GET',
				success: function(data) {
					let headSelect = $('#head_service_area_id_add');
					headSelect.empty().append(
						'<option value="" selected disabled>Pilih Head of Service Area</option>');
					data.forEach(function(item) {
						headSelect.append(
							`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
						);
					});
				}
			});

			$.ajax({
				url: '/ajax/employee-management/list',
				method: 'GET',
				success: function(data) {
					let officerSelect = $('#officer_service_area_id_add');
					officerSelect.empty().append(
						'<option value="" selected disabled>Pilih Officer of Service Area</option>');
					data.forEach(function(item) {
						officerSelect.append(
							`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
						);
					});
				}
			});

			$.ajax({
				url: '/ajax/employee-management/list',
				method: 'GET',
				success: function(data) {
					let koor1Select = $('#koordinator_lapangan_1_id_add');
					koor1Select.empty().append(
						'<option value="" selected disabled>Pilih Koordinator Lapangan 1</option>');
					data.forEach(function(item) {
						koor1Select.append(
							`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
						);
					});
				}
			});

			$.ajax({
				url: '/ajax/employee-management/list',
				method: 'GET',
				success: function(data) {
					let koor2Select = $('#koordinator_lapangan_2_id_add');
					koor2Select.empty().append(
						'<option value="" selected disabled>Pilih Koordinator Lapangan 2</option>');
					data.forEach(function(item) {
						koor2Select.append(
							`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
						);
					});
				}
			});

			let table = $(".detail-data-table").DataTable({
				processing: true,
				ajax: {
					url: '/ajax/organization-structure/service-area',
					dataSrc: ''
				},
				columns: [{
						data: 'id'
					},
					{
						data: 'regional_name'
					},
					{
						data: 'witel_name'
					},
					{
						data: 'name'
					},
					{
						data: 'chat_id'
					},
					{
						data: null,
						render: function(data, type, row) {
							if (row.head_service_area) {
								return row.head_service_area_name + ' (' + row.head_service_area + ')';
							} else {
								return row.head_service_area_name || '';
							}
						}
					},
					{
						data: null,
						render: function(data, type, row) {
							if (row.officer_service_area) {
								return row.officer_service_area_name + ' (' + row
									.officer_service_area + ')';
							} else {
								return row.officer_service_area_name || '';
							}
						}
					},
					{
						data: null,
						render: function(data, type, row) {
							if (row.kordinator_lapangan1) {
								return row.kordinator_lapangan1_name + ' (' + row
									.kordinator_lapangan1 + ')';
							} else {
								return row.kordinator_lapangan1_name || '';
							}
						}
					},
					{
						data: null,
						render: function(data, type, row) {
							if (row.kordinator_lapangan2) {
								return row.kordinator_lapangan2_name + ' (' + row
									.kordinator_lapangan2 + ')';
							} else {
								return row.kordinator_lapangan2_name || '';
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
				url: `/ajax/organization-structure/service-area/${id}`,
				method: 'GET',
				success: function(data) {
					$('#edit-form').attr('action', '/organization-structure/service-area/store')
					$('#edit-form').append('<input type="hidden" name="_method" value="POST">');
					$('input[name="id"]').val(data.id);
					$('#name_edit').val(data.name);
					$('#chat_id_edit').val(data.chat_id);

					$.ajax({
						url: '/ajax/organization-structure/regional',
						method: 'GET',
						success: function(regionalData) {
							let regionalSelect = $('#regional_id_edit');
							regionalSelect.empty().append(
								'<option value="" selected disabled>Pilih Regional</option>');
							regionalData.forEach(function(item) {
								regionalSelect.append(
									`<option value="${item.id}">${item.name}</option>`);
							});
							regionalSelect.val(data.regional_id).trigger('change');
						}
					});

					$.ajax({
						url: `/ajax/employee-management/get-witel-by-regional/${data.regional_id}`,
						method: 'GET',
						success: function(witelData) {
							let witelSelect = $('#witel_id_edit');
							witelSelect.empty().append(
								'<option value="" selected disabled>Pilih Witel</option>');
							witelData.forEach(function(item) {
								witelSelect.append(
									`<option value="${item.id}">${item.name}</option>`);
							});
							witelSelect.val(data.witel_id).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/employee-management/list',
						method: 'GET',
						success: function(headData) {
							let headSelect = $('#head_service_area_id_edit');
							headSelect.empty().append(
								'<option value="" selected disabled>Pilih Head of Service Area</option>'
							);
							headData.forEach(function(item) {
								headSelect.append(
									`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
								);
							});
							headSelect.val(data.head_service_area_id).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/employee-management/list',
						method: 'GET',
						success: function(officerData) {
							let officerSelect = $('#officer_service_area_id_edit');
							officerSelect.empty().append(
								'<option value="" selected disabled>Pilih Officer of Service Area</option>'
							);
							officerData.forEach(function(item) {
								officerSelect.append(
									`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
								);
							});
							officerSelect.val(data.officer_service_area_id).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/employee-management/list',
						method: 'GET',
						success: function(koor1Data) {
							let koor1Select = $('#koordinator_lapangan_1_id_edit');
							koor1Select.empty().append(
								'<option value="" selected disabled>Pilih Koordinator Lapangan 1</option>'
							);
							koor1Data.forEach(function(item) {
								koor1Select.append(
									`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
								);
							});
							koor1Select.val(data.koordinator_lapangan_1_id).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/employee-management/list',
						method: 'GET',
						success: function(koor2Data) {
							let koor2Select = $('#koordinator_lapangan_2_id_edit');
							koor2Select.empty().append(
								'<option value="" selected disabled>Pilih Koordinator Lapangan 2</option>'
							);
							koor2Data.forEach(function(item) {
								koor2Select.append(
									`<option value="${item.nik}">${item.full_name} (${item.nik})</option>`
								);
							});
							koor2Select.val(data.koordinator_lapangan_2_id).trigger('change');
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
					window.location.href = '/organization-structure/service-area/destroy/' + id;
				}
			});
		}
	</script>
@endsection

