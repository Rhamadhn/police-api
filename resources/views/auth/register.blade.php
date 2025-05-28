@extends('layouts.auth')

@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('assets/images/logos/logo.png') }}" alt="Police App Logo"
                                        style="width: 150px; height: auto;">
                                </a>
                                <h5 class="text-center mb-1">Police App</h5>
                                <p class="text-center mb-4">Connecting Citizens with Law Enforcement</p>
                                <form id="registerForm">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required
                                            placeholder="Enter your full name">
                                        <small id="nameError" class="text-danger"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="email" required
                                            placeholder="Enter a valid email">
                                        <small id="emailError" class="text-danger"></small>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required
                                            placeholder="Create a password">
                                        <small id="passwordError" class="text-danger"></small>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-2 fs-4 mb-4 rounded-2">Register</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class=" mb-0">Already have an account?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('login.page') }}">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
