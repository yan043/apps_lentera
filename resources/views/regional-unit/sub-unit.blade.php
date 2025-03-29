@extends('layouts')

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

@section('title', 'Data Sub-Unit')

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
                        <th class="text-center">Regional</th>
                        <th class="text-center">Sub-Unit</th>
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
                <h5 class="modal-title" id="modal-add-label">Add Sub-Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/regional-unit/sub-unit/store" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="regional_id_add" class="form-label">Regional</label>
                        <select class="choices form-select" style="width: 100%;" id="regional_id_add" name="regional_id" required>
                            <option></option>
                            @foreach($get_regional as $regional)
                                <option value="{{ $regional->id }}">{{ $regional->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_add" class="form-label">Sub-Unit Name</label>
                        <input type="text" class="form-control" id="name_add" name="name" required>
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
        let choices = document.querySelectorAll(".choices");
        for (let i = 0; i < choices.length; i++) {
            new Choices(choices[i], {
                placeholder: true,
                allowHTML: true,
                removeItemButton: true,
                shouldSort: false
            });
        }

        let table = $(".detail-data-table").DataTable({
            responsive: true,
            ajax: {
                url: '/ajax/regional-unit/sub-unit',
                dataSrc: ''
            },
            columns: [
                { data: 'id' },
                { data: 'regional_name' },
                { data: 'name' },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-sm btn-primary" onclick="loadEditModal(${data})">
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
    });

    function loadEditModal(id) {
        $.ajax({
            url: `/ajax/regional-unit/sub-unit/${id}`,
            method: 'GET',
            success: function(data) {
                let modal = generateEditModal(data);
                $("body").append(modal);
                $(`#modal-edit-${data.id}`).modal('show');
            }
        });
    }

    function generateEditModal(data) {
        let modal = `
            <div class="modal fade" id="modal-edit-${data.id}" tabindex="-1" aria-labelledby="modal-edit-label-${data.id}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-edit-label-${data.id}">Edit Sub-Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/regional-unit/sub-unit/store" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="${data.id}">
                                <div class="mb-3">
                                    <label for="regional_id_${data.id}" class="form-label">Regional</label>
                                    <select class="choices form-select" style="width: 100%;" id="regional_id_${data.id}" name="regional_id" required>
                                        ${generateRegionalOptions(data.regional_id)}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name_${data.id}" class="form-label">Sub-Unit Name</label>
                                    <input type="text" class="form-control" id="name_${data.id}" name="name" value="${data.name}" required>
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

        setTimeout(() => {
            if (!document.querySelector(`#regional_id_${data.id}`).dataset.choicesInitialized) {
                new Choices(`#regional_id_${data.id}`, {
                    placeholder: true,
                    allowHTML: true,
                    removeItemButton: true,
                    shouldSort: false
                });
                document.querySelector(`#regional_id_${data.id}`).dataset.choicesInitialized = true;
            }
        }, 500);

        return modal;
    }

    function generateRegionalOptions(selectedId) {
        let options = `<option value="" disabled>Silahkan Pilih Regional</option>`;
        @foreach($get_regional as $regional)
            options += `<option value="{{ $regional->id }}" ${selectedId == {{ $regional->id }} ? 'selected' : ''}>
                            {{ $regional->name }}
                        </option>`;
        @endforeach
        return options;
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/regional-unit/sub-unit/destroy/' + id;
            }
        });
    }
</script>
@endsection
