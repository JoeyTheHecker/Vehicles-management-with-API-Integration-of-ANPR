<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index() {
        if (!$this->isAuthorized()) {
            return view('unauthorized');
        }

        return view('owners.index');
    }

    public function show($id) {
        if (!$this->isAuthorized()) {
            return view('unauthorized');
        }

        $owner = Owner::find($id);
        $brands = Brand::whereNull('deleted_at')
            ->orderBy('name')
            ->get();

        return view('owners.show')
            ->with(['owner' => $owner])
            ->with(['brands' => $brands]);
    }

    private function isAuthorized() {
        if (strtolower((auth()->user()->role->name)) !== "administrator") {
            return false;
        }

        return true;
    }
}
