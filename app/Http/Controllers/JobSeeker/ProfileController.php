<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Image;
use App\User;
use DB;

class ProfileController extends Controller
{
    public function index(){
        return view('jobseeker.profile');
    }

    public function storeProfile(Request $request){
        // dd($request->all());
        $rules = [
            'avatar' => 'required|image| max:500000| mimes:jpeg,jpg,png',
            'resume' => 'required|file|mimes:doc,docx,pdf',
            'skills' => 'required',
        ];
        $messages = [
            'avatar.required' => 'You should add your photo',
            'resume.file' => 'You must add a Doc or PDF',
            'skills.required' => 'Skills is required',
        ];
        $this->validate($request, $rules, $messages);
        $imageUrl = $this->uploadImageProcess($request);
        $fileUrl = $this->uploadFileProcess($request);
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            "avatar"   => $imageUrl,
            "resume"   => $fileUrl,
            "skills"   => $request->skills,
        ]);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'User Profile updated Successfully!!',
        // ], 200);
        return redirect('/jobseeker/home');

    }

    protected function uploadImageProcess($request){
        $image = $request->file('avatar');
        $filename = time().'_'.$image->getClientOriginalName();
        $uploadPath = 'gallery/';
        // $imageResize = Image::make($image->getRealPath());
        $image->move($uploadPath, $filename);
        $imageUrl = $uploadPath . $filename;
        return $imageUrl;
    }

    protected function uploadFileProcess($request){
        $file = $request->file('resume');
        $fileActualName = time() . '_' . $file->getClientOriginalName();
        $uploadPath = 'files/';
        $file->move($uploadPath, $fileActualName);
        $fileUrl = $uploadPath . $fileActualName;
        return $fileUrl;
    }

}
