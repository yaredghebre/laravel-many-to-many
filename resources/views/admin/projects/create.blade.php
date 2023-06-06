@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <h2>Crea un nuovo progetto</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Invia</button>
        </form>
    </div>
@endsection
