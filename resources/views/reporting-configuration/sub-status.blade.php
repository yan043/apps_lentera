@extends('layouts')

@section('styles')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<style>
    .modal-body {
        text-align: left;
    }
</style>
@endsection

@section('title', 'Order Sub-Status')

@section('content')
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
            <i class="fas fa-plus-circle"></i>&nbsp; Add Data
        </button>
        <div class="table-responsive">
            <table class="table table-striped text-center detail-data-table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Sub-Status</th>
                        <th class="text-center"></th>
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
                <h5 class="modal-title">Add Sub-Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reporting-configuration/sub-status/store" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Status Name</label>
                        <select class="form-control select2" name="order_status_id" required style="margin-top: 5px;">
                            <option value="" selected disabled>Silahkan Pilih Nama Status</option>
                            @foreach($get_order_status as $order_status)
                                <option value="{{ $order_status->id }}">{{ $order_status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sub-Status Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Sub-Status" required>
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
                <h5 class="modal-title">Edit Sub-Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reporting-configuration/sub-status/store" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Status Name</label>
                        <select class="form-control select2" name="order_status_id" required>
                            <option value="" disabled>Silahkan Pilih Nama Status</option>
                            @foreach($get_order_status as $order_status)
                                <option value="{{ $order_status->id }}">{{ $order_status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sub-Status Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Sub-Status" required>
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
            placeholder: "Silahkan Pilih Nama Status"
        });

        let table = $(".detail-data-table").DataTable({
            responsive: true,
            ajax: {
                url: '/ajax/reporting-configuration/sub-status',
                dataSrc: ''
            },
            columns: [
                { data: 'id' },
                { data: 'order_status_name' },
                { data: 'name' },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit" onclick="openEditModal(${data}, '${row.order_status_id}', '${row.name}')">
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
                placeholder: "Silahkan Pilih Nama Status"
            });
        });
    });

    function openEditModal(id, orderStatusId, name) {
        $('#modal-edit input[name="id"]').val(id);
        $('#modal-edit select[name="order_status_id"]').val(orderStatusId).trigger('change');
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
                window.location.href = '/reporting-configuration/sub-status/destroy/' + id;
            }
        });
    }
</script>
@endsection
