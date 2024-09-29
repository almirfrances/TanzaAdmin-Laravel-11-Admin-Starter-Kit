@extends('admin.layouts.app')
@section('app')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('admin.partials.aside')
        <div class="layout-page">
            @include('admin.partials.navbar')
            <div class="content-wrapper">
                    @yield('admin')
                @include('admin.partials.footer')
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>
@endsection
