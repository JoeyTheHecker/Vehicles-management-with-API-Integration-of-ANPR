<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\IdentifyVehicleController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Resources\BrandResource;
use App\Http\Resources\OwnerResource;
use App\Http\Resources\VehicleResource;
use App\Models\Brand;
use App\Models\Owner;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        $owners = Owner::whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $vehicles = Vehicle::whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $brands = Brand::whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $latestOwners = Owner::whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->skip(0)
            ->take(10)
            ->get();


        $latestVehicles = Vehicle::whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->skip(0)
            ->take(10)
            ->get();

        $latestBrands = Brand::whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->skip(0)
            ->take(10)
            ->get();

        return view('dashboard')
            ->with('total_owners', count($owners))
            ->with('total_vehicles', count($vehicles))
            ->with('total_brands', count($brands))
            ->with('latest_owners', OwnerResource::collection($latestOwners))
            ->with('latest_vehicles', VehicleResource::collection($latestVehicles))
            ->with('latest_brands', BrandResource::collection($latestBrands));
    })->name('dashboard');

    Route::get('/profile', function() {
        return view('profile.index');
    })->name('profile.index');

    Route::post('/profile/{id}', function($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $id . '|max:255',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response(json_encode($validator->errors()), 500);
        }

        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // $request->session()->flash('success', 'Your profile has been successfully updated.');
        return response('', 204);
    })->name('profile.update');

    Route::get('/identify-vehicles', [IdentifyVehicleController::class, 'index'])->name('identify-vehicles.index');
    Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
    Route::get('/owners/{id}', [OwnerController::class, 'show'])->name('owners.show');

    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
});
