<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPropertiesRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {
        $query = Property::query();

        if ($request->validated('price')) {

            $query = $query->where('price', '<=', $request->validated('price'));
        }
        if ($request->validated('surface')) {

            $query = $query->where('surface', '<=', $request->validated('surface'));
        }
        if ($request->validated('rooms')) {

            $query = $query->where('rooms', '<=', $request->validated('rooms'));
        }
        if ($request->validated('title')) {

            $query = $query->where('title', 'like', "%{$request->validated('title')}%");
        }

        // error Illegal operator and value combination.

        /*
        if ($request->has('price')) {

            $query = $query->where('price', '<=', $request->input('price'));
        }
        if ($request->has('surface')) {

            $query = $query->where('surface', '<=', $request->input('surface'));
        }
        if ($request->has('rooms')) {

            $query = $query->where('rooms', '<=', $request->input('rooms'));
        }
        if ($request->has('title')) {

            $query = $query->where('title', 'like', "%{$request->input('title')}%");
        }
        */


        // $properties = Property::paginate(16);

        return view('property.index', [

            //'properties' => $properties
            'properties' => $query->paginate(16),
            'input' => $request->validated()

        ]);
    }

    public function show(string $slug, Property $property)
    {
    }
}
