@extends('admin.layouts.admin')
@section('title', $title)

@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Logo and Favicon Settings</h4>
            <p class="text-muted">Update the site logos and favicon here to ensure your branding is consistent across all platforms.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.logo.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">

            <!-- Logo Light -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Logo Light</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . ($settings['logo_light'] ?? 'path/to/default/logo_light.png')) }}" alt="Light Logo" class="img-fluid mb-3" style="background-color: black;">
                        <input type="file" class="form-control mb-3" id="logo_light" name="logo_light">
                        <small class="form-text text-muted">Upload the light version of the logo (recommended size: 243x61 px). This logo is typically used on dark backgrounds.</small>
                    </div>
                </div>
            </div>

            <!-- Logo Dark -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Logo Dark</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . ($settings['logo_dark'] ?? 'path/to/default/logo_dark.png')) }}" alt="Dark Logo" class="img-fluid mb-3">
                        <input type="file" class="form-control mb-3" id="logo_dark" name="logo_dark">
                        <small class="form-text text-muted">Upload the dark version of the logo (recommended size: 243x61 px). This logo is typically used on light backgrounds.</small>
                    </div>
                </div>
            </div>

            <!-- Favicon -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Favicon</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . ($settings['favicon'] ?? 'path/to/default/favicon.png')) }}" alt="Favicon" class="img-fluid mb-3" style="width: 50px; height: 50px;">
                        <input type="file" class="form-control mb-3" id="favicon" name="favicon">
                        <small class="form-text text-muted">Upload the favicon image (recommended size: 512x512 px). This small icon represents your site in the browser tab.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary waves-effect waves-light me-2">
                <i class="ti ti-check me-1"></i> Update Settings
            </button>
            <button type="button" class="btn btn-label-secondary waves-effect" onclick="window.history.back();">
                <i class="ti ti-arrow-left me-1"></i> Cancel
            </button>
        </div>
    </form>
</div>
@endsection
