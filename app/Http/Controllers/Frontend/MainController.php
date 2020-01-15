<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class MainController extends Controller
{
    public function index()
    {
        return view('frontend.app');
    }
}
