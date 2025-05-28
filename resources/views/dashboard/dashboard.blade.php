@extends('layouts.dashboard')

@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="card w-100 shadow-sm border-0">
                        <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 400px;">
                            <img src="{{ asset('assets/images/backgrounds/police.jpeg') }}" alt="Police Image"
                                class="img-fluid rounded" style="max-height: 400px;">
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Yearly Breakup -->
                            <div class="card overflow-hidden shadow-sm border-0">
                                <div class="card-body p-5">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-3">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 48px; height: 48px;">
                                                <i class="ti ti-eye fs-4"></i>
                                            </div>
                                        </div>
                                        <h4 class="fw-bold mb-0">Vision</h4>
                                    </div>
                                    <p class="lead text-muted">
                                        To build a safer, more transparent society by fostering seamless communication and
                                        trust between
                                        citizens and law enforcement.
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <!-- Monthly Earnings -->
                            <div class="card overflow-hidden shadow-sm border-0">
                                <div class="card-body p-5">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-3">
                                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 48px; height: 48px;">
                                                <i class="ti ti-target fs-4"></i>
                                            </div>
                                        </div>
                                        <h4 class="fw-bold mb-0">Mission</h4>
                                    </div>
                                    <p class="lead text-muted">
                                        To empower citizens and law enforcement through a seamless digital platform that
                                        enables real-time reporting,
                                        efficient communication, and community collaboration—promoting safety, transparency,
                                        and trust across all levels
                                        of society.
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @include('components.footer')
    </div>

    </div>
@endsection
