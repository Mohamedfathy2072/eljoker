@extends('layouts.app')

@section('title', 'Trim')

@section('content')
<div class="pagetitle">
  <h1>Welcome to admin dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Trim</li>
    </ol>
  </nav>
</div>

    <section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New Car</h5>

                <!-- Multi Columns Form -->
                <form class="row g-3" action="{{ route('admin.car.store') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <!-- Accordion Start -->
                    <div class="accordion" id="accordionExample">
                        <!-- Vehicle Information Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Part 1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <!-- Brand -->
                                        <div class="col-md-4">
                                            <label for="inputBrand" class="form-label">Brand</label>
                                            <select class="form-select" id="inputBrand" name="brand">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Model -->
                                        <div class="col-md-4">
                                            <label for="inputModel" class="form-label">Model</label>
                                            <select class="form-select" id="inputModel" name="model">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($carModels as $model)
                                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Model Year -->
                                        <div class="col-md-4">
                                            <label for="inputDate" class="form-label">Model Year</label>
                                            <input type="number" class="form-control" id="inputDate" name="model_year" placeholder="year">
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- License Expiry Date -->
                                        <div class="col-md-4">
                                            <label for="inputLicenseDate" class="form-label">License Expiry Date</label>
                                            <input type="date" class="form-control" id="inputLicenseDate" name="license_expiry_date">
                                        </div>

                                        <!-- Body Style -->
                                        <div class="col-md-4">
                                            <label for="inputBodyStyle" class="form-label">Body Style</label>
                                            <select class="form-select" id="inputBodyStyle" name="body_style">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($bodyStyles as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Type -->
                                        <div class="col-md-4">
                                            <label for="inputType" class="form-label">Type</label>
                                            <select class="form-select" id="inputType" name="type">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Min Fuel Economy -->
                                        <div class="col-md-4">
                                            <label for="minRange" class="form-label">Min Fuel Economy</label>
                                            <input type="number" class="form-control" id="minRange" name="min_fuel_economy" placeholder="Min Fuel Economy">
                                        </div>

                                        <!-- Max Fuel Economy -->
                                        <div class="col-md-4">
                                            <label for="maxRange" class="form-label">Max Fuel Economy</label>
                                            <input type="number" class="form-control" id="maxRange" name="max_fuel_economy" placeholder="Max Fuel Economy">
                                        </div>

                                        <!-- Color -->
                                        <div class="col-md-4">
                                            <label for="inputColor" class="form-label">Color</label>
                                            <input type="text" class="form-control" id="exampleColorInput" name="color" title="Choose your color">
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Length -->
                                        <div class="col-md-4">
                                            <label for="inputLength" class="form-label">Length</label>
                                            <input type="number" class="form-control" id="inputLength" name="length">
                                        </div>

                                        <!-- Width -->
                                        <div class="col-md-4">
                                            <label for="inputWidth" class="form-label">Width</label>
                                            <input type="number" class="form-control" id="inputWidth" name="width">
                                        </div>

                                        <!-- Height -->
                                        <div class="col-md-4">
                                            <label for="inputHeight" class="form-label">Height</label>
                                            <input type="number" class="form-control" id="inputHeight" name="height">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Engine Type Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEngineType">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEngineType" aria-expanded="false" aria-controls="collapseEngineType">
                                    Part 2
                                </button>
                            </h2>
                            <div id="collapseEngineType" class="accordion-collapse collapse" aria-labelledby="headingEngineType" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <!-- Engine Type -->
                                        <div class="col-md-4">
                                            <label for="inputEngineType" class="form-label">Engine Type</label>
                                            <select class="form-select" id="inputEngineType" name="engine_type">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($engineTypes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Mileage -->
                                        <div class="col-md-4">
                                            <label for="inputMileage" class="form-label">Mileage</label>
                                            <input type="number" class="form-control" id="inputMileage" name="mileage">
                                        </div>

                                        <!-- Vehicle Status -->
                                        <div class="col-md-4">
                                            <label for="inputStatus" class="form-label">Vehicle Status</label>
                                            <select class="form-select" id="inputStatus" name="vehicle_status">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($vehicleStatuses as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Refurbishment Status -->
                                        <div class="col-md-4">
                                            <label for="inputRefurbishment" class="form-label">Refurbishment Status</label>
                                            <select class="form-select" id="inputRefurbishment" name="refurbishment_status">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($refurbishmentStatuses as $item)
                                                    <option value="{{ $item->value }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Transmission Type -->
                                        <div class="col-md-4">
                                            <label for="inputTransmission" class="form-label">Transmission Type</label>
                                            <select class="form-select" id="inputTransmission" name="transmission_type">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($transmissionTypes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Drive Type -->
                                        <div class="col-md-4">
                                            <label for="inputDrive" class="form-label">Drive Type</label>
                                            <select class="form-select" id="inputDrive" name="drive_type">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($driveTypes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Engine Capacity -->
                                        <div class="col-md-4">
                                            <label for="inputEngineCapacity" class="form-label">Engine Capacity (cc)</label>
                                            <input type="number" class="form-control" id="inputEngineCapacity" name="engine_capacity">
                                        </div>

                                        <!-- Min Horse Power -->
                                        <div class="col-md-4">
                                            <label for="minRangePower" class="form-label">Min Horse Power</label>
                                            <input type="number" class="form-control" id="minRangePower" name="min_horse_power" placeholder="Min Horse Power">
                                        </div>

                                        <!-- Max Horse Power -->
                                        <div class="col-md-4">
                                            <label for="maxRangePower" class="form-label">Max Horse Power</label>
                                            <input type="number" class="form-control" id="maxRangePower" name="max_horse_power" placeholder="Max Horse Power">
                                        </div>

                                        <!-- Price -->
                                        <div class="col-md-4">
                                            <label for="inputPrice" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="inputPrice" name="price">
                                        </div>

                                        <!-- Discount -->
                                        <div class="col-md-4">
                                            <label for="inputDiscount" class="form-label">Discount</label>
                                            <input type="number" class="form-control" id="inputDiscount" name="discount">
                                        </div>

                                        <!-- Monthly Installment -->
                                        <div class="col-md-4">
                                            <label for="inputInstallment" class="form-label">Monthly Installment</label>
                                            <input type="number" class="form-control" id="inputInstallment" name="monthly_installment">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trim Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTrim">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTrim" aria-expanded="false" aria-controls="collapseTrim">
                                    Part 3
                                </button>
                            </h2>
                            <div id="collapseTrim" class="accordion-collapse collapse" aria-labelledby="headingTrim" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <!-- Trim -->
                                        <div class="col-md-4">
                                            <label for="inputTrim" class="form-label">Trim</label>
                                            <select id="inputTrim" class="form-select" name="trim">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($trim as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Images Upload -->
                                        <div class="col-md-4">
                                            <label for="formFile" class="form-label">Images Upload</label>
                                            <input class="form-control" type="file" id="formFile" name="images[]" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Flags and Features Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Part 4
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <!-- Flags Section -->
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputFlags" class="form-label">Flags</label>
                                            <div id="flagContainer">
                                                <div class="flagInput">
                                                    <input type="text" class="form-control" id="inputFlags" name="flags[]">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-link" onclick="addFlagInput()">
                                                <i class="bi bi-plus-circle"></i> Add Flag
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Features Section -->
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div id="featureBlockContainer">
                                                <!-- First Block of Fields -->
                                                <div class="feature-block mb-3">
                                                    <!-- Features Dropdown -->
                                                    <div class="col-12">
                                                        <label for="inputFeatures" class="form-label">Features</label>
                                                        <select class="form-select" name="inputFeatures[]">
                                                            <option value="" selected>Choose...</option>
                                                            @foreach ($features as $item)
                                                                <option value="{{ $item->value }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Label Input -->
                                                    <div class="col-12">
                                                        <label for="inputLabel" class="form-label">Label</label>
                                                        <input type="text" class="form-control" name="inputLabel[]">
                                                    </div>

                                                    <!-- Value Input -->
                                                    <div class="col-12">
                                                        <label for="inputValue" class="form-label">Value</label>
                                                        <input type="text" class="form-control" name="inputValue[]">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Add More Button -->
                                            <button type="button" class="btn btn-link" onclick="addFeatureBlock()">
                                                <i class="bi bi-plus-circle"></i> Add More
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Conditions Section -->
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div id="conditionBlockContainer">
                                                <!-- First Block of Fields -->
                                                <div class="condition-block mb-3">
                                                    <div class="col-12">
                                                        <label for="inputConditions" class="form-label">Conditions</label>
                                                        <select class="form-select" name="inputConditions[]">
                                                            <option value="" selected>Choose...</option>
                                                            @foreach ($conditions as $item)
                                                                <option value="{{ $item->value }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="inputPart" class="form-label">Part</label>
                                                        <input type="text" class="form-control" name="inputPart[]">
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="inputDescription" class="form-label">Description</label>
                                                        <textarea class="form-control" name="inputDescription[]" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-link" onclick="addConditionBlock()">
                                                <i class="bi bi-plus-circle"></i> Add More
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection
