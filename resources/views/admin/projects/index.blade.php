@extends('layouts.admin')

@section('content')
    @include('partials.session_message')

    <h1>I miei progetti</h1>
    <div class="text-end">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Aggiungi Progetto +</a>
    </div>

    {{-- Filtri --}}
    <form action="{{ route('admin.projects.index') }}" method="GET" class="mx-2">
        @csrf
        <label for="">Tipologia</label>
        <select name="type_id" id="type">
            <option value="">All</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
        <button type="submit">Filtra</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->type?->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-success">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('admin.projects.destroy', $project->slug) }}" 
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete" data-project-title="{{ $project->title }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{-- Pagination --}} 
    {{ $projects->links() }} 
    @include('partials.modal_delete')
@endsection
