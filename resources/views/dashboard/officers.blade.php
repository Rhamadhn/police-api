@extends('layouts.dashboard')

@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Petugas (Officers)</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOfficerModal"
                            id="addOfficerBtn">
                            <i class="fas fa-plus"></i> Tambah Petugas
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="officersTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Badge</th>
                                <th>Pangkat</th>
                                <th>Area</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="officersTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah Officer -->
            <div class="modal fade" id="addOfficerModal" tabindex="-1" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Petugas Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createOfficerForm">
                                <div class="mb-3">
                                    <label for="createName" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="createName" name="name">
                                    <small id="createNameError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createBadge" class="form-label">Nomor Badge</label>
                                    <input type="text" class="form-control" id="createBadge" name="badge_number">
                                    <small id="createBadgeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createRank" class="form-label">Pangkat</label>
                                    <input type="text" class="form-control" id="createRank" name="rank">
                                    <small id="createRankError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="createArea" class="form-label">Area Penugasan</label>
                                    <input type="text" class="form-control" id="createArea" name="assigned_area">
                                    <small id="createAreaError" class="text-danger"></small>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Officer -->
            <div class="modal fade" id="editOfficerModal" tabindex="-1" aria-labelledby="editOfficerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data Petugas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editOfficerForm">
                                <input type="hidden" id="editOfficerId" name="officer_id" />
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="editName" name="name">
                                    <small id="editNameError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editBadge" class="form-label">Nomor Badge</label>
                                    <input type="text" class="form-control" id="editBadge" name="badge_number">
                                    <small id="editBadgeError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editRank" class="form-label">Pangkat</label>
                                    <input type="text" class="form-control" id="editRank" name="rank">
                                    <small id="editRankError" class="text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editArea" class="form-label">Area Penugasan</label>
                                    <input type="text" class="form-control" id="editArea" name="assigned_area">
                                    <small id="editAreaError" class="text-danger"></small>
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
