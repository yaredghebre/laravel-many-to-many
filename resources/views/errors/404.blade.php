@extends('layouts.app')

@section('content')
<div class="wrapper vh-100 bg-danger-subtle py-5">
    <div class="container text-center">
        <h1 class="">Ops! Qualcosa è andato storto!</h1>
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">Ritorna alla Dashboard</a>
            <a href="{{ url()->previous() }}" class="btn btn-warning">Ritorna alla pagina precedente</a>
        </div>
    </div>
</div>
@endsection