@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @foreach($allJobs as $job)
                    <div>
                        <h2>{{ $job->job_title }}</h2>
                        <p>{{ $job->job_description }}</p>
                        <a class="btn btn-success" href="{{ route('apply_job',[$job->id]) }}">Apply here</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
