@extends('layouts.admin')

@section('content')
    <div class="wrapper py-3">
        <h1>Benvenuto {{ Auth::user()->name }}!</h1>
    </div>
@endsection