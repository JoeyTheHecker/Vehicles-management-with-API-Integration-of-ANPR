<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index() {
        if (!$this->isAuthorized()) {
            return view('unauthorized');
        }

        return view('activities.index');
    }

    private function isAuthorized() {
        if (strtolower((auth()->user()->role->name)) !== "administrator") {
            return false;
        }

        return true;
    }
}
