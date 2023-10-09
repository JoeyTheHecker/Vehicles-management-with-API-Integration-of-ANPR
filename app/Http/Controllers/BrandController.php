<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {
        if (!$this->isAuthorized()) {
            return view('unauthorized');
        }

        return view('brands.index');
    }

    private function isAuthorized() {
        if (strtolower((auth()->user()->role->name)) !== "administrator") {
            return false;
        }

        return true;
    }
}
