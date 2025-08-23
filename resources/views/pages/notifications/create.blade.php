@extends('layouts.app')

@section('title', 'Send Notification')

@section('content')
<div class="pagetitle">
  <h1>Send Notification</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item">Notifications</li>
      <li class="breadcrumb-item active">Send</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">New Notification</h5>
          
          <ul class="nav nav-tabs" id="notificationTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="topic-tab" data-bs-toggle="tab" data-bs-target="#topic-tab-pane" type="button" role="tab" aria-controls="topic-tab-pane" aria-selected="true">
                Send to Topic
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane" type="button" role="tab" aria-controls="users-tab-pane" aria-selected="false">
                Send to Users
              </button>
            </li>
          </ul>

          <div class="tab-content pt-2" id="notificationTabsContent">
            <!-- Topic Tab -->
            <div class="tab-pane fade show active" id="topic-tab-pane" role="tabpanel" aria-labelledby="topic-tab" tabindex="0">
              <form id="topicForm" action="{{ route('notifications.send') }}" method="POST">
                @csrf
                <input type="hidden" name="send_type" value="topic">
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Topic</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="topic" required>
                      <option value="">Select a topic</option>
                      <option value="general">General</option>
                      <option value="updates">Updates</option>
                      <option value="promotions">Promotions</option>
                      <option value="alerts">Alerts</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" required maxlength="255">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Message</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="body" rows="5" required maxlength="1000"></textarea>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Send to Topic</button>
                </div>
              </form>
            </div>

            <!-- Users Tab -->
            <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
              <form id="usersForm" action="{{ route('notifications.send') }}" method="POST">
                @csrf
                <input type="hidden" name="send_type" value="users">
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Select Users</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="user_ids[]" multiple required data-placeholder="Select users...">
                      @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" required maxlength="255">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Message</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="body" rows="5" required maxlength="1000"></textarea>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Send to Selected Users</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .select2-container {
    width: 100% !important;
  }
  .select2-container--default .select2-selection--multiple {
    min-height: 38px;
    border: 1px solid #ced4da;
  }
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    // Initialize Select2
    $('select[name="user_ids[]"]').select2({
      placeholder: 'Select users...',
      allowClear: true
    });

    // Handle form submission
    $('form').on('submit', function(e) {
      e.preventDefault();
      const form = $(this);
      
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
          toastr.success('Notification sent successfully!');
          form.trigger('reset');
          $('select').trigger('change');
        },
        error: function(xhr) {
          const errors = xhr.responseJSON?.errors;
          if (errors) {
            Object.values(errors).forEach(error => {
              toastr.error(error[0]);
            });
          } else {
            toastr.error('An error occurred. Please try again.');
          }
        }
      });
    });
  });
</script>
@endpush
@endsection
