@extends('admin.layouts.app')
@section('app')

<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">

        @include('user.partials.menu')
        <div class="layout-page">

            <div class="content-wrapper">
                @include('user.partials.navbar')

                    @yield('user')


                @include('user.partials.footer')
                <div class="content-backdrop fade"></div>
            </div>

            
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>
@endsection
