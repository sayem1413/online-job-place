<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobApplicantion;

class JobApplyController extends Controller
{
    public function index($id){
        // dd($id);
        $job_application = new JobApplicantion();
        $job_application->job_post_id = $id;
        $job_application->user_id = auth()->user()->id;
        $job_application->save();

        return response()->json([
            'success' => true,
            'message' => 'Apllied Successfully!!',
        ], 200);
        // return redirect('/jobseeker/home');
    }
}
