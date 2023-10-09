<?php

namespace App\Http\Controllers;

use App\Models\Role;

class UserController extends Controller
{
    public function index() {
        if (!$this->isAuthorized()) {
            return view('unauthorized');
        }

        $roles = Role::orderBy('name')->get();
        return view('users.index')
            ->with('roles', $roles);
    }

    private function isAuthorized() {
        if (strtolower((auth()->user()->role->name)) !== "administrator") {
            return false;
        }

        return true;
    }
}
