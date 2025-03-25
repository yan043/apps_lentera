@extends('layouts.general')

@section('styles')
<link rel="stylesheet" href="/assets/extensions/choices.js/public/assets/styles/choices.css">
<link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/table-datatable-jquery.css">
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
        @include('partials.alerts')
        <button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
            <i class="bi bi-plus-circle"></i>&nbsp; Add Data
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

<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-label">Add Sub-Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/reporting-configuration/sub-status/store" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Status Name</label>
                        <select class="choices form-select" name="order_status_id" required>
                            <option value="" selected disabled>Silahkan Pilih Nama Status</option>
                            @foreach($get_order_status as $order_status)
                                <option value="{{ $order_status->id }}">{{ $order_status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sub-Status Name</label>
                        <input type="text" class="form-control" name="name" required>
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
<script src="/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $(".choices").each(function() {
            if (!$(this).data("choices")) {
                new Choices(this, {
                    placeholder: true,
                    allowHTML: true,
                    removeItemButton: true,
                    shouldSort: false
                });
                $(this).data("choices", true);
            }
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
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-${data}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(${data})">
                                <i class="bi bi-trash"></i>
                            </button>
                            ${generateEditModal(row)}
                        `;
                    }
                }
            ]
        });
    });

    function generateOrderStatusOptions(selectedId) {
        let options = `<option value="" disabled>Silahkan Pilih Nama Status</option>`;
        @foreach($get_order_status as $order_status)
            options += `<option value="{{ $order_status->id }}" ${selectedId == {{ $order_status->id }} ? 'selected' : ''}>
                            {{ $order_status->name }}
                        </option>`;
        @endforeach
        return options;
    }

    function generateEditModal(data) {
        let modal = `
            <div class="modal fade" id="modal-edit-${data.id}" tabindex="-1" aria-labelledby="modal-edit-label-${data.id}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-edit-label-${data.id}">Edit Sub-Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/reporting-configuration/sub-status/store" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="${data.id}">
                                <div class="mb-3">
                                    <label class="form-label">Status Name</label>
                                    <select class="choices form-select" name="order_status_id" id="select-edit-${data.id}" required>
                                        ${generateOrderStatusOptions(data.order_status_id)}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sub-Status Name</label>
                                    <input type="text" class="form-control" name="name" required value="${data.name}">
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
        `;

        $("body").append(modal);

        setTimeout(() => {
            if (!document.querySelector(`#select-edit-${data.id}`).dataset.choicesInitialized) {
                new Choices(`#select-edit-${data.id}`, {
                    placeholder: true,
                    allowHTML: true,
                    removeItemButton: true,
                    shouldSort: false
                });
                document.querySelector(`#select-edit-${data.id}`).dataset.choicesInitialized = true;
            }
        }, 500);

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
                window.location.href = '/reporting-configuration/sub-status/destroy/' + id;
            }
        });
    }
</script>
@endsection
