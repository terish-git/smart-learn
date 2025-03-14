<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'role:admin|super-admin']);
    }
    
    public function dashboard()
    {
        return response()->json([
            'message' => 'Welcome to the Super Admin Dashboard',
            'user' => Auth::user(),
        ]);
    }
}
