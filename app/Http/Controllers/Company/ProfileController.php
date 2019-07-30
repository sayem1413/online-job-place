<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Image;
use App\User;
use DB;

class ProfileController extends Controller
{
    public function index(){
        return view('company.profile');
    }

    public function storeProfile(Request $request){
        // dd($request->all());
        $rules = [
            'avatar' => 'required|image| max:500000| mimes:jpeg,jpg,png',
            'resume' => 'required|file|mimes:doc,docx,pdf',
        ];
        $messages = [
            'avatar.required' => 'You should add your photo',
            'resume.file' => 'You must add a Doc or PDF',
        ];
        $this->validate($request, $rules, $messages);
        $imageUrl = $this->uploadImageProcess($request);
        $fileUrl = $this->uploadFileProcess($request);
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            "avatar"   => $imageUrl,
            "resume"   => $fileUrl
        ]);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'User Profile updated Successfully!!',
        // ], 200);
        return redirect('/company/home');

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
