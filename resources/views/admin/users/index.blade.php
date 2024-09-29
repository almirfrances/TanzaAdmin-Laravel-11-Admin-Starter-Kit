@extends('admin.layouts.admin')

@section('title', 'Users')

@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">Users</h4>
    <p class="text-muted">Manage your users. Create, edit, or delete users.</p>

    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create User</a>

            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request()->get('search') }}">
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
                    @foreach ($users as $user)
                        <tr>
                            <td class="d-flex align-items-center">
                                <div class="user-initials">
                                    {{ strtoupper($user->username[0]) }}
                                </div>
                                <span class="ms-2"> <strong>{{ $user->username }}</strong> </span>

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
                            <td>{{ $user->phone }}</td>


                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->status === 'active')
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
                                                href="{{ route('admin.users.edit', $user->id) }}"><i
                                                    class="ti ti-pencil me-2"></i>Edit</a></li>
                                        <li>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
            @if($users->isEmpty())
                <div class="text-center py-4">
                    <h5 class="text-muted">No users found</h5>
                </div>
            @endif

            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('vendor.pagination.simple-bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
