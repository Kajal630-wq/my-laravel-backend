<?php

namespace App\Http\Controllers\API;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $inquiries
        ]);
    }

    public function show($id)
    {
        $inquiry = Inquiry::find($id);
        
        if (!$inquiry) {
            return response()->json([
                'success' => false,
                'message' => 'Inquiry not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $inquiry
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'message' => 'nullable|string',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $inquiry = Inquiry::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $inquiry,
            'message' => 'Inquiry submitted successfully'
        ], 201);
    }

    public function markAsRead($id)
    {
        $inquiry = Inquiry::find($id);
        
        if (!$inquiry) {
            return response()->json([
                'success' => false,
                'message' => 'Inquiry not found'
            ], 404);
        }
        
        $inquiry->update(['is_read' => true]);
        
        return response()->json([
            'success' => true,
            'data' => $inquiry,
            'message' => 'Inquiry marked as read'
        ]);
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::find($id);
        
        if (!$inquiry) {
            return response()->json([
                'success' => false,
                'message' => 'Inquiry not found'
            ], 404);
        }
        
        $inquiry->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Inquiry deleted successfully'
        ]);
    }
}