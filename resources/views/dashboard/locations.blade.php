@extends('layouts.dashboard')

@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid mt-4">

            {{-- Leaflet Map --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Map Lokasi</h4>
                </div>
                <div class="card-body">
                    <div id="locationMap" style="height: 400px;"></div>
                </div>
            </div>

            {{-- Data Tabel --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Lokasi</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLocationModal"
                            id="addLocationBtn">
                            <i class="fas fa-plus"></i> Tambah Lokasi
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="locationsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="locationsTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Tambah Lokasi --}}
            <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Lokasi Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createLocationForm">
                                <div class="mb-3">
                                    <label for="createName" class="form-label">Nama Lokasi</label>
                                    <input type="text" class="form-control" id="createName" name="name">
                                    <small id="createNameError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createDescription" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="createDescription" name="description"></textarea>
                                    <small id="createDescriptionError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createLatitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="createLatitude" name="latitude">
                                    <small id="createLatitudeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createLongitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="createLongitude" name="longitude">
                                    <small id="createLongitudeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
    <label class="form-label">Pilih Titik di Peta</label>
    <div id="createLocationMap" style="height: 300px;"></div>
</div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Edit Lokasi --}}
            <div class="modal fade" id="editLocationModal" tabindex="-1" aria-labelledby="editLocationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Lokasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editLocationForm">
                                <input type="hidden" id="editLocationId" name="location_id" />
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Nama Lokasi</label>
                                    <input type="text" class="form-control" id="editName" name="name">
                                    <small id="editNameError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editDescription" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="editDescription" name="description"></textarea>
                                    <small id="editDescriptionError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editLatitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="editLatitude" name="latitude">
                                    <small id="editLatitudeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editLongitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="editLongitude" name="longitude">
                                    <small id="editLongitudeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
    <label class="form-label">Perbarui Titik di Peta</label>
    <div id="editLocationMap" style="height: 300px;"></div>
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

