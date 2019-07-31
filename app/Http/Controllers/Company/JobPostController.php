<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobPost;
use App\JobApplicantion;
use App\User;

class JobPostController extends Controller
{
    public function index(){
        return view('company.jobPost');
    }

    public function storeJobPost(Request $request){
        // dd($request->all());
        $rules = [
            'job_title' => 'required',
            'job_description' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'country' => 'required|not_in:0',
        ];
        $messages = [
            'job_title.required' => 'Job title is reqiuired',
            'job_description.required' => 'Job description is reqiuired',
            'salary.required' => 'Salary is reqiuired',
            'location.required' => 'Location is reqiuired',
            'country.required' => 'Country is reqiuired',
        ];
        $this->validate($request, $rules, $messages);

        $jobPost = new JobPost();
        $jobPost->job_title = $request->job_title;
        $jobPost->job_description = $request->job_description;
        $jobPost->salary = $request->salary;
        $jobPost->location = $request->location;
        $jobPost->country = $request->country;
        $jobPost->user_id = auth()->user()->id;
        $jobPost->save();

        // return response()->json([
        //     'success' => true,
        //     'message' => 'User Profile updated Successfully!!',
        // ], 200);
        return redirect('/company/home');
    }

    public function getAllJobPosts(){
        $allJobPosts = JobPost::where('user_id', auth()->user()->id)->get();
        return view('company.allJobPosts', [ 'allJobPosts' => $allJobPosts ]);
    }

    public function allApplicants($id){
        $allApplicants = JobApplicantion::where('job_post_id', $id)->get();
        $allApplicantDetails = [];
        foreach($allApplicants as $applicantId){
            $applicantDetails = User::where('id',$applicantId->user_id)->first();
            // dd($applicantDetails->first_name);
            $allApplicantDetails = [$applicantDetails];
        }
        return view('company.showAllApplicants',[ 'allApplicantDetails' => $allApplicantDetails ]);
    }
}
