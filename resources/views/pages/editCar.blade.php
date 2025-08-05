@extends('layouts.app')

@section('title', 'Trim')

@section('content')
<div class="pagetitle">
  <h1>Welcome to admin dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Edit Car</li>
    </ol>
  </nav>
</div>

    <section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Car</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>There were some problems with your input:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>There were some problems try again later or call support:</strong>
                        <ul class="mb-0 mt-2">
                            <li>{{ session('error') }}</li>
                        </ul>
                    </div>
                @endif
                <!-- Multi Columns Form -->
                <form class="row g-3" action="{{ route('admin.car.update', $car['id']) }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
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
                                                    <option value="{{ $brand['id'] }}" {{ old('brand', $car['brand']['id']) == $brand['id'] ? 'selected' : '' }}>
                                                        {{ $brand['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Model -->
                                        <div class="col-md-4">
                                            <label for="inputModel" class="form-label">Model</label>
                                            <select class="form-select" id="inputModel" name="model">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($carModels as $model)
                                                    <option value="{{ $model['id'] }}" {{ old('model', $car['model']['id']) == $model['id'] ? 'selected' : '' }}>{{ $model['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Model Year -->
                                        <div class="col-md-4">
                                            <label for="inputDate" class="form-label">Model Year</label>
                                            <input type="number" class="form-control" id="inputDate" name="model_year" value="{{ old('model_year', $car['model_year']) }}" placeholder="year">
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- License Expiry Date -->
                                        <div class="col-md-4">
                                            <label for="inputLicenseDate" class="form-label">License Expiry Date</label>
                                            <input type="date" class="form-control" id="inputLicenseDate" name="license_expire_date" value="{{ old('license_valid_until', $car['license_valid_until']) }}">
                                        </div>

                                        <!-- Body Style -->
                                        <div class="col-md-4">
                                            <label for="inputBodyStyle" class="form-label">Body Style</label>
                                            <select class="form-select" id="inputBodyStyle" name="body_style">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($bodyStyles as $item)
                                                    <option value="{{ $item['id'] }}" {{ old('model', $car['specifications']['body_style']['id']) == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Type -->
                                        <div class="col-md-4">
                                            <label for="inputType" class="form-label">Type</label>
                                            <select class="form-select" id="inputType" name="type">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($types as $item)
                                                    <option value="{{ $item['id'] }}" {{ old('specifications', $car['specifications']['type']['id']) == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        @if (!empty($car['performance']['fuel_economy']))
                                            <input type="hidden" name="fuel_economy_id" value="{{ $car['performance']['fuel_economy']['id'] }}">
                                        @endif
                                        <!-- Min Fuel Economy -->
                                        <div class="col-md-4">
                                            <label for="minRange" class="form-label">Min Fuel Economy</label>
                                            <input type="number" class="form-control" id="minRange" name="min_fuel_economy" placeholder="Min Fuel Economy" value="{{ old('performance', $car['performance']['fuel_economy']['min']) }}">
                                        </div>

                                        <!-- Max Fuel Economy -->
                                        <div class="col-md-4">
                                            <label for="maxRange" class="form-label">Max Fuel Economy</label>
                                            <input type="number" class="form-control" id="maxRange" name="max_fuel_economy" placeholder="Max Fuel Economy" value="{{ old('performance', $car['performance']['fuel_economy']['max']) }}">
                                        </div>

                                        <!-- Color -->
                                        <div class="col-md-4">
                                            <label for="inputColor" class="form-label">Color</label>
                                            <input type="text" class="form-control" id="exampleColorInput" name="color" title="Choose your color" value="{{ old('appearance', $car['appearance']['color']) }}">
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        @if (!empty($car['appearance']['size']))
                                            <input type="hidden" name="size_id" value="{{ $car['appearance']['size']['id'] }}">
                                        @endif
                                        <!-- Length -->
                                        <div class="col-md-4">
                                            <label for="inputLength" class="form-label">Length</label>
                                            <input type="number" class="form-control" id="inputLength" name="length" value="{{ old('appearance', $car['appearance']['size']['length']) }}">
                                        </div>

                                        <!-- Width -->
                                        <div class="col-md-4">
                                            <label for="inputWidth" class="form-label">Width</label>
                                            <input type="number" class="form-control" id="inputWidth" name="width" value="{{ old('appearance', $car['appearance']['size']['width']) }}">
                                        </div>

                                        <!-- Height -->
                                        <div class="col-md-4">
                                            <label for="inputHeight" class="form-label">Height</label>
                                            <input type="number" class="form-control" id="inputHeight" name="height" value="{{ old('appearance', $car['appearance']['size']['height']) }}">
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
                                                    <option value="{{ $item['id'] }}"  {{ old('performance', $car['performance']['engine_type']['id']) == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Mileage -->
                                        <div class="col-md-4">
                                            <label for="inputMileage" class="form-label">Mileage</label>
                                            <input type="number" class="form-control" id="inputMileage" name="mileage"
                                                   value="{{ old('mileage', $car['performance']['mileage']['value'] ?? '') }}">
                                        </div>

                                        <!-- Vehicle Status -->
                                        <div class="col-md-4">
                                            <label for="inputStatus" class="form-label">Vehicle Status</label>
                                            <select class="form-select" id="inputStatus" name="vehicle_status">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($vehicleStatuses as $item)
                                                    <option value="{{ $item['id'] }}"   {{ old('performance', $car['performance']['vehicle_status']['id']) == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
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
                                                    <option value="{{ $item->value }}"   {{ old('performance', $car['performance']['refurbishment_status']->value) == $item->value ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Transmission Type -->
                                        <div class="col-md-4">
                                            <label for="inputTransmission" class="form-label">Transmission Type</label>
                                            <select class="form-select" id="inputTransmission" name="transmission_type">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($transmissionTypes as $item)
                                                    <option value="{{ $item['id'] }}"   {{ old('specifications', $car['specifications']['transmission_type']['id']) == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Drive Type -->
                                        <div class="col-md-4">
                                            <label for="inputDrive" class="form-label">Drive Type</label>
                                            <select class="form-select" id="inputDrive" name="drive_type">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($driveTypes as $item)
                                                    <option value="{{ $item['id'] }}"   {{ old('specifications', $car['specifications']['drive_type']['id']) == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Engine Capacity -->
                                        <div class="col-md-4">
                                            <label for="inputEngineCapacity" class="form-label">Engine Capacity (cc)</label>
                                            <input type="number" class="form-control" id="inputEngineCapacity" name="engine_capacity"
                                                   value="{{ old('engine_capacity', $car['performance']['engine_capacity_cc'] ?? '') }}">
                                        </div>

                                        @if (!empty($car['performance']['horsepower']))
                                            <input type="hidden" name="horsepower_id" value="{{ $car['performance']['horsepower']['id'] }}">
                                        @endif
                                        <!-- Min Horse Power -->
                                        <div class="col-md-4">
                                            <label for="minRangePower" class="form-label">Min Horse Power</label>
                                            <input type="number" class="form-control" id="minRangePower" name="min_horse_power" placeholder="Min Horse Power" value="{{ old('performance', $car['performance']['horsepower']['min']) }}">
                                        </div>

                                        <!-- Max Horse Power -->
                                        <div class="col-md-4">
                                            <label for="maxRangePower" class="form-label">Max Horse Power</label>
                                            <input type="number" class="form-control" id="maxRangePower" name="max_horse_power" placeholder="Max Horse Power" value="{{ old('performance', $car['performance']['horsepower']['max']) }}">
                                        </div>

                                        <!-- Price -->
                                        <div class="col-md-4">
                                            <label for="inputPrice" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="inputPrice" name="price" value="{{ old('pricing', $car['pricing']['original_price']) }}">
                                        </div>

                                        <!-- Discount -->
                                        <div class="col-md-4">
                                            <label for="inputDiscount" class="form-label">Discount</label>
                                            <input type="number" class="form-control" id="inputDiscount" name="discount" value="{{ old('pricing', $car['pricing']['discount']) }}">
                                        </div>

                                        <!-- Monthly Installment -->
                                        <div class="col-md-4">
                                            <label for="inputInstallment" class="form-label">Monthly Installment</label>
                                            <input type="number" class="form-control" id="inputInstallment" name="monthly_installment" value="{{ old('pricing', $car['pricing']['monthly_installment']) }}">
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
                                                    <option value="{{ $item['id'] }}" {{ old('specifications', $car['trim']['id']) == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Images Upload -->
                                        <div class="col-md-4">
                                            <label for="formFile" class="form-label">Images Upload</label>
                                            <input class="form-control" type="file" id="formFile" name="images[]" multiple>
                                        </div>
                                        <!-- Current Images Preview -->
                                        <div class="col-12 mt-3">
                                            <label class="form-label">Current Images</label>
                                            <div class="row">
                                                @foreach ($car['images'] as $index => $image)
                                                    <div class="col-md-3 text-center mb-3">
                                                        <img src="{{ asset('storage/' . $image['location']) }}" class="img-thumbnail mb-2" style="max-height: 150px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image['id'] }}" id="deleteImage{{ $index }}">
                                                            <label class="form-check-label" for="deleteImage{{ $index }}">Delete</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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
                                            <label class="form-label">Flags</label>
                                            <div id="flagContainer">
                                                @foreach ($car['flags'] as $index => $flag)
                                                    <div class="flagInput row g-2 align-items-center mt-2">
                                                        <!-- Flag Name -->
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="flags[{{ $index }}][name]" value="{{ $flag['value'] }}" placeholder="Flag Name">
                                                            @if (!empty($flag['id']))
                                                                <input type="hidden" name="flags[{{ $index }}][id]" value="{{ $flag['id'] }}">
                                                            @endif
                                                        </div>

                                                        <!-- Image Upload -->
                                                        <div class="col-md-5">
                                                            <input type="file" class="form-control" name="flags[{{ $index }}][image]" accept="image/*" onchange="previewImage(this)">
                                                            @if (!empty($flag['image']))
                                                                <img class="img-preview mt-2" src="{{ asset('storage/' . $flag['image']) }}" style="max-height: 80px;" />
                                                            @else
                                                                <img class="img-preview mt-2" style="display:none; max-height: 80px;" />
                                                            @endif
                                                        </div>

                                                        <!-- Remove Button -->
                                                        <div class="col-md-2 d-flex align-items-center">
                                                            <button type="button" class="btn btn-link text-danger p-0 ms-2" title="Remove" onclick="this.closest('.flagInput').remove()">
                                                                <i class="bi bi-x-circle" style="font-size: 1.5rem;"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Add More Button -->
                                            <button type="button" class="btn btn-link mt-3" onclick="addFlagInput()">
                                                <i class="bi bi-plus-circle"></i> Add Flag
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Features --}}
                                    @php $featureIndex = 0; @endphp
                                    <div id="featureBlockContainer">
                                        @foreach ($car['features'] as $type => $featuresList)
                                            @foreach ($featuresList as $item)
                                                <div class="feature-block row g-3 mb-3 align-items-end">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Feature</label>
                                                        <select class="form-select" name="features[{{ $type }}][{{ $featureIndex }}][name]">
                                                            <option value="" disabled>Choose...</option>
                                                            @foreach ($features as $featureOption)
                                                                <option value="{{ $featureOption->value }}" {{ $featureOption->value === $type ? 'selected' : '' }}>
                                                                    {{ $featureOption->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if (!empty($item['id']))
                                                            <input type="hidden" name="features[{{ $type }}][{{ $featureIndex }}][id]" value="{{ $item['id'] }}">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Label</label>
                                                        <input type="text" class="form-control" name="features[{{ $type }}][{{ $featureIndex }}][label]" value="{{ $item['label'] }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Value</label>
                                                        <input type="text" class="form-control" name="features[{{ $type }}][{{ $featureIndex }}][value]" value="{{ $item['value'] }}">
                                                    </div>
                                                    <div class="col-md-1 text-end">
                                                        <button type="button" class="btn btn-link text-danger p-0" onclick="this.closest('.feature-block').remove()">
                                                            <i class="bi bi-x-circle" style="font-size: 1.4rem;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @php $featureIndex++; @endphp
                                            @endforeach
                                        @endforeach
                                    </div>

                                    <button type="button" class="btn btn-link mt-2" onclick="addFeatureBlock()">
                                        <i class="bi bi-plus-circle"></i> Add More
                                    </button>

                                    {{-- Conditions --}}
                                    <div class="row g-3 mt-4">
                                        <div class="col-12">
                                            <label class="form-label">Conditions</label>

                                            <!-- Existing Conditions -->
                                                @php $conditionIndex = 0; @endphp
                                                <div id="conditionBlockContainer">
                                                    @foreach ($car['conditions'] as $type => $items)
                                                        @foreach ($items as $item)
                                                            <div class="condition-block row g-3 mb-3 align-items-end">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Condition Type</label>
                                                                    <select class="form-select" disabled>
                                                                        @foreach ($conditions as $option)
                                                                            <option value="{{ $option->value }}" {{ $type === $option->value ? 'selected' : '' }}>
                                                                                {{ $option->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="hidden" name="conditions[{{ $type }}][{{ $conditionIndex }}][name]" value="{{ $type }}">
                                                                    @if (!empty($item['id']))
                                                                        <input type="hidden" name="conditions[{{ $type }}][{{ $conditionIndex }}][id]" value="{{ $item['id'] }}">
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="form-label">Part</label>
                                                                    <input type="text" class="form-control" name="conditions[{{ $type }}][{{ $conditionIndex }}][part]" value="{{ $item['part'] }}">
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <label class="form-label">Description</label>
                                                                    <textarea class="form-control" name="conditions[{{ $type }}][{{ $conditionIndex }}][description]" rows="1">{{ $item['description'] }}</textarea>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="form-label">Image</label>
                                                                    <input type="file" class="form-control" name="conditions[{{ $type }}][{{ $conditionIndex }}][image]" accept="image/*">
                                                                    @if (!empty($item['image']))
                                                                        <img src="{{ asset('storage/' . $item['image']) }}" class="img-preview mt-2" style="max-height: 80px;">
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-1 text-end">
                                                                    <button type="button" class="btn btn-link text-danger p-0" onclick="this.closest('.condition-block').remove()">
                                                                        <i class="bi bi-x-circle" style="font-size: 1.5rem;" title="Delete Condition"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @php $conditionIndex++; @endphp
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Add More Button -->
                                            <button type="button" class="btn btn-link mt-2" onclick="addConditionBlock()">
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

<script>
    function previewImage(input) {
        const file = input.files[0];
        const img = input.nextElementSibling;

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    let flagIndex = {{ count($car['flags']) ?? 0 }};

    function addFlagInput() {
        const flagContainer = document.getElementById('flagContainer');

        const newFlagInput = document.createElement('div');
        newFlagInput.classList.add('flagInput', 'row', 'g-2', 'align-items-center', 'mt-2');

        // Name
        const nameCol = document.createElement('div');
        nameCol.classList.add('col-md-5');
        const nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.classList.add('form-control');
        nameInput.name = `flags[${flagIndex}][name]`;
        nameInput.placeholder = 'Flag Name';
        nameCol.appendChild(nameInput);

        // Image
        const imageCol = document.createElement('div');
        imageCol.classList.add('col-md-5');
        const imageInput = document.createElement('input');
        imageInput.type = 'file';
        imageInput.classList.add('form-control');
        imageInput.name = `flags[${flagIndex}][image]`;
        imageInput.accept = 'image/*';
        imageInput.onchange = function() { previewImage(this); };
        const previewImg = document.createElement('img');
        previewImg.classList.add('img-preview', 'mt-2');
        previewImg.style.maxHeight = '80px';
        previewImg.style.display = 'none';
        imageCol.appendChild(imageInput);
        imageCol.appendChild(previewImg);

        // Remove
        const removeCol = document.createElement('div');
        removeCol.classList.add('col-md-2', 'd-flex', 'align-items-center');
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.classList.add('btn', 'btn-link', 'text-danger', 'p-0', 'ms-2');
        removeBtn.title = 'Remove';
        removeBtn.innerHTML = '<i class="bi bi-x-circle" style="font-size: 1.5rem;"></i>';
        removeBtn.onclick = function() {
            newFlagInput.remove();
        };
        removeCol.appendChild(removeBtn);

        // Append all
        newFlagInput.appendChild(nameCol);
        newFlagInput.appendChild(imageCol);
        newFlagInput.appendChild(removeCol);

        flagContainer.appendChild(newFlagInput);
        flagIndex++;
    }

    function previewImage(input) {
        const file = input.files[0];
        const img = input.nextElementSibling;

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<script>
    let featureIndex = {{ $featureIndex ?? 0 }};
    function addFeatureBlock() {
        const container = document.getElementById('featureBlockContainer');
        const newBlock = document.createElement('div');
        newBlock.className = 'feature-block row g-3 mb-3 align-items-end';
        newBlock.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">Feature</label>
                <select class="form-select" name="features[safety][${featureIndex}][name]">
                    @foreach ($features as $featureOption)
                        <option value="{{ $featureOption->value }}">{{ $featureOption->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Label</label>
                <input type="text" class="form-control" name="features[safety][${featureIndex}][label]">
            </div>
            <div class="col-md-3">
                <label class="form-label">Value</label>
                <input type="text" class="form-control" name="features[safety][${featureIndex}][value]">
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-link text-danger p-0" onclick="this.closest('.feature-block').remove()">
                    <i class="bi bi-x-circle" style="font-size: 1.4rem;"></i>
                </button>
            </div>
        `;
        container.appendChild(newBlock);
        featureIndex++;
    }

    let conditionIndex = 0;

    function addConditionBlock() {
        const container = document.getElementById('conditionBlockContainer');

        const conditionTypeOptions = `
            @foreach ($conditions as $item)
                <option value="{{ $item->value }}">{{ $item->name }}</option>
            @endforeach
        `;

        const uniqueKey = `new_${conditionIndex}`;

        const block = document.createElement('div');
        block.className = 'condition-block row g-3 mb-3';

        block.innerHTML = `
            <div class="col-md-3">
                <label class="form-label">Condition Type</label>
                <select class="form-select" name="conditions[${uniqueKey}][name]">
                    <option value="" selected>Choose...</option>
                    ${conditionTypeOptions}
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Part</label>
                <input type="text" class="form-control" name="conditions[${uniqueKey}][part]">
            </div>
            <div class="col-md-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="1" name="conditions[${uniqueKey}][description]"></textarea>
            </div>
            <div class="col-md-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="conditions[${uniqueKey}][image]" accept="image/*">
            </div>
        `;

        container.appendChild(block);
        conditionIndex++;
    }

</script>

@endsection
