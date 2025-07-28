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
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputBrand" class="form-label">Brand</label>
                        <select id="inputBrand" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputModel" class="form-label">Model</label>
                        <select id="inputModel" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($carModels as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputDate" class="form-label">Model Year</label>
                        <input type="number" class="form-control" id="inputDate" placeholder="year">
                    </div>

                    <div class="col-md-4">
                        <label for="inputLicenseDate" class="form-label">License Expiry Date</label>
                        <input type="date" class="form-control" id="inputLicenseDate">
                    </div>

                    <div class="col-md-4">
                        <label for="inputBodyStyle" class="form-label">Body Style</label>
                        <select id="inputBodyStyle" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($bodyStyles as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputType" class="form-label">Type</label>
                        <select id="inputType" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="minRange" class="form-label">Min Fuel Economy</label>
                        <input type="number" class="form-control" id="minRange" placeholder="Min Fuel Economy">
                    </div>

                    <div class="col-md-4">
                        <label for="maxRange" class="form-label">Max Fuel Economy</label>
                        <input type="number" class="form-control" id="maxRange" placeholder="Max Fuel Economy">
                    </div>

                    <div class="col-md-4">
                        <label for="inputTransmission" class="form-label">Transmission Type</label>
                        <select id="inputTransmission" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($transmissionTypes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputDrive" class="form-label">Drive Type</label>
                        <select id="inputDrive" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($driveTypes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEngineType" class="form-label">Engine Type</label>
                        <select id="inputEngineType" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($engineTypes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEngineCapacity" class="form-label">Engine Capacity (cc)</label>
                        <input type="number" class="form-control" id="inputEngineCapacity">
                    </div>

                    <div class="col-md-4">
                        <label for="inputColor" class="form-label">Color</label>
                        <input type="text" class="form-control" id="exampleColorInput" title="Choose your color">
                    </div>

                    <div class="col-md-4">
                        <label for="inputLength" class="form-label">Length</label>
                        <input type="number" class="form-control" id="inputLength">
                    </div>

                    <div class="col-md-4">
                        <label for="inputWidth" class="form-label">Width</label>
                        <input type="number" class="form-control" id="inputWidth">
                    </div>

                    <div class="col-md-4">
                        <label for="inputHeight" class="form-label">Height</label>
                        <input type="number" class="form-control" id="inputHeight">
                    </div>

                    <div class="col-md-4">
                        <label for="inputMileage" class="form-label">Mileage</label>
                        <input type="number" class="form-control" id="inputMileage">
                    </div>

                    <div class="col-md-4">
                        <label for="minRange" class="form-label">Min Horse Power</label>
                        <input type="number" class="form-control" id="minRangePower" placeholder="Min Horse Power">
                    </div>

                    <div class="col-md-4">
                        <label for="maxRange" class="form-label">Max Horse Power</label>
                        <input type="number" class="form-control" id="maxRangePower" placeholder="Max Horse Power">
                    </div>

                    <div class="col-md-4">
                        <label for="inputStatus" class="form-label">Vehicle Status</label>
                        <select id="inputStatus" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($vehicleStatuses as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputRefurbishment" class="form-label">Refurbishment Status</label>
                        <select id="inputRefurbishment" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($refurbishmentStatuses as $item)
                                <option value="{{ $item->value }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="inputPrice">
                    </div>

                    <div class="col-md-4">
                        <label for="inputDiscount" class="form-label">Discount</label>
                        <input type="number" class="form-control" id="inputDiscount">
                    </div>

                    <div class="col-md-4">
                        <label for="inputInstallment" class="form-label">Monthly Installment</label>
                        <input type="number" class="form-control" id="inputInstallment">
                    </div>

                    <div class="col-md-4">
                        <label for="inputTrim" class="form-label">Trim</label>
                        <select id="inputTrim" class="form-select">
                            <option selected>Choose...</option>
                            @foreach ($trim as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="formFile" class="form-label">Images Upload</label>
                        <input class="form-control" type="file" id="formFile" multiple>
                    </div>

                    <div class="col-12">
                        <label for="inputFlags" class="form-label">Flags</label>
                        <div id="flagContainer">
                            <div class="flagInput">
                                <input type="text" class="form-control" id="inputFlags">
                            </div>
                        </div>
                        <button type="button" class="btn btn-link" onclick="addFlagInput()">
                            <i class="bi bi-plus-circle"></i> Add Flag
                        </button>
                    </div>

                    <div class="col-12">
                        <div id="featureBlockContainer">
                            <!-- First Block of Fields -->
                            <div class="feature-block mb-3">
                                <div class="col-md-4">
                                    <label for="inputFeatures" class="form-label">Features</label>
                                    <select class="form-select" name="inputFeatures[]">
                                        <option selected>Choose...</option>
                                        @foreach ($features as $item)
                                            <option value="{{ $item->value }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="inputLabel" class="form-label">Label</label>
                                    <input type="text" class="form-control" name="inputLabel[]">
                                </div>

                                <div class="col-md-4">
                                    <label for="inputValue" class="form-label">Value</label>
                                    <input type="text" class="form-control" name="inputValue[]">
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-link" onclick="addFeatureBlock()">
                            <i class="bi bi-plus-circle"></i> Add More
                        </button>
                    </div>

                    <div class="col-12">
                        <div id="conditionBlockContainer">
                            <!-- First Block of Fields -->
                            <div class="condition-block mb-3">
                                <div class="col-md-4">
                                    <label for="inputConditions" class="form-label">Conditions</label>
                                    <select class="form-select" name="inputConditions[]">
                                        <option selected>Choose...</option>
                                        @foreach ($conditions as $item)
                                            <option value="{{ $item->value }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="inputPart" class="form-label">Part</label>
                                    <input type="text" class="form-control" name="inputPart[]">
                                </div>

                                <div class="col-md-4">
                                    <label for="inputDescription" class="form-label">Description</label>
                                    <textarea class="form-control" name="inputDescription[]" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-link" onclick="addConditionBlock()">
                            <i class="bi bi-plus-circle"></i> Add More
                        </button>
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
