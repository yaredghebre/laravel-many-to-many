@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Inserisci un nuovo progetto</h2>


        {{-- METODO DI VALIDAZIONE GLOBALE (messaggi in cima) --}}
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('comics.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>

                {{-- METODO DI VALIDAZIONE SPECIFICO (messaggi su ogni riga) --}}
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumb" class="form-label">Immagine</label>
                <input type="text" class="form-control @error('thumb') is-invalid @enderror" id="thumb" name="thumb" value="{{ old('thumb') }}">
                @error('thumb')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipologia</label>
                <select id="type" name="type" class="form-select">
                    <option selected value="">Seleziona</option>
                    <option @selected(old('type') === 'comic book') value="comic book">Comic Book</option>
                    <option @selected(old('type') === 'graphic novel') value="graphic novel">Graphic Novel</option>
                    <option @selected(old('type') === 'anime') value="anime">Anime</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control @error('thumb') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sale_date" class="form-label">Data di vendita</label>
                <input type="date" class="form-control @error('sale_date') is-invalid @enderror" id="sale_date" name="sale_date" value="{{ old('sale_date') }}">
                @error('sale_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="series" class="form-label">Serie</label>
                <input type="text" class="form-control @error('series') is-invalid @enderror" id="series" name="series" value="{{ old('series') }}">
                @error('series')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>

        </form>

        <h3 class="mt-4"><a href="{{ route('comics.index') }}">Torna ai COMICS</a></h3>
    </div>
@endsection
