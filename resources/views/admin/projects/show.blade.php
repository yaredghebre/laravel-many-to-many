@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $project->title }}</h2>
            <p class="card-text">{{ $project->description }}</p>
        </div>
    </div>
</div>
@endsection