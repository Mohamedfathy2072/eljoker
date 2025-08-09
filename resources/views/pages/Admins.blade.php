@extends('layouts.app')

@section('title', 'Admins')

@section('content')
<div class="pagetitle">
  <h1>Welcome to admin dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Admins</li>
    </ol>
  </nav>
</div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">Admins</h5>
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
                    @session('success')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endsession
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                        Add New Admin
                    </button>
                    <div class="modal fade" id="verticalycentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('admin.Admin.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                <h5 class="modal-title">Add New Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="adminName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="adminName" name="name" required>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="adminEmail" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="adminEmail" name="email" required>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="adminPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="adminPassword" name="password">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div><!-- End Vertically centered Modal-->
                </div>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead>
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Email</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Created Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('Y/m/d') }}</td>
                        <td>
                            <!-- Edit Button triggers modal -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBrandModal{{ $item->id }}">
                                Edit
                            </button>

                            <!-- Edit Brand Modal -->
                            <div class="modal fade" id="editBrandModal{{ $item->id }}" tabindex="-1" aria-labelledby="editBrandModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.Admin.edit', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editBrandModalLabel{{ $item->id }}">Edit Admin</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="editAdminName{{ $item->id }}" class="form-label">Admin Name</label>
                                                    <input type="text" class="form-control" id="editAdminName{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="editAdminEmail{{ $item->id }}" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="editAdminEmail{{ $item->id }}" name="email" value="{{ $item->email }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="editAdminPassword{{ $item->id }}" class="form-label">Password</label>
                                                    <input type="text" class="form-control" id="editAdminPassword{{ $item->id }}" name="password">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('admin.Admin.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
             <div class="d-flex justify-content-center mt-3">
                    {{ $data->links('pagination::bootstrap-5') }}
            </div>
            </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

@endsection
