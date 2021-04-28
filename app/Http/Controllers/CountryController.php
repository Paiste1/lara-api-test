<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'alias' => 'required|min:2|max:3',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $valid = Validator::make($request->all(), $rules);

        if ($valid->fails()){
            return response()->json($valid->errors(), 400);
        }

        $country = Country::create($request->all());

        return response()->json($country, 201);
    }

    public function countryEdit(Request $request, $id)
    {
        $rules = [
            'alias' => 'required|min:2|max:3',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $valid = Validator::make($request->all(), $rules);

        if ($valid->fails()){
            return response()->json($valid->errors(), 400);
        }

        $country = Country::find($id);

        if (empty($country)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }

        $country->update($request->all());
        return response()->json($country, 200);
    }

    public function countryDelete(Request $request, $id)
    {
        $country = Country::find($id);

        if (empty($country)) {
            return response()->json([
                'error' => true,
                'message' => 'Not found'
            ], 404);
        }

        $country->delete();
        return response()->json('', 204);
    }

    public function check($country)
    {

    }
}
