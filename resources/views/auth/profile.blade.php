@extends('layouts')

@section('styles')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/libs/@chenfengyuan/datepicker/datepicker.min.css">
    <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('title', 'My Profile')

@section('content')
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-lg">
                            <img src="/assets/images/{{ $data->gender }}.png" alt="Avatar"
                                style="width: 100px; height: 100px;" />
                        </div>

                        <h3 class="mt-3">{{ $data->full_name }}</h3>
                        <p class="text-small text-center">
                            {{ $data->nik }}
                            <br />
                            {{ ucwords(str_replace('_', ' ', $data->role_name)) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Profile</h4>
                    <form method="POST" action="{{ route('profile.store') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control"
                                        placeholder="Masukan NIK"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        minlength="6" value="{{ $data->nik }}" disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control"
                                        placeholder="Masukan Nama Lengkap" value="{{ $data->full_name }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="chat_id" class="form-label">Chat ID</label>
                                    <input type="text" name="chat_id" id="chat_id" class="form-control"
                                        placeholder="Masukan Chat ID Telegram" value="{{ $data->chat_id }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="number_phone" class="form-label">Number Phone</label>
                                    <input type="text" name="number_phone" id="number_phone" class="form-control"
                                        placeholder="Masukan Nomor Telpon"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        minlength="11" value="{{ $data->number_phone }}" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="home_address" class="form-label">Home Address</label>
                            <textarea class="form-control" placeholder="Masukan Alamat Rumah" name="home_address" id="home_address" rows="3">{{ $data->home_address }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control select2"
                                        placeholder="Pilih Jenis Kelamin">
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        @foreach ($get_gender as $gender)
                                            <option value="{{ $gender->id }}"
                                                {{ $gender->id == $data->gender ? 'selected' : '' }}>
                                                {{ $gender->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="text" name="date_of_birth" id="date_of_birth"
                                        class="form-control datepicker" placeholder="Masukan Tanggal Lahir"
                                        value="{{ $data->date_of_birth }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="place_of_birth" class="form-label">Place of Birth</label>
                                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                                        placeholder="Masukan Tempat Lahir" value="{{ $data->place_of_birth }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="regional_id" class="form-label">Regional</label>
                                    <select name="regional_id" id="regional_id" class="form-control select2" required>
                                        <option></option>
                                        @foreach ($get_regional as $regional)
                                            <option value="{{ $regional->id }}"
                                                {{ $regional->id == $data->regional_id ? 'selected' : '' }}>
                                                {{ $regional->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="witel_id" class="form-label">Witel</label>
                                    <select name="witel_id" id="witel_id" class="form-control select2" required>
                                        <option></option>
                                        @foreach ($get_witel as $witel)
                                            <option value="{{ $witel->id }}"
                                                {{ $witel->id == $data->witel_id ? 'selected' : '' }}>{{ $witel->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mitra_id" class="form-label">Mitra</label>
                                    <select name="mitra_id" id="mitra_id" class="form-control select2" required>
                                        <option></option>
                                        @foreach ($get_mitra as $mitra)
                                            <option value="{{ $mitra->id }}"
                                                {{ $mitra->id == $data->mitra_id ? 'selected' : '' }}>{{ $mitra->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sub_unit_id" class="form-label">Sub Unit</label>
                                    <select name="sub_unit_id" id="sub_unit_id" class="form-control select2" required>
                                        <option value="" disabled selected>Pilih Sub Unit</option>
                                        @foreach ($get_sub_unit as $sub_unit)
                                            <option value="{{ $sub_unit->id }}"
                                                {{ $sub_unit->id == $data->sub_unit_id ? 'selected' : '' }}>
                                                {{ $sub_unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sub_group_id" class="form-label">Sub Group</label>
                                    <select name="sub_group_id" id="sub_group_id" class="form-control select2" required>
                                        <option value="" disabled selected>Pilih Sub Group</option>
                                        @foreach ($get_sub_group as $sub_group)
                                            <option value="{{ $sub_group->id }}"
                                                {{ $sub_group->id == $data->sub_group_id ? 'selected' : '' }}>
                                                {{ $sub_group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" name="password" id="password" class="form-control"
                                placeholder="Masukan Password Baru (Opsional)" />
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-danger" id="deactivate-account">
                                <i class="fas fa-user-slash"></i>&nbsp; Deactivate Account
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>&nbsp; Save Changes
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
    <script src="/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                allowClear: true,
                placeholder: "Silahkan Pilih"
            });

            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
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

            $('#regional_id').on('change', function() {
                let regionalId = $(this).val();
                $.ajax({
                    url: `/ajax/employee-management/get-witel-by-regional/${regionalId}`,
                    method: 'GET',
                    success: function(data) {
                        let witelSelect = $('#witel_id');
                        witelSelect.empty().append('<option></option>');
                        data.forEach(function(item) {
                            witelSelect.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                        choicesInstances['witel_id'].setChoices(data.map(item => ({
                            value: item.id,
                            label: item.name
                        })), 'value', 'label', true);
                    }
                });

                $.ajax({
                    url: `/ajax/employee-management/get-sub-unit-by-regional/${regionalId}`,
                    method: 'GET',
                    success: function(data) {
                        let subUnitSelect = $('#sub_unit_id');
                        subUnitSelect.empty().append('<option></option>');
                        data.forEach(function(item) {
                            subUnitSelect.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                        choicesInstances['sub_unit_id'].setChoices(data.map(item => ({
                            value: item.id,
                            label: item.name
                        })), 'value', 'label', true);
                    }
                });
            });

            $('#witel_id').on('change', function() {
                let witelId = $(this).val();
                if (witelId) {
                    $.ajax({
                        url: `/ajax/employee-management/get-mitra-by-witel/${witelId}`,
                        method: 'GET',
                        success: function(data) {
                            let mitraSelect = $('#mitra_id');
                            mitraSelect.empty().append('<option></option>');
                            data.forEach(function(item) {
                                mitraSelect.append(
                                    `<option value="${item.id}">${item.name}</option>`
                                );
                            });
                            choicesInstances['mitra_id'].setChoices(data.map(item => ({
                                value: item.id,
                                label: item.name
                            })), 'value', 'label', true);
                        }
                    });
                }
            });

            $('#deactivate-account').on('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, deactivate it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `{{ route('profile.deactivate') }}`;
                    }
                });
            });
        });
    </script>
@endsection
