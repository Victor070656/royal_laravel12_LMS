<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        return view('backend.instructor.dashboard');
    }
}
