@extends('layouts.general')

@section('styles')
<link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/table-datatable-jquery.css">
<link rel="stylesheet" href="/assets/extensions/choices.js/public/assets/styles/choices.css">
@endsection

@section('title', 'Employee List')

@section('content')
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
            <i class="bi bi-plus-circle"></i>&nbsp; Add Data
        </button>
        <div class="table-responsive">
            <table class="table table-striped text-center detail-data-table">
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-label">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/employee-management/store" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nik_add" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik_add" name="nik" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" minlength="6" required>
                    </div>
                    <div class="mb-3">
                        <label for="full_name_add" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name_add" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_add" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password_add" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="regional_id_add" class="form-label">Regional</label>
                        <select class="choices form-select" id="regional_id_add" name="regional_id" required>
                            <option></option>
                            @foreach($get_regional as $regional)
                                <option value="{{ $regional->id }}">{{ $regional->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="witel_id_add" class="form-label">Witel</label>
                        <select class="choices form-select" id="witel_id_add" name="witel_id" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mitra_id_add" class="form-label">Mitra</label>
                        <select class="choices form-select" id="mitra_id_add" name="mitra_id" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub_unit_id_add" class="form-label">Sub Unit</label>
                        <select class="choices form-select" id="sub_unit_id_add" name="sub_unit_id" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub_group_id_add" class="form-label">Sub Group</label>
                        <select class="choices form-select" id="sub_group_id_add" name="sub_group_id" required>
                            <option></option>
                            @foreach($get_sub_group as $sub_group)
                                <option value="{{ $sub_group->id }}">{{ $sub_group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role_id_add" class="form-label">Role</label>
                        <select class="choices form-select" id="role_id_add" name="role_id" required>
                            <option></option>
                            @foreach($get_role as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
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
                                <input class="form-check-input" type="radio" name="is_active" id="deactive_add" value="0">
                                <label class="form-check-label" for="deactive_add">Deactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i>&nbsp; Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script>
    $(document).ready(function() {
        let table = $(".detail-data-table").DataTable({
            responsive: true,
            ajax: {
                url: '/ajax/employee-management/list',
                dataSrc: ''
            },
            columns: [
                { data: 'id' },
                { data: 'nik' },
                { data: 'full_name' },
                { data: 'regional_name' },
                { data: 'witel_name' },
                { data: 'mitra_name' },
                { data: 'sub_unit_name' },
                { data: 'sub_group_name' },
                { data: 'role_name' },
                {
                    data: 'is_active',
                    render: function(data) {
                        return data ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                    }
                },
                {
                    data: 'id',
                    render: function(data) {
                        return `
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-${data}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(${data})">
                                <i class="bi bi-trash"></i>
                            </button>
                        `;
                    }
                }
            ]
        });

        let choicesInstances = {};
        let choicesElements = document.querySelectorAll(".choices");
        choicesElements.forEach((element) => {
            choicesInstances[element.id] = new Choices(element, {
                placeholder: true,
                allowHTML: true,
                removeItemButton: true,
                shouldSort: false
            });
        });

        $('#regional_id_add').on('change', function() {
            let regionalId = $(this).val();
            $.ajax({
                url: `/ajax/employee-management/get-witel-by-regional/${regionalId}`,
                method: 'GET',
                success: function(data) {
                    let witelSelect = $('#witel_id_add');
                    witelSelect.empty().append('<option></option>');
                    data.forEach(function(item) {
                        witelSelect.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                    choicesInstances['witel_id_add'].setChoices(data.map(item => ({ value: item.id, label: item.name })), 'value', 'label', true);
                }
            });

            $.ajax({
                url: `/ajax/employee-management/get-sub-unit-by-regional/${regionalId}`,
                method: 'GET',
                success: function(data) {
                    let subUnitSelect = $('#sub_unit_id_add');
                    subUnitSelect.empty().append('<option></option>');
                    data.forEach(function(item) {
                        subUnitSelect.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                    choicesInstances['sub_unit_id_add'].setChoices(data.map(item => ({ value: item.id, label: item.name })), 'value', 'label', true);
                }
            });
        });

        $('#witel_id_add').on('change', function() {
            let witelId = $(this).val();
            if (witelId) {
                $.ajax({
                    url: `/ajax/employee-management/get-mitra-by-witel/${witelId}`,
                    method: 'GET',
                    success: function(data) {
                        let mitraSelect = $('#mitra_id_add');
                        mitraSelect.empty().append('<option></option>');
                        data.forEach(function(item) {
                            mitraSelect.append(`<option value="${item.id}">${item.name}</option>`);
                        });
                        choicesInstances['mitra_id_add'].setChoices(data.map(item => ({ value: item.id, label: item.name })), 'value', 'label', true);
                    }
                });
            }
        });
    });

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
