<?php

namespace App\Http\Controllers;

class VehicleController extends Controller
{
    public function index() {
        if (!$this->isAuthorized()) {
            return view('unauthorized');
        }

        return view('vehicles.index');
    }

    private function isAuthorized() {
        if (strtolower((auth()->user()->role->name)) !== "administrator") {
            return false;
        }

        return true;
    }
}
