@extends('layouts')

@section('styles')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .modal-body {
            text-align: left;
        }
    </style>
@endsection

@section('title', 'Order Status')

@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.alerts')
            <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
                <i class="fas fa-plus-circle"></i>&nbsp; Add Data
            </button>
            <div class="table-responsive">
                <table class="table table-striped text-center detail-data-table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Previous Step</th>
                            <th class="text-center">Next Step</th>
                            <th class="text-center">Status Code</th>
                            <th class="text-center">Status Group</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Photo List</th>
                            <th class="text-center">Active</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-add-label">Add Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/reporting-configuration/status/store" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Previous Step</label>
                                <input type="text" class="form-control" name="previous_step">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Next Step</label>
                                <input type="text" class="form-control" name="next_step">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Code</label>
                                <input type="text" class="form-control" name="status_code">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Group</label>
                                <select class="form-control select2" name="status_group">
                                    <option value="" disabled>Select Status Group</option>
                                    <option value="READY">READY</option>
                                    <option value="ON-PROGRESS">ON-PROGRESS</option>
                                    <option value="CUST-ISSUE">CUST-ISSUE</option>
                                    <option value="TECH-ISSUE">TECH-ISSUE</option>
                                    <option value="OTHER-ISSUE">OTHER-ISSUE</option>
                                    <option value="DONE">DONE</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Is Active</label>
                                <select class="form-control select2" name="is_active">
                                    <option value="" disabled>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="status_description" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Photo List (JSON format)</label>
                                <textarea class="form-control" name="photo_list" rows="3" placeholder='["photo1","photo2"]'></textarea>
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
                allowClear: true
            });

            $('#modal-add').on('shown.bs.modal', function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    allowClear: true
                });
            });

            $(document).on('shown.bs.modal', '[id^="modal-edit-"]', function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    allowClear: true
                });
            });

            let table = $(".detail-data-table").DataTable({
                processing: true,
                ajax: {
                    url: '/ajax/reporting-configuration/status',
                    dataSrc: ''
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'previous_step'
                    },
                    {
                        data: 'next_step'
                    },
                    {
                        data: 'status_code'
                    },
                    {
                        data: 'status_group'
                    },
                    {
                        data: 'status_description'
                    },
                    {
                        data: 'photo_list'
                    },
                    {
                        data: 'is_active',
                        render: function(data) {
                            return data == 1 ? 'Active' : 'Inactive';
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-${data}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(${data})">
                                <i class="fas fa-trash"></i>
                            </button>
                            ${generateEditModal(row)}
                        `;
                        }
                    }
                ]
            });
        });

        function generateEditModal(data) {
            let modal = `
            <div class="modal fade" id="modal-edit-${data.id}" tabindex="-1" aria-labelledby="modal-edit-label-${data.id}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-edit-label-${data.id}">Edit Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/reporting-configuration/status/store" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="${data.id}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status Name</label>
                                        <input type="text" class="form-control" name="name" required value="${data.name || ''}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Previous Step</label>
                                        <input type="text" class="form-control" name="previous_step" value="${data.previous_step || ''}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Next Step</label>
                                        <input type="text" class="form-control" name="next_step" value="${data.next_step || ''}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status Code</label>
                                        <input type="text" class="form-control" name="status_code" value="${data.status_code || ''}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status Group</label>
                                        <select class="form-control select2" name="status_group">
                                            <option value="" disabled>Select Status Group</option>
                                            <option value="READY" ${data.status_group == 'READY' ? 'selected' : ''}>READY</option>
                                            <option value="ON-PROGRESS" ${data.status_group == 'ON-PROGRESS' ? 'selected' : ''}>ON-PROGRESS</option>
                                            <option value="CUST-ISSUE" ${data.status_group == 'CUST-ISSUE' ? 'selected' : ''}>CUST-ISSUE</option>
                                            <option value="TECH-ISSUE" ${data.status_group == 'TECH-ISSUE' ? 'selected' : ''}>TECH-ISSUE</option>
                                            <option value="OTHER-ISSUE" ${data.status_group == 'OTHER-ISSUE' ? 'selected' : ''}>OTHER-ISSUE</option>
                                            <option value="DONE" ${data.status_group == 'DONE' ? 'selected' : ''}>DONE</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Is Active</label>
                                        <select class="form-control select2" name="is_active">
                                            <option value="" disabled>Select Status</option>
                                            <option value="1" ${data.is_active == 1 ? 'selected' : ''}>Active</option>
                                            <option value="0" ${data.is_active == 0 ? 'selected' : ''}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="status_description" rows="3">${data.status_description || ''}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Photo List (JSON format)</label>
                                        <textarea class="form-control" name="photo_list" rows="3" placeholder='["photo1","photo2"]'>${data.photo_list || ''}</textarea>
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
        `;

            $("body").append(modal);

            return modal;
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
                    window.location.href = '/reporting-configuration/status/destroy/' + id;
                }
            });
        }
    </script>
@endsection
