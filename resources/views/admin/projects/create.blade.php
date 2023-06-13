@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <h2>Crea un nuovo progetto</h2>

        @include('partials.errors')

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-back text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type">Tipologia</label>
                <select class="form-select" id="type" name="type_id">
                    <option value=""></option>
                    @foreach ($types as $type)
                        <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <h5>Seleziona le tech</h5>
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input class="form-check-input" name="technologies[]" type="checkbox" value="{{ $technology->id }}" id="technology-{{ $technology->id }}" @checked(in_array($technology->id, old('technologies', [])))>
                        <label class="form-check-label" for="technology-{{ $technology->id }}">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image-input" class="form-label">Immagine</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror"  name="image"
                    value="{{ old('file') }}" id="image-input">
                @error('file')
                    <div class="invalid-back text-danger">
                        {{ $message }}
                    </div>
                @enderror

                <div class="my-3">
                    <img src="" id="image-preview" class="d-none w-25" alt="">
                </div>
            </div>


            <button class="btn btn-primary" type="submit">Invia</button>
        </form>
    </div>
@endsection
