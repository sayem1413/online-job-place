
@extends('layouts.companyApp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Applicant Details for this job</div>

                <div class="card-body">
                    @foreach($allApplicantDetails as $applicant)
                    <div>
                        <strong>{{ $applicant->first_name }}</strong>
                        <p>Skills - {{ $applicant->skills }}</p>
                        <p>Resume - <a href="{{ asset($applicant->resume) }}">{{ $applicant->email }}</a></p>
                        <img height="50px" width="50px" src="{{asset($applicant->avatar)}}"/>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection