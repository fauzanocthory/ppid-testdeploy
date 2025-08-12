<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // TODO : show all users
    }

    public function create()
    {
        // TODO : show create user form
    }

    public function store(Request $request)
    {
        // TODO : create new user
    }

    public function show(User $user)
    {
        // TODO : show user detail
    }

    public function edit(User $user)
    {
        // TODO : show edit user form
    }

    public function update(Request $request, User $user)
    {
        // TODO : update user
    }

    public function destroy(User $user)
    {
        // TODO : delete user
    }
}