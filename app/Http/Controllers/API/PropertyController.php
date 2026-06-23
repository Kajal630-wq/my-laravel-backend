<?php

namespace App\Http\Controllers\API;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    // Get all properties
    public function index(Request $request)
    {
        $query = Property::query();

        // Search filter
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        // Featured filter
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }

        $properties = $query->orderBy('created_at', 'desc')->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $properties
        ]);
    }

    // Get featured properties
    public function featured()
    {
        $properties = Property::where('is_featured', true)
                            ->orderBy('created_at', 'desc')
                            ->limit(6)
                            ->get();


        return response()->json([
            'success' => true,
            'data' => $properties
        ]);
    }

    // Get single property
        public function show($id)
        {
            $property = Property::find($id);

            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $property,
                'message' => 'Property retrieved successfully'
            ]);
        }

    // Create new property
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'price' => 'required|string',
        'price_value' => 'required|numeric',
        'beds' => 'required|integer',
        'baths' => 'required|integer',
        'sqft' => 'required|integer',
        'image' => 'required|url',
        'description' => 'required|string',
        'features' => 'required|array',
        'built_year' => 'required|integer',
        'tag' => 'nullable|string',
        'tag_color' => 'nullable|string',
        'is_featured' => 'boolean',  // ✅ Add this
    ]);

    // ✅ Set default if not provided
    if (!isset($validated['is_featured'])) {
        $validated['is_featured'] = false;
    }

    $property = Property::create($validated);

    return response()->json([
        'success' => true,
        'data' => $property,
        'message' => 'Property created successfully'
    ], 201);
}

    // Update property
    public function update(Request $request, $id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json([
                'success' => false,
                'message' => 'Property not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'price' => 'sometimes|string',
            'price_value' => 'sometimes|numeric',
            'beds' => 'sometimes|integer',
            'baths' => 'sometimes|integer',
            'sqft' => 'sometimes|integer',
            'image' => 'sometimes|url',
            'description' => 'sometimes|string',
            'features' => 'sometimes|array',
            'built_year' => 'sometimes|integer',
        ]);

        $property->update($validated);

        return response()->json([
            'success' => true,
            'data' => $property,
            'message' => 'Property updated successfully'
        ]);
    }

    // Delete property
    public function destroy($id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json([
                'success' => false,
                'message' => 'Property not found'
            ], 404);
        }

        $property->delete();

        return response()->json([
            'success' => true,
            'message' => 'Property deleted successfully'
        ]);
    }
}