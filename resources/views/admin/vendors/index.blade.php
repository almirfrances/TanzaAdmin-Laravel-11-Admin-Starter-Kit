@extends('admin.layouts.admin')

@section('title', 'Vendors')

@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">Vendors</h4>
    <p class="text-muted">Manage your vendors. Create, edit, or delete vendors.</p>

    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary">Create Vendor</a>

            <form action="{{ route('admin.vendors.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control" placeholder="Search vendors..." value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-secondary ms-2">Search</button>
            </form>
        </div>

        <div class="card-datatable table-responsive">
            <table class="table table-hover" id="users-table">
                <thead class="thead-light">
                    <tr>
                        <th>Username</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td class="d-flex align-items-center">
                                <div class="user-initials">
                                    {{ strtoupper($vendor->username[0]) }}
                                </div>
                                <span class="ms-2"> <strong>{{ $vendor->username }}</strong> </span>

                                <style>
                                    .user-initials {
                                        width: 30px; /* Adjust size as needed */
                                        height: 30px; /* Adjust size as needed */
                                        background-color: #d12728; /* Placeholder color */
                                        color: white;
                                        font-size: 20px; /* Adjust size as needed */
                                        font-weight: bolder ;
                                        text-transform: uppercase;
                                        display: inline-flex;
                                        justify-content: center;
                                        align-items: center;
                                        border-radius: 15%;
                                        object-fit: cover;
                                    }
                                </style>
                            </td>
                            <td>{{ $vendor->phone }}</td>


                            <td>{{ $vendor->email }}</td>
                            <td>
                                @if ($vendor->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>


                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.vendors.edit', $vendor->id) }}"><i
                                                    class="ti ti-pencil me-2"></i>Edit</a></li>
                                        <li>
                                            <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger" type="submit"><i
                                                        class="ti ti-trash me-2"></i>Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($vendors->isEmpty())
                <div class="text-center py-4">
                    <h5 class="text-muted">No vendors found</h5>
                </div>
            @endif

            <div class="d-flex justify-content-center mt-4">
                {{ $vendors->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
