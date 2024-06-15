<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the list of pending role change requests.
     */
    public function showRoleChangeRequests()
    {
        $pendingRequests = User::whereNotNull('pending_role')->get();

        return view('admin.role-change-requests', compact('pendingRequests'));
    }

    /**
     * Approve the role change request for the given user.
     */
    public function approveRoleChange(User $user)
    {
        $user->role = $user->pending_role;
        $user->pending_role = null;
        $user->save();

        return redirect()->route('admin.role-change-requests')->with('status', 'Role change approved.');
    }

    /**
     * Deny the role change request for the given user.
     */
    public function denyRoleChange(User $user)
    {
        $user->pending_role = null;
        $user->save();

        return redirect()->route('admin.role-change-requests')->with('status', 'Role change denied.');
    }
}
