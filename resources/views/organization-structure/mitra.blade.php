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

@section('title', 'Data Mitra')

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
                        <th class="text-center">Witel</th>
                        <th class="text-center">Mitra</th>
                        <th class="text-center">Alias</th>
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
                <h5 class="modal-title">Add Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/organization-structure/mitra/store" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Witel</label>
                        <select class="form-control select2" name="witel_id" required>
                            <option value="" selected disabled>Select Witel</option>
                            @foreach($get_witel as $witel)
                                <option value="{{ $witel->id }}">{{ $witel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mitra Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Mitra Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alias</label>
                        <input type="text" class="form-control" name="alias" placeholder="Enter Alias" required>
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
                <h5 class="modal-title">Edit Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/organization-structure/mitra/store" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Witel</label>
                        <select class="form-control select2" name="witel_id" required>
                            <option value="" selected disabled>Select Witel</option>
                            @foreach($get_witel as $witel)
                                <option value="{{ $witel->id }}">{{ $witel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mitra Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Mitra Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alias</label>
                        <input type="text" class="form-control" name="alias" placeholder="Enter Alias" required>
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
            placeholder: "Silahkan Pilih Witel"
        });

        let table = $(".detail-data-table").DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: '/ajax/organization-structure/mitra',
                dataSrc: ''
            },
            columns: [
                { data: 'id' },
                { data: 'witel_name' },
                { data: 'name' },
                { data: 'alias' },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-sm btn-primary" onclick="openEditModal(${data}, '${row.witel_id}', '${row.name}', '${row.alias}')">
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
                placeholder: "Silahkan Pilih Witel"
            });
        });
    });

    function openEditModal(id, witelId, name, alias) {
        $('#modal-edit input[name="id"]').val(id);
        $('#modal-edit select[name="witel_id"]').val(witelId).trigger('change');
        $('#modal-edit input[name="name"]').val(name);
        $('#modal-edit input[name="alias"]').val(alias);
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
                window.location.href = '/organization-structure/mitra/destroy/' + id;
            }
        });
    }
</script>
@endsection
