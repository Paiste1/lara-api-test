<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function country()
    {
        return response()->json(Country::get(), 200);
    }

    public function countryId($id)
    {
        return response()->json(Country::find($id), 200);
    }

    public function countryCreate(Request $request)
    {
        $country = Country::create($request->all());

        return response()->json($country, 201);
    }
}
