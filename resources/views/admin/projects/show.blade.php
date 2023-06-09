@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Titolo: {{ $project->title }}</h2>

                @if ($project->type)
                    <h4 class="card-text">Tipologia: </h4>
                    <ul>
                        <li>{{ $project->type->name }}</li>
                    </ul>
                @else
                    <h4 class="card-text">Tipologia: </h4>
                    <ul>
                        <li>Nessuna tipologia</li>
                    </ul>

                @endif

                <h4 class="card-text">Tecnologie: </h4>
                <ul>
                    @forelse ($project->technologies as $technology)
                        <li class="card-text">{{ $technology->name }}</li>
                    @empty
                        <li class="card-text">Tecnologia non specificata</li>
                    @endforelse
                </ul>

                @if ($project->description)
                    <h4 class="card-text">Descrizione: </h4>
                    <p class="card-text">{{ $project->description }}</p>
                @else
                    <h4 class="card-text">Descrizione: </h4>
                    <p class="card-text">Nessuna descrizione</p>
                @endif

            </div>
        </div>
    </div>
@endsection
