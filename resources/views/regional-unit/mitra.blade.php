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

@section('title', 'Data Mitra')

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

<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-label">Add Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/regional-unit/mitra/store" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="witel_id_add" class="form-label">Witel Name</label>
                        <select class="choices form-select" id="witel_id_add" name="witel_id" required>
                            <option value="" selected disabled>Silahkan Pilih Nama Witel</option>
                            @foreach($get_witel as $witel)
                                <option value="{{ $witel->id }}">{{ $witel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_add" class="form-label">Mitra Name</label>
                        <input type="text" class="form-control" id="name_add" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="alias_add" class="form-label">Alias</label>
                        <input type="text" class="form-control" id="alias_add" name="alias" required>
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
                url: '/ajax/regional-unit/mitra',
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
            url: `/ajax/regional-unit/mitra/${id}`,
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
                            <h5 class="modal-title" id="modal-edit-label-${data.id}">Edit Mitra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/regional-unit/mitra/store" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="${data.id}">
                                <div class="mb-3">
                                    <label for="witel_id_${data.id}" class="form-label">Witel Name</label>
                                    <select class="choices form-select" id="witel_id_${data.id}" name="witel_id" required>
                                        ${generateWitelOptions(data.witel_id)}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name_${data.id}" class="form-label">Mitra Name</label>
                                    <input type="text" class="form-control" id="name_${data.id}" name="name" value="${data.name}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alias_${data.id}" class="form-label">Alias</label>
                                    <input type="text" class="form-control" id="alias_${data.id}" name="alias" value="${data.alias}" required>
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
            if (!document.querySelector(`#witel_id_${data.id}`).dataset.choicesInitialized) {
                new Choices(`#witel_id_${data.id}`, {
                    placeholder: true,
                    allowHTML: true,
                    removeItemButton: true,
                    shouldSort: false
                });
                document.querySelector(`#witel_id_${data.id}`).dataset.choicesInitialized = true;
            }
        }, 500);

        return modal;
    }

    function generateWitelOptions(selectedId) {
        let options = `<option value="" disabled>Silahkan Pilih Nama Witel</option>`;
        @foreach($get_witel as $witel)
            options += `<option value="{{ $witel->id }}" ${selectedId == {{ $witel->id }} ? 'selected' : ''}>
                            {{ $witel->name }}
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
                window.location.href = '/regional-unit/mitra/destroy/' + id;
            }
        });
    }
</script>
@endsection
