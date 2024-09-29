@extends('admin.layouts.admin')

@section('title', $title)

@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the admin dashboard. Below is a quick overview of your site's statistics, including services, projects, blogs, members, and messages.
    </p>

    <div class="row g-4">

        <!-- Total Messages Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded-circle bg-label-secondary">
                                <i class="ti ti-message-circle ti-md"></i>
                            </span>
                        </div>
                        <h4 class="mb-0">{{ $totalMessages }}</h4>
                    </div>
                    <p class="mb-1 fw-semibold">Total Messages</p>
                    <p class="text-muted mb-0 small">Unread and Read</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
