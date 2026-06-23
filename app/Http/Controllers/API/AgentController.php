<?php

namespace App\Http\Controllers\API;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Get all agents
     */
    public function index()
    {
        $agents = Agent::orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $agents,
            'message' => 'Agents retrieved successfully'
        ]);
    }

    /**
     * Get single agent
     */
    public function show($id)
    {
        $agent = Agent::find($id);

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Agent not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $agent,
            'message' => 'Agent retrieved successfully'
        ]);
    }

    /**
     * Create new agent
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|string|max:255',  // ✅ nullable
            'image' => 'nullable|url',
            'experience_years' => 'nullable|integer|min:0',
            'properties_sold' => 'nullable|integer|min:0',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // ✅ Set default values for optional fields
        $data = $request->all();
        $data['role'] = $data['role'] ?? null;
        $data['image'] = $data['image'] ?? null;
        $data['experience_years'] = $data['experience_years'] ?? 0;
        $data['properties_sold'] = $data['properties_sold'] ?? 0;

        $agent = Agent::create($data);

        return response()->json([
            'success' => true,
            'data' => $agent,
            'message' => 'Agent created successfully'
        ], 201);
    }

    /**
     * Update agent
     */
    public function update(Request $request, $id)
    {
        $agent = Agent::find($id);

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Agent not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:agents,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable|url',
            'experience_years' => 'nullable|integer|min:0',
            'properties_sold' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $agent->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $agent,
            'message' => 'Agent updated successfully'
        ]);
    }

    /**
     * Delete agent
     */
    public function destroy($id)
    {
        $agent = Agent::find($id);

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Agent not found'
            ], 404);
        }

        $agent->delete();

        return response()->json([
            'success' => true,
            'message' => 'Agent deleted successfully'
        ]);
    }
}