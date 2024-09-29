@extends('user.layouts.user')

@section('title', $title)

@section('user')
<div class="container-xxl flex-grow-1 container-p-y">
    @isUser
    <h4 class="mb-4">User Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the User dashboard. Below is a quick overview of your account.
    </p>




</div>

    @endisUser

    @isVendor
    <h4 class="mb-4">Vendor Dashboard Overview</h4>
    <p class="mb-4 text-muted">
        Welcome to the Vendor dashboard. Below is a quick overview of your account.
    </p>
    @endisVendor

   

    <div class="row g-4">





    </div>
</div>
@endsection
