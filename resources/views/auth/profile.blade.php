@extends('layouts.general')

@section('css')
@endsection

@section('title', 'My Profile')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-2xl">
                            <img src="/assets/compiled/jpg/{{ $data->gender }}.jpg" alt="Avatar" />
                        </div>

                        <h3 class="mt-3">{{ $data->full_name }}</h3>
                        <p class="text-small">{{ $data->nik }}</p>
                        <p class="text-small">{{ ucwords(str_replace('_', ' ', $data->role_name)) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}" />
                        <div class="form-group">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK" value="{{ $data->nik }}" disabled />
                        </div>
                        <div class="form-group">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Masukan Nama Lengkap" value="{{ $data->full_name }}" />
                        </div>
                        <div class="form-group">
                            <label for="chat_id" class="form-label">Chat ID</label>
                            <input type="text" name="chat_id" id="chat_id" class="form-control" placeholder="Masukan Chat ID Telegram" value="{{ $data->chat_id }}" />
                        </div>
                        <div class="form-group">
                            <label for="number_phone" class="form-label">Number Phone</label>
                            <input type="text" name="number_phone" id="number_phone" class="form-control" placeholder="Masukan Nomor Telpon" value="{{ $data->number_phone }}" />
                        </div>
                        <div class="form-group">
                            <label for="home_address" class="form-label">Home Address</label>
                            <textarea class="form-control" placeholder="Masukan Alamat Rumah" id="home_address" rows="3">{{ $data->home_address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="choices form-select" placeholder="Pilih Jenis Kelamin">
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                @foreach($get_gender as $gender)
                                    <option value="{{ $gender->id }}" {{ $gender->id == $data->gender ? 'selected' : '' }}>
                                        {{ $gender->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Masukan Tanggal Lahir" value="{{ $data->date_of_birth }}" />
                        </div>
                        <div class="form-group">
                            <label for="place_of_birth" class="form-label">Place of Birth</label>
                            <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Masukan Tempat Lahir" value="{{ $data->place_of_birth }}" />
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="Masukan Tempat Lahir" value="{{ $data->password }}" />
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>&nbsp; Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@endsection
