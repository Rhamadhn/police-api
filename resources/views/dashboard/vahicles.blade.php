@extends('layouts.dashboard')

@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Kendaraan</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal"
                            id="addVehicleBtn">
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
                        <tbody id="vehiclesTableBody">
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
                            <form id="createVehicleForm">
                                <div class="mb-3">
                                    <label for="createLicensePlate" class="form-label">Plat Nomor</label>
                                    <input type="text" class="form-control" id="createLicensePlate" name="license_plate">
                                    <small id="createLicensePlateError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createType" class="form-label">Tipe</label>
                                    <input type="text" class="form-control" id="createType" name="type">
                                    <small id="createTypeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createBrand" class="form-label">Merk</label>
                                    <input type="text" class="form-control" id="createBrand" name="brand">
                                    <small id="createBrandError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createColor" class="form-label">Warna</label>
                                    <input type="text" class="form-control" id="createColor" name="color">
                                    <small id="createColorError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createIsStolen" class="form-label">Stolen</label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="createIsStolen"
                                                id="createIsStolenYes" value="1">
                                            <label class="form-check-label" for="createIsStolenYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="createIsStolen"
                                                id="createIsStolenNo" value="0" checked>
                                            <label class="form-check-label" for="createIsStolenNo">No</label>
                                        </div>
                                    </div>
                                    <small id="createIsStolenError" class="text-danger"></small>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editVehicleForm">
                                <input type="hidden" id="editVehicleId" name="vehicle_id" />
                                <div class="mb-3">
                                    <label for="editLicensePlate" class="form-label">Plat Nomor</label>
                                    <input type="text" class="form-control" id="editLicensePlate"
                                        name="license_plate" required>
                                    <small id="editLicensePlateError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editType" class="form-label">Tipe</label>
                                    <input type="text" class="form-control" id="editType" name="type" required>
                                    <small id="editTypeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editBrand" class="form-label">Merk</label>
                                    <input type="text" class="form-control" id="editBrand" name="brand" required>
                                    <small id="editBrandError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editColor" class="form-label">Warna</label>
                                    <input type="text" class="form-control" id="editColor" name="color" required>
                                    <small id="editColorError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stolen</label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="editIsStolen"
                                                id="editIsStolenYes" value="1">
                                            <label class="form-check-label" for="editIsStolenYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="editIsStolen"
                                                id="editIsStolenNo" value="0" checked>
                                            <label class="form-check-label" for="editIsStolenNo">No</label>
                                        </div>
                                    </div>
                                    <small id="editIsStolenError" class="text-danger"></small>
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
