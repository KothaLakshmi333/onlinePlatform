@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pending Role Change Requests</h1>
        
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th>Requested Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingRequests as $request)
                    <tr>
                        <td>{{ $request->name }}</td>
                        <td>{{ $request->email }}</td>
                        <td>{{ $request->role }}</td>
                        <td>{{ $request->pending_role }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.approve-role-change', $request) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.deny-role-change', $request) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Deny</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
