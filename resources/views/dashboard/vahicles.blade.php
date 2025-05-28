@extends('layouts.dashboard')

@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Kendaraan</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                            <i class="fas fa-plus"></i> Tambah Kendaraan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="vehiclesTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Plat Nomor</th>
                                <th>Tipe</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Stolen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="VehicleTableBody">

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah Kendaraan -->
            <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addVehicleModalLabel">Tambah Kendaraan Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="vehicleForm"> <!-- Ganti ID form menjadi vehicleForm -->

                                <div class="mb-3">
                                    <label for="license_plate" class="form-label">Plat Nomor</label>
                                    <input type="text" class="form-control" id="license_plate" name="license_plate">
                                    <small id="license_plateError" class="text-danger"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe</label>
                                    <input type="text" class="form-control" id="type" name="type">
                                    <small id="typeError" class="text-danger"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="brand" class="form-label">Merk</label>
                                    <input type="text" class="form-control" id="brand" name="brand">
                                    <small id="brandError" class="text-danger"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="color" class="form-label">Warna</label>
                                    <input type="text" class="form-control" id="color" name="color">
                                    <small id="colorError" class="text-danger"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="is_stolen" class="form-label">Stolen</label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="is_stolen"
                                                id="is_stolen_yes" value="1">
                                            <label class="form-check-label" for="is_stolen_yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_stolen"
                                                id="is_stolen_no" value="0" checked>
                                            <label class="form-check-label" for="is_stolen_no">No</label>
                                        </div>
                                    </div>
                                    <small id="is_stolenError" class="text-danger"></small>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Kendaraan -->
            <div class="modal fade" id="editVehicleModal" tabindex="-1" aria-labelledby="editVehicleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kendaraan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editVehicleForm">
                                <input type="hidden" id="vehicle_id" name="vehicle_id" />
                                <div class="mb-3">
                                    <label for="license_plate" class="form-label">Plat Nomor</label>
                                    <input type="text" class="form-control" id="license_plate" name="license_plate"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe</label>
                                    <input type="text" class="form-control" id="type" name="type" required>
                                </div>
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Merk</label>
                                    <input type="text" class="form-control" id="brand" name="brand" required>
                                </div>
                                <div class="mb-3">
                                    <label for="color" class="form-label">Warna</label>
                                    <input type="text" class="form-control" id="color" name="color" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stolen</label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="is_stolen"
                                                id="is_stolen_yes" value="1">
                                            <label class="form-check-label" for="is_stolen_yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_stolen"
                                                id="is_stolen_no" value="0" checked>
                                            <label class="form-check-label" for="is_stolen_no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            @include('components.footer')
        </div>
    </div>
@endsection
