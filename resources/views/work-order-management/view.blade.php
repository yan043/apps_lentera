@extends('layouts')

@section('styles')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/leaflet/leaflet.css" rel="stylesheet" type="text/css" />
<style>
    #materialModal .row {
        align-items: end;
    }

    #materialModal .form-control{
        height: 30px;
    }

    .photo-box {
        min-height: 220px;
    }
    .photo-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
    .photo-thumb {
        position: relative;
        width: 100%;
        margin-bottom: 10px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e3e3e3;
        background: #f8f9fa;
    }
    .photo-thumb img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
        cursor: pointer;
        transition: box-shadow 0.2s;
    }
    .photo-thumb img:hover {
        box-shadow: 0 0 0 2px #007bff;
    }
    .photo-thumb .photo-delete {
        position: absolute;
        top: 6px;
        right: 6px;
        background: rgba(255,255,255,0.8);
        border: none;
        border-radius: 50%;
        padding: 2px 6px;
        cursor: pointer;
        color: #dc3545;
        z-index: 2;
    }
</style>
@endsection

@section('title', 'Work Order #' . $id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <button class="btn btn-sm btn-outline-dark waves-effect waves-light" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i>&nbsp; Back
    </button>

    <div>
        <button class="btn btn-sm btn-outline-primary waves-effect waves-light me-2" data-bs-toggle="modal" data-bs-target=".bs-modal-history-log-order">
            <i class="fas fa-list"></i>&nbsp; Log Order
        </button>

        <button class="btn btn-sm btn-outline-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-modal-history-log-assignment">
            <i class="fas fa-list"></i>&nbsp; Log Assignment
        </button>
    </div>
</div>

<div class="modal fade bs-modal-history-log-order" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">History Log Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div  data-simplebar style="max-height: 310px;">
                    <ul class="verti-timeline list-unstyled">

                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <h5 class="font-size-14">15 Mor <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        If several languages coalesce of the resulting.
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-modal-history-log-assignment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">History Log Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div  data-simplebar style="max-height: 310px;">
                    <ul class="verti-timeline list-unstyled">

                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <h5 class="font-size-14">15 Mor <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        If several languages coalesce of the resulting.
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <span>Order Detail</span>
                    <button type="button" class="btn btn-sm btn-light btn-toggle-card" data-bs-toggle="collapse" data-bs-target="#card-order-detail" aria-expanded="true">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <div id="card-order-detail" class="collapse show">
                    <table class="table table-sm text-muted" style="font-size: 12px;">
                        <tr>
                            <td><strong>Order Code</strong></td>
                            <td>:</td>
                            <td id="order_code"></td>
                        </tr>
                        <tr>
                            <td><strong>Order Date</strong></td>
                            <td>:</td>
                            <td id="order_date"></td>
                        </tr>
                        <tr>
                            <td><strong>Service No</strong></td>
                            <td>:</td>
                            <td id="service_no"></td>
                        </tr>
                        <tr>
                            <td><strong>Customer Name</strong></td>
                            <td>:</td>
                            <td id="customer_name"></td>
                        </tr>
                        <tr>
                            <td><strong>Contact Phone</strong></td>
                            <td>:</td>
                            <td id="contact_phone"></td>
                        </tr>
                        <tr>
                            <td><strong>Notes</strong></td>
                            <td>:</td>
                            <td id="notes" style="word-wrap: break-word; white-space: normal;"></td>
                        </tr>
                        <tr>
                            <td><strong>Customer Coordinates</strong></td>
                            <td>:</td>
                            <td id="customer_coordinates"></td>
                        </tr>
                        <tr>
                            <td><strong>ODP Name</strong></td>
                            <td>:</td>
                            <td id="odp_name"></td>
                        </tr>
                        <tr>
                            <td><strong>Regional / Witel / STO</strong></td>
                            <td>:</td>
                            <td id="regional_witel_sto"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <span>Update Form</span>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-info waves-effect waves-light me-2" data-bs-toggle="modal" data-bs-target="#nteModal">
                            <i class="fas fa-plus"></i>&nbsp; Add NTE
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-info waves-effect waves-light me-2" data-bs-toggle="modal" data-bs-target="#materialModal">
                            <i class="fas fa-plus"></i>&nbsp; Add Material
                        </button>
                        <button type="button" class="btn btn-sm btn-light btn-toggle-card" data-bs-toggle="collapse" data-bs-target="#card-update-form" aria-expanded="true">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div id="card-update-form" class="collapse show">
                    <form method="POST" action="{{ route('work-order-management.view', $id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $id }}" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_status_id" class="form-label">Status</label>
                                    <select name="order_status_id" id="order_status_id" class="form-select select2">
                                        <option value="" disabled selected>Pilih Status</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_substatus_id" class="form-label">Sub Status</label>
                                    <select name="order_substatus_id" id="order_substatus_id" class="form-select select2">
                                        <option value="" disabled selected>Pilih Sub Status</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row is_sourcecode_hidden">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_segment_id" class="form-label">Segment</label>
                                    <select name="order_segment_id" id="order_segment_id" class="form-select select2">
                                        <option value="" disabled selected>Pilih Segment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_action_id" class="form-label">Action</label>
                                    <select name="order_action_id" id="order_action_id" class="form-select select2">
                                        <option value="" disabled selected>Pilih Action</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_phone_number" class="form-label">Customer Phone Number</label>
                                    <input type="text" name="report_phone_number" id="report_phone_number" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="+62" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_coordinates_location" class="form-label">Customer Coordinates</label>
                                    <div class="input-group">
                                        <input type="text" name="report_coordinates_location" id="report_coordinates_location" class="form-control" />
                                        <button type="button" class="btn btn-outline-secondary" id="btnMarkLocation" title="Mark Current Location">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_odp_name" class="form-label">Optical Distribution Point (ODP) Name</label>
                                    <input type="text" name="report_odp_name" id="report_odp_name" class="form-control" placeholder="ODP-xxx-xxx/xxx" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_odp_coordinates" class="form-label">ODP Coordinates</label>
                                    <div class="input-group">
                                        <input type="text" name="report_odp_coordinates" id="report_odp_coordinates" class="form-control" />
                                        <button type="button" class="btn btn-outline-secondary" id="btnMarkOdpLocation" title="Mark Current Location for ODP">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_valins_id" class="form-label">ID Valins</label>
                                    <input type="text" name="report_valins_id" id="report_valins_id" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_refferal_order_code" class="form-label">Order Code (Referral)</label>
                                    <input type="text" name="report_refferal_order_code" id="report_refferal_order_code" class="form-control" placeholder="Wonum atau Incident" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="report_notes" class="form-label">Notes</label>
                                    <textarea name="report_notes" id="report_notes" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-save"></i>&nbsp; Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <span>Location</span>
                    <button type="button" class="btn btn-sm btn-light btn-toggle-card" data-bs-toggle="collapse" data-bs-target="#card-location" aria-expanded="true">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <div id="card-location" class="collapse show">
                    <div id="map" style="height:250px; border-radius:6px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nteModal" tabindex="-1" aria-labelledby="nteModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nteModalLabel">NTE Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="inventory_nte_id_ont" class="form-label">Tipe ONT</label>
                    <select name="inventory_nte_id_ont" id="inventory_nte_id_ont" class="form-control select2">
                        <option value="" disabled selected>Pilih Tipe ONT</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="serial_number_ont" class="form-label">Serial Number ONT</label>
                    <input type="text" name="serial_number_ont" id="serial_number_ont" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="inventory_nte_id_stb" class="form-label">Tipe STB</label>
                    <select name="inventory_nte_id_stb" id="inventory_nte_id_stb" class="form-control select2">
                        <option value="" disabled selected>Pilih Tipe STB</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="serial_number_stb" class="form-label">Serial Number STB</label>
                    <input type="text" name="serial_number_stb" id="serial_number_stb" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="materialModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materialModalLabel">Material Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-0">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="inventory_material_id" class="form-label">Type of Material</label>
                        <select name="inventory_material_id[]" id="inventory_material_id" class="form-control select2">
                            <option value="" disabled selected>Pilih Jenis Material</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="inventory_material_qty" class="form-label">Qty</label>
                        <input type="number" name="inventory_material_qty" id="inventory_material_qty" class="form-control text-center" min="1" />
                    </div>
                    <div class="col-md-3 mb-4 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-outline-info waves-effect waves-light me-2" id="addMaterialBtn"><i class="fas fa-plus"></i>&nbsp; Add</button>
                    </div>
                </div>
                <div id="selectedMaterials" class="mt-3">
                    <h6>Selected Material List :</h6>
                    <div id="materialsList" class="list-group">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="saveMaterialsBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <span>Upload Photo</span>
                    <button type="button" class="btn btn-sm btn-light btn-toggle-card" data-bs-toggle="collapse" data-bs-target="#card-upload-photo" aria-expanded="true">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <div id="card-upload-photo" class="collapse show">
                    <div id="photoContainer" class="row"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="photoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="photoPreviewModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body text-center p-0">
        <img id="modalPhotoImg" src="" alt="Preview" style="max-width:100%;max-height:70vh;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="/assets/libs/select2/js/select2.min.js"></script>
<script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
    $(document).ready(function() {
        var orderData = {};

        function fetchPhotoList(sourcedata, id) {
            if (!sourcedata || !id || id === '') {
                generatePhotoBoxes([]);
                return;
            }
            $.ajax({
                url: '{{ route("ajax.reporting-configuration.photo-list", ["sourcedata" => "__sourcedata__", "id" => "__id__"]) }}'.replace('__sourcedata__', sourcedata).replace('__id__', id),
                type: 'GET',
                success: function(data) {
                    if (Array.isArray(data) && data.length > 0) {
                        generatePhotoBoxes(data);
                    } else {
                        generatePhotoBoxes([]);
                    }
                },
                error: function() {
                    generatePhotoBoxes([]);
                }
            });
        }

        function generatePhotoBoxes(photoList) {
            $('#photoContainer').empty();
            photoList.forEach(function(type) {
                var label = type.replace(/_/g, ' ');
                var html = '<div class="col-md-3 mb-3">' +
                    '<div class="border rounded p-3 text-center photo-box" style="min-height:220px;">' +
                        '<div class="d-flex justify-content-center mb-2">' +
                            '<button type="button" class="btn btn-outline-primary btn-sm add-photo-btn" data-type="' + type + '">' +
                                '<i class="fa fa-camera"></i>' +
                            '</button>' +
                            '<button type="button" class="btn btn-outline-danger btn-sm delete-all-photo-btn" data-type="' + type + '">' +
                                '<i class="fa fa-trash"></i>' +
                            '</button>' +
                        '</div>' +
                        '<div class="mb-1 font-weight-bold">' + label + '</div>' +
                        '<div id="preview_' + type + '" class="photo-preview"></div>' +
                        '<input type="file" class="d-none photo-input" id="input_' + type + '" accept="image/*" multiple data-type="' + type + '">' +
                    '</div>' +
                '</div>';
                $('#photoContainer').append(html);
            });
        }

        $(".select2").not('#inventory_nte_id_ont, #inventory_nte_id_stb, #inventory_material_id').select2({
            allowClear: true,
            placeholder: "Silahkan Pilih",
            width: '100%'
        });

        $('#order_status_id').select2({
            allowClear: true,
            placeholder: "Pilih Status",
            width: '100%',
            ajax: {
                url: '{{ route("ajax.reporting-configuration.status") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        })
                    };
                }
            }
        });

        $('#order_status_id').on('change', function() {
            var statusId = $(this).val();
            if (statusId) {
                $('#order_substatus_id').select2({
                    allowClear: true,
                    placeholder: "Pilih Sub Status",
                    width: '100%',
                    ajax: {
                        url: '{{ route("ajax.reporting-configuration.sub-status.by-status", ":id") }}'.replace(':id', statusId),
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    };
                                })
                            };
                }
            }
        });
        $('#order_substatus_id').on('change', function() {
            var sourcedata = (orderData.sourcedata || '').toLowerCase();
            if (sourcedata === 'bima') {
                var id = $(this).val();
                fetchPhotoList(sourcedata, id);
            }
        });
        $('#order_substatus_id').val(null).trigger('change');
            } else {
                $('#order_substatus_id').select2({
                    allowClear: true,
                    placeholder: "Pilih Sub Status",
                    width: '100%'
                });
                $('#order_substatus_id').val(null).trigger('change');
            }
        });

        $('#order_segment_id').select2({
            allowClear: true,
            placeholder: "Pilih Segment",
            width: '100%',
            ajax: {
                url: '{{ route("ajax.reporting-configuration.segments") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        })
                    };
                }
            }
        });

        $('#order_action_id').select2({
            allowClear: true,
            placeholder: "Pilih Action",
            width: '100%'
        });

        $('#order_segment_id').on('change', function() {
            var segmentId = $(this).val();
            if (segmentId) {
                $('#order_action_id').select2({
                    allowClear: true,
                    placeholder: "Pilih Action",
                    width: '100%',
                    ajax: {
                        url: '{{ route("ajax.reporting-configuration.actions", ":id") }}'.replace(':id', segmentId),
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    };
                                })
                            };
                        }
                    }
                });
                $('#order_action_id').val(null).trigger('change');
                var sourcedata = (orderData.sourcedata || '').toLowerCase();
                if (['insera', 'manuals'].includes(sourcedata)) {
                    fetchPhotoList(sourcedata, segmentId);
                }
            } else {
                $('#order_action_id').select2({
                    allowClear: true,
                    placeholder: "Pilih Action",
                    width: '100%'
                });
                $('#order_action_id').val(null).trigger('change');
            }
        });

        $('#inventory_nte_id_ont').select2({
            dropdownParent: $('#nteModal'),
            allowClear: true,
            placeholder: "Pilih Tipe ONT",
            width: '100%',
            ajax: {
                url: '{{ route("ajax.inventory-management.designator.nte", "ont") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                                brand: item.brand
                            };
                        })
                    };
                }
            },
            templateResult: function (item) {
                if (item.loading) return item.text;
                var $container = $('<div>');
                $container.text(item.text);
                if (item.brand) {
                    var $desc = $('<div>').text(item.brand).css({
                        'font-size': '0.8em',
                        'color': '#6c757d',
                        'margin-top': '2px'
                    });
                    $container.append($desc);
                }
                return $container;
            },
            templateSelection: function (item) {
                return item.text || item.id;
            }
        });

        $('#inventory_nte_id_stb').select2({
            dropdownParent: $('#nteModal'),
            allowClear: true,
            placeholder: "Pilih Tipe STB",
            width: '100%',
            ajax: {
                url: '{{ route("ajax.inventory-management.designator.nte", "stb") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                                brand: item.brand
                            };
                        })
                    };
                }
            },
            templateResult: function (item) {
                if (item.loading) return item.text;
                var $container = $('<div>');
                $container.text(item.text);
                if (item.brand) {
                    var $desc = $('<div>').text(item.brand).css({
                        'font-size': '0.8em',
                        'color': '#6c757d',
                        'margin-top': '2px'
                    });
                    $container.append($desc);
                }
                return $container;
            },
            templateSelection: function (item) {
                return item.text || item.id;
            }
        });

        $('#inventory_material_id').select2({
            dropdownParent: $('#materialModal'),
            allowClear: true,
            placeholder: "Pilih Jenis Material",
            width: '100%',
            ajax: {
                url: '{{ route("ajax.inventory-management.designator.materials") }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                                designator_desc: item.designator_desc
                            };
                        })
                    };
                }
            },
            templateResult: function (item) {
                if (item.loading) return item.text;
                var $container = $('<div>');
                $container.text(item.text);
                if (item.designator_desc) {
                    var $desc = $('<div>').text(item.designator_desc).css({
                        'font-size': '0.8em',
                        'color': '#6c757d',
                        'margin-top': '2px'
                    });
                    $container.append($desc);
                }
                return $container;
            },
            templateSelection: function (item) {
                return item.text || item.id;
            }
        });

        var selectedMaterials = [];

        $('#addMaterialBtn').on('click', function() {
            var material = $('#inventory_material_id').select2('data')[0];
            var qty = $('#inventory_material_qty').val();

            if (!material || !qty || qty < 1) {
                alert('Pilih material dan masukkan qty yang valid.');
                return;
            }

            var exists = selectedMaterials.find(function(m) { return m.id === material.id; });
            if (exists) {
                alert('Material sudah ditambahkan.');
                return;
            }

            selectedMaterials.push({
                id: material.id,
                name: material.text,
                designator_desc: material.designator_desc,
                qty: qty
            });

            updateMaterialsList();
            $('#inventory_material_id').val(null).trigger('change');
            $('#inventory_material_qty').val('');
        });

        function updateMaterialsList() {
            $('#materialsList').empty();
            selectedMaterials.forEach(function(material, index) {
                var itemHtml = '<div class="list-group-item d-flex justify-content-between align-items-center">' +
                    '<div>' +
                        '<strong>' + material.name + '</strong>' +
                        (material.designator_desc ? '<br><small class="text-muted">' + material.designator_desc + '</small>' : '') +
                        '<br><small>Qty: ' + material.qty + '</small>' +
                    '</div>' +
                    '<button class="btn btn-sm btn-outline-danger removeMaterial" data-index="' + index + '">Delete</button>' +
                '</div>';
                $('#materialsList').append(itemHtml);
            });
        }

        $(document).on('click', '.removeMaterial', function() {
            var index = $(this).data('index');
            selectedMaterials.splice(index, 1);
            updateMaterialsList();
        });

        $('#saveMaterialsBtn').on('click', function() {
            if (selectedMaterials.length === 0) {
                alert('Tidak ada material yang dipilih.');
                return;
            }
            console.log('Selected Materials:', selectedMaterials);
            $('#materialModal').modal('hide');
            selectedMaterials = [];
            updateMaterialsList();
        });

        loadOrderDetails();

        function loadOrderDetails() {
            $.ajax({
                url: '{{ route("ajax.work-order-management.view", $id) }}',
                type: 'GET',
                success: function(data) {
                    if (data) {
                        $('#order_code').text(data.order_code);
                        $('#order_date').text(data.order_date || '-');
                        $('#service_no').text(data.service_no || '-');
                        $('#customer_name').text(data.customer_name || '-');
                        $('#contact_phone').text(data.contact_phone || '-');
                        $('#notes').text(data.notes || '-');
                        $('#customer_coordinates').text(data.customer_coordinate || '-');
                        $('#odp_name').text(data.odp_name || '-');
                        $('#odp_coordinates').text(data.odp_coordinates || '-');
                        $('#regional_witel_sto').text((data.region_name || '-') + ' / ' + (data.witel || '-') + ' / ' + (data.workzone || '-'));

                        $('#report_phone_number').text(data.report_phone_number || data.contact_phone || '-');
                        $('#report_coordinates_location').text(data.report_coordinates_location || data.customer_coordinate || '-');
                        $('#report_odp_name').text(data.report_odp_name || data.odp_name || '-');
                        $('#report_odp_coordinates').text(data.report_odp_coordinates || data.odp_coordinates || '-');
                        $('#report_valins_id').text(data.report_valins_id || '-');
                        $('#report_refferal_order_code').text(data.report_refferal_order_code || '-');

                        var coordinate = data.report_coordinates_location || data.customer_coordinate;
                        $('#customer_coordinates').text(coordinate || '-');
                        $('#report_coordinates_location').text(data.report_coordinates_location || data.customer_coordinate || '-');

                        if (coordinate) {
                            var coords = coordinate.split(',');
                            if (coords.length === 2) {
                                var lat = parseFloat(coords[0]);
                                var lng = parseFloat(coords[1]);
                                if (!isNaN(lat) && !isNaN(lng)) {
                                    map.setView([lat, lng], 17);
                                    L.marker([lat, lng]).addTo(map)
                                        .bindPopup("<b>Customer Location</b><br>" + coordinate)
                                        .openPopup();
                                }
                            }
                        }

                        var sourcedata = (data.sourcedata || '').toLowerCase();
                        if (sourcedata === 'bima' || sourcedata === 'manuals') {
                            $('.is_sourcecode_hidden').hide();
                            $('.is_sourcecode_hidden .select2').select2('destroy').hide();
                        } else {
                            $('.is_sourcecode_hidden').show();
                            $('.is_sourcecode_hidden .select2').show();
                        }
                    }
                },
                error: function() {
                    console.log('Error loading order details');
                }
            });
        }

        var map = L.map('map').setView([-3.316694, 114.590111], 17);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var customerIcon = L.icon({
            iconUrl: '/assets/images/leaflet-color-markers/marker-icon-blue.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34]
        });

        var odpIcon = L.icon({
            iconUrl: '/assets/images/leaflet-color-markers/marker-icon-red.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34]
        });

        var customerMarker, odpMarker;

        function updateLocation(lat, lng) {
            var coordStr = lat + ',' + lng;
            $('#report_coordinates_location').val(coordStr);
            map.setView([lat, lng], 17);
            if (customerMarker) {
                customerMarker.setLatLng([lat, lng]);
            } else {
                customerMarker = L.marker([lat, lng], {icon: customerIcon, draggable: true}).addTo(map)
                    .bindPopup("<b>Customer Location</b><br>" + coordStr);
                customerMarker.on('dragend', function(e) {
                    var pos = customerMarker.getLatLng();
                    $('#report_coordinates_location').val(pos.lat + ',' + pos.lng);
                });
            }
        }

        function updateOdpLocation(lat, lng) {
            var coordStr = lat + ',' + lng;
            $('#report_odp_coordinates').val(coordStr);
            if (odpMarker) {
                odpMarker.setLatLng([lat, lng]);
            } else {
                odpMarker = L.marker([lat, lng], {icon: odpIcon, draggable: true}).addTo(map)
                    .bindPopup("<b>ODP Location</b><br>" + coordStr);
                odpMarker.on('dragend', function(e) {
                    var pos = odpMarker.getLatLng();
                    $('#report_odp_coordinates').val(pos.lat + ',' + pos.lng);
                });
            }
        }

        $('#btnMarkLocation').on('click', function() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    updateLocation(lat, lng);
                }, function() {
                    alert('Gagal mendapatkan lokasi.');
                }, {enableHighAccuracy:true});
            } else {
                alert('Geolocation tidak tersedia.');
            }
        });

        $('#btnMarkOdpLocation').on('click', function() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    updateOdpLocation(lat, lng);
                }, function() {
                    alert('Gagal mendapatkan lokasi.');
                }, {enableHighAccuracy:true});
            } else {
                alert('Geolocation tidak tersedia.');
            }
        });

        $('#report_coordinates_location').on('input', function() {
            var val = $(this).val();
            var coords = val.split(',');
            if (coords.length === 2) {
                var lat = parseFloat(coords[0]);
                var lng = parseFloat(coords[1]);
                if (!isNaN(lat) && !isNaN(lng)) {
                    if (customerMarker) {
                        customerMarker.setLatLng([lat, lng]);
                    } else {
                        customerMarker = L.marker([lat, lng], {icon: customerIcon, draggable: true}).addTo(map)
                            .bindPopup("<b>Customer Location</b><br>" + val);
                        customerMarker.on('dragend', function(e) {
                            var pos = customerMarker.getLatLng();
                            $('#report_coordinates_location').val(pos.lat + ',' + pos.lng);
                        });
                    }
                }
            }
        });

        $('#report_odp_coordinates').on('input', function() {
            var val = $(this).val();
            var coords = val.split(',');
            if (coords.length === 2) {
                var lat = parseFloat(coords[0]);
                var lng = parseFloat(coords[1]);
                if (!isNaN(lat) && !isNaN(lng)) {
                    if (odpMarker) {
                        odpMarker.setLatLng([lat, lng]);
                    } else {
                        odpMarker = L.marker([lat, lng], {icon: odpIcon, draggable: true}).addTo(map)
                            .bindPopup("<b>ODP Location</b><br>" + val);
                        odpMarker.on('dragend', function(e) {
                            var pos = odpMarker.getLatLng();
                            $('#report_odp_coordinates').val(pos.lat + ',' + pos.lng);
                        });
                    }
                }
            }
        });

        function loadOrderDetails() {
            $.ajax({
                url: '{{ route("ajax.work-order-management.view", $id) }}',
                type: 'GET',
                success: function(data) {
                    if (data) {
                        $('#order_code').text(data.order_code);
                        $('#order_date').text(data.order_date || '-');
                        $('#service_no').text(data.service_no || '-');
                        $('#customer_name').text(data.customer_name || '-');
                        $('#contact_phone').text(data.contact_phone || '-');
                        $('#notes').text(data.notes || '-');
                        $('#customer_coordinates').text(data.customer_coordinate || '-');
                        $('#odp_name').text(data.odp_name || '-');
                        $('#odp_coordinates').text(data.odp_coordinates || '-');
                        $('#regional_witel_sto').text((data.region_name || '-') + ' / ' + (data.witel || '-') + ' / ' + (data.workzone || '-'));

                        $('#report_phone_number').text(data.report_phone_number || data.contact_phone || '-');
                        $('#report_coordinates_location').text(data.report_coordinates_location || data.customer_coordinate || '-');
                        $('#report_odp_name').text(data.report_odp_name || data.odp_name || '-');
                        $('#report_odp_coordinates').text(data.report_odp_coordinates || data.odp_coordinates || '-');
                        $('#report_valins_id').text(data.report_valins_id || '-');
                        $('#report_refferal_order_code').text(data.report_refferal_order_code || '-');

                        var coordinate = data.report_coordinates_location || data.customer_coordinate;
                        $('#report_coordinates_location').val(coordinate || '');
                        if (coordinate) {
                            var coords = coordinate.split(',');
                            if (coords.length === 2) {
                                var lat = parseFloat(coords[0]);
                                var lng = parseFloat(coords[1]);
                                if (!isNaN(lat) && !isNaN(lng)) {
            updateLocation(lat, lng);
        }
    }
}

var odpCoordinate = data.report_odp_coordinates || data.odp_coordinates;
if (odpCoordinate) {
    var coords = odpCoordinate.split(',');
    if (coords.length === 2) {
        var lat = parseFloat(coords[0]);
        var lng = parseFloat(coords[1]);
        if (!isNaN(lat) && !isNaN(lng)) {
            odpMarker = L.marker([lat, lng], {icon: odpIcon, draggable: true}).addTo(map)
                .bindPopup("<b>ODP Location</b><br>" + odpCoordinate);
            odpMarker.on('dragend', function(e) {
                var pos = odpMarker.getLatLng();
                $('#report_odp_coordinates').val(pos.lat + ',' + pos.lng);
            });
        }
    }
}

var sourcedata = (data.sourcedata || '').toLowerCase();
                        if (sourcedata === 'bima' || sourcedata === 'manuals') {
                            $('.is_sourcecode_hidden').hide();
                            $('.is_sourcecode_hidden .select2').hide();
                        } else {
                            $('.is_sourcecode_hidden').show();
                            $('.is_sourcecode_hidden .select2').show();
                        }

                        orderData = data;
                        var id = null;
                        if (sourcedata === 'bima') {
                            id = data.order_substatus_id;
                        } else if (['insera', 'manuals'].includes(sourcedata)) {
                            id = data.order_segment_id;
                        }
                        fetchPhotoList(sourcedata, id);
                    }
                },
                error: function() {
                    console.log('Error loading order details');
                }
            });
        }

        $(document).on('click', '.btn-toggle-card', function() {
            var $icon = $(this).find('i');
            var target = $(this).data('bs-target');
            $(target).on('shown.bs.collapse', function() {
                $icon.removeClass('fa-plus').addClass('fa-minus');
            });
            $(target).on('hidden.bs.collapse', function() {
                $icon.removeClass('fa-minus').addClass('fa-plus');
            });
        });

        $(document).on('click', '.add-photo-btn', function() {
            var type = $(this).data('type');
            $('#input_' + type).click();
        });

        $(document).on('change', '.photo-input', function(e) {
            var type = $(this).data('type');
            var files = e.target.files;
            var preview = $('#preview_' + type);

            Array.from(files).forEach(function(file) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    var thumb = $('<div class="photo-thumb"></div>');
                    thumb.append('<img src="' + ev.target.result + '" alt="photo" class="preview-clickable">');
                    thumb.append('<button type="button" class="photo-delete"><i class="fa fa-trash"></i></button>');
                    preview.append(thumb);
                };
                reader.readAsDataURL(file);
            });

            $(this).val('');
        });

        $(document).on('click', '.photo-delete', function() {
            $(this).closest('.photo-thumb').remove();
        });

        $(document).on('click', '.delete-all-photo-btn', function() {
            var type = $(this).data('type');
            $('#preview_' + type).empty();
        });

        $(document).on('click', '.preview-clickable', function() {
            var src = $(this).attr('src');
            $('#modalPhotoImg').attr('src', src);
            $('#photoPreviewModal').modal('show');
        });
    });
</script>
@endsection
