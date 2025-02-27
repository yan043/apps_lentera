@extends('layouts.general')

@section('css')
<link href="/theme/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('title', 'Data Regional')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Regional</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered mid_center" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Alias</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($data as $k => $v)
                                        <tr>
                                            <td style="width: 5%">{{ ++$k }}</td>
                                            <td>{{ $v->name }}</td>
                                            <td>{{ $v->alias }}</td>
                                            <td style="width: 11%">
                                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $v->id }}">
                                                    <i class="fa fa-edit" style="color: white;"></i>
                                                </a>
                                                <div class="modal fade" id="editModal{{ $v->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <form action="{{ route('settings.regional.store') }}" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="editModal{{ $v->id }}Label">Edit Regional</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $v->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="alias" class="col-sm-4 col-form-label">Alias</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="alias" name="alias" value="{{ $v->alias }}" required>
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
                                                            <form action="{{ route('settings.regional.destroy', $v->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="deleteModal{{ $v->id }}Label">Delete Regional</h4>
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
@endsection
