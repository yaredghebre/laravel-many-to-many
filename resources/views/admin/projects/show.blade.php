@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Titolo: {{ $project->title }}</h2>
            @if ($project->type)
                <h4 class="card-text">Tipologia: {{ $project->type->name }}</h4>
            @else
                <h4 class="card-text">Tipologia: Nessuna tipologia</h4>
            @endif
            <p class="card-text">Descrizione: {{ $project->description }}</p>
        </div>
    </div>
</div>
@endsection