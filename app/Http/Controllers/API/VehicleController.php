<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Models\Activity;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        return response(json_encode(['vehicles' => VehicleResource::collection($vehicles)]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vehicle::create([
            'owner_id' => $request->owner_id,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'plate_number' => $request->plate_number,
            'hash_plate_number' => $request->plate_number
        ]);

        return response('', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            $vehicle->owner_id = $request->owner_id;
            $vehicle->brand_id = $request->brand_id;
            $vehicle->model = $request->model;
            $vehicle->serial_number = $request->serial_number;
            $vehicle->plate_number = $request->plate_number;
            $vehicle->hash_plate_number = $request->plate_number;
            $vehicle->save();
        }

        return response('', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            $vehicle->timestamps = false;
            $vehicle->delete();
        }

        return response('');
    }

    public function getOwnerVehicles($id)
    {
        $vehicles = Vehicle::whereNull('deleted_at')
            ->where('owner_id', $id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return response(json_encode(['vehicles' => VehicleResource::collection($vehicles)]));
    }

    public function upload(Request $request)
    {
        $imageName = 'image.png';
        $destinationPath = public_path('uploads/images/plate-number/');
        if (file_exists($destinationPath . $imageName)) {
            unlink($destinationPath . $imageName);
        }

        $imagePath = time();
        $request->file->move($destinationPath, $imageName);
        $request->file->move($destinationPath, $imagePath);

        return $this->sendRequestToAPI($request->user_id, $imagePath);
    }

    function sendRequestToAPI($user_id, $image_path)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://zyanyatech1-license-plate-recognition-v1.p.rapidapi.com/recognize_url?image_url=http://eslamoda.com/wp-content/uploads/sites/2/2014/11/america-carro-600x600.jpg",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: zyanyatech1-license-plate-recognition-v1.p.rapidapi.com",
                "X-RapidAPI-Key: e50ff6544dmsh96abe8be2418e27p186ce5jsnfaea1719295bs"
            ],
        ]);

        $json = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json_encode(['error' => true, 'response' => $err]);
        } else {
            return json_encode(['error' => false, 'response' => $json]);
        }

        $response = json_decode($json);

        $plate = null;
        $results = null;
        if (property_exists($response, 'results')) {
            $results = $response->results;
        }

        if ($results && property_exists($results[0], 'plate')) {
            $plate = $results[0]->plate;
        }

        $vehicle = null;

        $strPlate = "";
        if ($plate) {
            $strPlate = $plate;
            $vehicle = Vehicle::where('plate_number', $plate)->first();
        }

        Activity::create([
            'user_id' => $user_id,
            'image_path' => $image_path,
            'result_plate_number' => $strPlate
        ]);

        if ($vehicle) {
            return response(json_encode(['error' => false, 'response' => new VehicleResource($vehicle)]));
        } else {
            return response(json_encode(['error' => true, 'response' => 'Vehicle does not exist in the database.']), 404);
        }
    }
}
