<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Rules\ValidCountryCode;
use App\Http\Resources\CityResource;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->per_page ? $request->per_page : 30;
        $cities = City::orderBy('id')->paginate($limit);
        return CityResource::collection($cities);
    }

    public function show(City $city)
    {
        return new CityResource($city);
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name'          => 'required|max:255',
                'country'       => [
                    'required',
                    new ValidCountryCode(),
                ],
            ]
        );

        $city = new City();

        // Validate if country with same city exists
        if ($city->getCity($data)) {
            $return = ['success' => false, 'error' => 'Given city already exist.'];
            return response($return, 400);
        }

        $city->name = $data['name'];
        $city->country = $data['country'];
        $city->save();

        $response = ['success' => true, 'city_id' => $city->key];

        return response($response, 201);
    }
}
