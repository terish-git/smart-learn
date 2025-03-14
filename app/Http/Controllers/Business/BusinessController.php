<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Services\BusinessService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    protected $businessService;
    protected $categoryService;

    public function __construct(BusinessService $businessService, CategoryService $categoryService)
    {
        $this->businessService = $businessService;
        $this->categoryService = $categoryService;
    }

    public function dashboard()
    {
        $user = auth()->user();

        if (!$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get Business Profile
        $business = Business::with('user.businessType')->where('user_id', $user->id)->first();

        if (!$business) {
            return response()->json(['message' => 'PLease update business profile details'], 404);
        }

        $categories = $this->categoryService->getCategories($business->id);
        
        // Example Data - Modify as needed
        $totalCourses = 10; // Replace with actual course count query
        $totalRevenue = 5000; // Replace with actual revenue calculation

        return response()->json([
            'message' => 'Business dashboard data retrieved successfully!',
            'business' => $business,
            'data' => [
                'categories' => $categories,
                'total_courses' => $totalCourses,
                'total_revenue' => $totalRevenue,
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        try {
            $business = $this->businessService->updateProfile(auth()->user(), $request->all());
            return response()->json(['message' => 'Business updated successfully!', 'business' => $business]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
