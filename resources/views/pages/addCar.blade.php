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
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Model Year</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">License Expire Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Body Style</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($bodyStyles as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Type</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($types as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div>
                    {{-- min and max value --}}
                    <label for="customRange1" class="form-label">Fuel Economy range</label>
                    <input type="range" class="form-range" id="customRange1">
                </div>

                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Transmission Type</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($transmissionTypes as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Drive Type</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($driveTypes as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Engine Type</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($engineTypes as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Engine Capacity cc</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputColor" class="col-sm-2 col-form-label">Color</label>
                  <div class="col-sm-10">
                    <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#4154f1" title="Choose your color">
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Long</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Width</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Height</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Mileage</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div>
                    {{-- min and max value --}}
                    <label for="customRange1" class="form-label">Horse Power Range</label>
                    <input type="range" class="form-range" id="customRange1">
                </div>

                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Vehicle Status</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($vehicleStatuses as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Refurbishment Status</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($refurbishmentStatuses as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">price</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>

                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">discount</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>

                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Monthly Installment</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control">
                  </div>
                </div>


                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Trim</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($trim as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Images Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Flags</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                  {{-- + to add more flags --}}
                </div>

                <div>

                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Features</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($features as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Label</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Value</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>
                {{-- + add more features --}}
                </div>

                <div>

                <div class="col-md-4">
                  <label for="inputModel" class="form-label">Conditions</label>
                  <select id="inputModel" class="form-select">
                    <option selected>Choose...</option>
                    @foreach ($conditions as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Part</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px"></textarea>
                  </div>
                </div>
                {{-- + add more condition --}}
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>

        </div>
    </section>

@endsection
