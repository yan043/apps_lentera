@extends('layouts.general')

@section('css')
<link href="/theme/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/theme/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
@endsection

@section('title', 'Data Mitra')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Mitra</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="mid_center">
                                        <th>#</th>
                                        <th>Witel</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($data as $k => $v)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle; width: 5%">{{ ++$k }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $v->witel_name }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $v->name }}</td>
                                            <td style="width: 10%">
                                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $v->id }}">
                                                    <i class="fa fa-edit" style="color: white;"></i>
                                                </a>
                                                <div class="modal fade" id="editModal{{ $v->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <form action="{{ route('settings.mitra.store') }}" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="editModal{{ $v->id }}Label">Edit Mitra</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label for="witel_id" class="col-sm-4 col-form-label" style="text-align: center; vertical-align: middle;">Witel</label>
                                                                        <div class="col-sm-8">
                                                                            <select class="form-control select2" id="witel_id{{ $v->id }}" name="witel_id" required>
                                                                                <option value="" disabled selected>Pilih Witel</option>
                                                                                @foreach($witels as $witel)
                                                                                    <option value="{{ $witel->id }}" {{ $witel->id == $v->witel_id ? 'selected' : '' }}>{{ $witel->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="name" class="col-sm-4 col-form-label" style="text-align: center; vertical-align: middle;">Name</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $v->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $v->id }}">
                                                    <i class="fa fa-trash" style="color: white;"></i>
                                                </a>
                                                <div class="modal fade" id="deleteModal{{ $v->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                                        <div class="modal-content">
                                                            <form action="{{ route('settings.mitra.destroy', $v->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="deleteModal{{ $v->id }}Label">Delete Mitra</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure want to delete this data?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="/theme/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/theme/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/theme/vendors/select2/dist/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Witel",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
