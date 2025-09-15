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

@section('title', 'Order Segments')

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
                            <th class="text-center">Segment</th>
                            <th class="text-center">Photo List</th>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-add-label">Add Segment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/reporting-configuration/segments/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Segment Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo List (JSON format)</label>
                            <textarea class="form-control" name="photo_list" rows="3" placeholder='["photo1","photo2"]'></textarea>
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
            let table = $(".detail-data-table").DataTable({
                processing: true,
                ajax: {
                    url: '/ajax/reporting-configuration/segments',
                    dataSrc: ''
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'photo_list'
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
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-edit-label-${data.id}">Edit Segment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/reporting-configuration/segments/store" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="${data.id}">
                                <div class="mb-3">
                                    <label class="form-label">Segment Name</label>
                                    <input type="text" class="form-control" name="name" required value="${data.name || ''}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Photo List (JSON format)</label>
                                    <textarea class="form-control" name="photo_list" rows="3" placeholder='["photo1","photo2"]'>${data.photo_list || ''}</textarea>
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
                    window.location.href = '/reporting-configuration/segments/destroy/' + id;
                }
            });
        }
    </script>
@endsection
