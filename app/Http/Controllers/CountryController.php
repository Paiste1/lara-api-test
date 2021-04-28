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
        $country = Country::find($id);

        if (empty($country)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }

        return response()->json($country, 200);

    }

    public function countryCreate(Request $request)
    {
        $country = Country::create($request->all());

        return response()->json($country, 201);
    }

    public function countryEdit(Request $request, Country $country)
    {
        $country->update($request->all());
        return response()->json($country, 200);
    }

    public function countryDelete(Request $request, Country $country)
    {
        $country->delete();
        return response()->json('', 204);
    }
}
