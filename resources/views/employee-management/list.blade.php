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

@section('title', 'Employee List')

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
							<th>NIK</th>
							<th>Name</th>
							<th>Regional</th>
							<th>Witel</th>
							<th>Mitra</th>
							<th>Sub Unit</th>
							<th>Sub Group</th>
							<th>Role</th>
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
					<h5 class="modal-title">Add Employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="add-form" action="{{ route('employee.store') }}" method="POST">
						@csrf
						<div class="mb-3">
							<label class="form-label">NIK</label>
							<input type="text" class="form-control" name="nik" placeholder="Masukan NIK" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Full Name</label>
							<input type="text" class="form-control" name="full_name" placeholder="Masukan Nama Lengkap" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="text" class="form-control" name="password" placeholder="Masukan Password Baru (Opsional)">
						</div>
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
							<label class="form-label">Mitra</label>
							<select class="form-control select2" id="mitra_id_add" name="mitra_id" required>
								<option value="" selected disabled>Pilih Mitra</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Sub Unit</label>
							<select class="form-control select2" id="sub_unit_id_add" name="sub_unit_id" required>
								<option value="" selected disabled>Pilih Sub Unit</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Sub Group</label>
							<select class="form-control select2" id="sub_group_id_add" name="sub_group_id" required>
								<option value="" selected disabled>Pilih Sub Grup</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Role</label>
							<select class="form-control select2" id="role_id_add" name="role_id" required>
								<option value="" selected disabled>Pilih Peran Pengguna</option>
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
					<h5 class="modal-title">Edit Employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="edit-form" action="" method="POST">
						@csrf
						@method('PUT')
						<input type="hidden" name="id" id="id">
						<div class="mb-3">
							<label class="form-label">NIK</label>
							<input type="text" class="form-control" id="nik_edit" name="nik" placeholder="Masukan NIK" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Full Name</label>
							<input type="text" class="form-control" id="full_name_edit" name="full_name"
								placeholder="Masukan Nama Lengkap" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="text" class="form-control" id="password_edit" name="password"
								placeholder="Masukan Password Baru (Opsional)">
						</div>
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
							<label class="form-label">Mitra</label>
							<select class="form-control select2" id="mitra_id_edit" name="mitra_id" required>
								<option value="" selected disabled>Pilih Mitra</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Sub Unit</label>
							<select class="form-control select2" id="sub_unit_id_edit" name="sub_unit_id" required>
								<option value="" selected disabled>Pilih Sub Unit</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Sub Group</label>
							<select class="form-control select2" id="sub_group_id_edit" name="sub_group_id" required>
								<option value="" selected disabled>Pilih Sub Grup</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Role</label>
							<select class="form-control select2" id="role_id_edit" name="role_id" required>
								<option value="" selected disabled>Pilih Peran Pengguna</option>
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
							$(this).attr('id').includes('mitra') ? "Pilih Mitra" :
							$(this).attr('id').includes('sub_unit') ? "Pilih Sub Unit" :
							$(this).attr('id').includes('sub_group') ? "Pilih Sub Grup" :
							$(this).attr('id').includes('role') ? "Pilih Peran Pengguna" :
							"Pilih opsi";
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

			$.ajax({
				url: '/ajax/organization-structure/sub-group',
				method: 'GET',
				success: function(data) {
					let subGroupSelect = $('#sub_group_id_add');
					subGroupSelect.empty().append(
						'<option value="" selected disabled>Pilih Sub Grup</option>');
					data.forEach(function(item) {
						subGroupSelect.append(
							`<option value="${item.id}">${item.name}</option>`);
					});
				}
			});

			$.ajax({
				url: '/ajax/employee-management/roles-permissions',
				method: 'GET',
				success: function(data) {
					let roleSelect = $('#role_id_add');
					roleSelect.empty().append(
						'<option value="" selected disabled>Pilih Peran Pengguna</option>');
					data.forEach(function(item) {
						roleSelect.append(`<option value="${item.id}">${item.name}</option>`);
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

					$.ajax({
						url: `/ajax/employee-management/get-sub-unit-by-regional/${regionalId}`,
						method: 'GET',
						success: function(data) {
							let subUnitSelect = $('#sub_unit_id_add');
							subUnitSelect.empty().append(
								'<option value="" selected disabled>Pilih Sub Unit</option>'
							);
							data.forEach(function(item) {
								subUnitSelect.append(
									`<option value="${item.id}">${item.name}</option>`
								);
							});
						}
					});
				}
			});

			$('#witel_id_add').on('change', function() {
				let witelId = $(this).val();
				if (witelId) {
					$.ajax({
						url: `/ajax/employee-management/get-mitra-by-witel/${witelId}`,
						method: 'GET',
						success: function(data) {
							let mitraSelect = $('#mitra_id_add');
							mitraSelect.empty().append(
								'<option value="" selected disabled>Pilih Mitra</option>');
							data.forEach(function(item) {
								mitraSelect.append(
									`<option value="${item.id}">${item.name}</option>`
								);
							});
						}
					});
				}
			});

			let table = $(".detail-data-table").DataTable({
				processing: true,
				ajax: {
					url: '/ajax/employee-management/list',
					dataSrc: ''
				},
				columns: [{
						data: 'id'
					},
					{
						data: 'nik'
					},
					{
						data: 'full_name'
					},
					{
						data: 'regional_name'
					},
					{
						data: 'witel_name'
					},
					{
						data: 'mitra_name'
					},
					{
						data: 'sub_unit_name'
					},
					{
						data: 'sub_group_name'
					},
					{
						data: 'role_name'
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
                            &nbsp;
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
				url: `/ajax/employee-management/list/${id}`,
				method: 'GET',
				success: function(data) {
					$('#edit-form').attr('action', '{{ url('employee-management/list/update') }}/' + id);
					$('#nik_edit').val(data.nik);
					$('#full_name_edit').val(data.full_name);
					$('#password_edit').val('');

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
						url: `/ajax/employee-management/get-mitra-by-witel/${data.witel_id}`,
						method: 'GET',
						success: function(mitraData) {
							let mitraSelect = $('#mitra_id_edit');
							mitraSelect.empty().append(
								'<option value="" selected disabled>Pilih Mitra</option>');
							mitraData.forEach(function(item) {
								mitraSelect.append(
									`<option value="${item.id}">${item.name}</option>`);
							});
							mitraSelect.val(data.mitra_id).trigger('change');
						}
					});

					$.ajax({
						url: `/ajax/employee-management/get-sub-unit-by-regional/${data.regional_id}`,
						method: 'GET',
						success: function(subUnitData) {
							let subUnitSelect = $('#sub_unit_id_edit');
							subUnitSelect.empty().append(
								'<option value="" selected disabled>Pilih Sub Unit</option>');
							subUnitData.forEach(function(item) {
								subUnitSelect.append(
									`<option value="${item.id}">${item.name}</option>`);
							});
							subUnitSelect.val(data.sub_unit_id).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/organization-structure/sub-group',
						method: 'GET',
						success: function(subGroupData) {
							let subGroupSelect = $('#sub_group_id_edit');
							subGroupSelect.empty().append(
								'<option value="" selected disabled>Pilih Sub Grup</option>');
							subGroupData.forEach(function(item) {
								subGroupSelect.append(
									`<option value="${item.id}">${item.name}</option>`);
							});
							subGroupSelect.val(data.sub_group_id).trigger('change');
						}
					});

					$.ajax({
						url: '/ajax/employee-management/roles-permissions',
						method: 'GET',
						success: function(roleData) {
							let roleSelect = $('#role_id_edit');
							roleSelect.empty().append(
								'<option value="" selected disabled>Pilih Peran Pengguna</option>'
							);
							roleData.forEach(function(item) {
								roleSelect.append(
									`<option value="${item.id}">${item.name}</option>`);
							});
							roleSelect.val(data.role_id).trigger('change');
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
					window.location.href = '/employee-management/destroy/' + id;
				}
			});
		}
	</script>
@endsection

