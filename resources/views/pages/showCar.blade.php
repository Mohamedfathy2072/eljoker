@extends('layouts.app')

@section('title', 'View Car')

@section('content')
    <div class="pagetitle">
        <h1>Welcome to admin dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">View Car</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Car Details: {{ $car['full_name'] }}</h5>

                    <div class="accordion" id="accordionCarDetails">

                        <!-- Vehicle Identification -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingIdent">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseIdent" aria-expanded="true">
                                    Basic Info
                                </button>
                            </h2>
                            <div id="collapseIdent" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionCarDetails">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-4"><strong>Car Name:</strong> {{ $car['name'] ?? 'N/A' }}</div>

                                        <div class="col-md-4"><strong>Brand:</strong> {{ $car['brand']['name'] ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-4"><strong>Model:</strong> {{ $car['model']['name'] ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-4"><strong>Year:</strong> {{ $car['model_year'] }}</div>
                                        <div class="col-md-4"><strong>License Valid Until:</strong>
                                            {{ $car['license_valid_until'] }}</div>
                                        <div class="col-md-4"><strong>Color:</strong> {{ $car['appearance']['color'] }}
                                        </div>
                                        <div class="col-md-4"><strong>Size:</strong>
                                            {{ $car['appearance']['size']['formate'] ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Specs and Performance -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSpecs">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSpecs">
                                    Specifications
                                </button>
                            </h2>
                            <div id="collapseSpecs" class="accordion-collapse collapse"
                                data-bs-parent="#accordionCarDetails">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-4"><strong>Body Style:</strong>
                                            {{ $car['specifications']['body_style']['name'] ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Type:</strong>
                                            {{ $car['specifications']['type']['name'] ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Transmission:</strong>
                                            {{ $car['specifications']['transmission_type']['name'] ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Drive Type:</strong>
                                            {{ $car['specifications']['drive_type']['name'] ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Engine:</strong>
                                            {{ $car['performance']['engine_type']['name'] ?? 'N/A' }}
                                            ({{ $car['performance']['engine_capacity_cc'] }}cc)</div>
                                        <div class="col-md-4"><strong>Fuel Economy:</strong>
                                            {{ $car['performance']['fuel_economy']['formate'] ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Horsepower:</strong>
                                            {{ $car['performance']['horsepower']['formate'] ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Mileage:</strong>
                                            {{ $car['performance']['mileage']['formate'] ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Status:</strong>
                                            {{ $car['performance']['vehicle_status']['name'] ?? 'N/A' }}</div>
                                            <div class="col-md-4"><strong>Refurbishment:</strong>
                                                {{ $car['performance']['refurbishment_status_en'] ?? 'N/A' }}</div>
                                                <div class="col-md-4"><strong>Refurbishment:</strong>
                                                    {{ $car['performance']['refurbishment_status_ar'] ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Trim -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTrim">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTrim">
                                    Trim and Metadata
                                </button>
                            </h2>
                            <div id="collapseTrim" class="accordion-collapse collapse"
                                data-bs-parent="#accordionCarDetails">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-4"><strong>Trim:</strong> {{ $car['trim']['name'] ?? '-' }}
                                        </div>
                                        <div class="col-md-4"><strong>Created:</strong> {{ $car['created_at_human'] }}
                                        </div>
                                        <div class="col-md-4"><strong>Updated:</strong> {{ $car['updated_at_human'] }}
                                        </div>
                                        <div class="col-md-4"><strong>Owner:</strong> {{ $car['owner'] }}</div>
                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div class="col-md-12">
                                            <strong>Notes:</strong> {{ $car['notes'] ?? 'No notes provided' }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingImages">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseImages">
                                    Images
                                </button>
                            </h2>
                            <div id="collapseImages" class="accordion-collapse collapse"
                                data-bs-parent="#accordionCarDetails">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        @foreach ($car['images'] as $img)
                                            <div class="col-md-3">
                                                <img src="{{ asset('storage/' . $img['location']) }}" class="img-fluid"
                                                    alt="Car Image">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
