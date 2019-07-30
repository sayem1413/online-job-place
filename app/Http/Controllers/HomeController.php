<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobPost;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allJobs = JobPost::get();
        // dd($allJobs);
        return view('home')->with('allJobs', $allJobs);
    }
}
