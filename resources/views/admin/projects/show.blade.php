@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary my-4">Torna alla lista</a>
    <div class="card">
        <div class="card-body my-2">
            <h5 class="card-title my-2"><strong>Nome progetto:</strong> {{ $project->name }}</h5>
            @if (isset($project->type->type_of_stack))
                <h6 class="card-subtitle mb-2 my-2"><strong> Stack utilizzato:</strong> {{ $project->type->type_of_stack }}
                </h6>
            @endif
            <h6>Tecnologie utilizzate</h6>
            <ul>
                @forelse ($project->technologies as $technology)
                    <li> {{ $technology->name }}</li>
                @empty
                    Nessuna tecnologia utilizzata
                @endforelse
            </ul>
            <h6 class="card-subtitle mb-2 my-2"><strong> Data di inzio:</strong> {{ $project->start_date }}</h6>
            <h6 class="card-subtitle mb-2 my-2"><strong> Data fine:</strong> {{ $project->end_date }}</h6>
            <h6><strong>Descrizione:</strong></h6>
            <p class="card-text">{{ $project->description }}</p>
            <div class="col-3">
                <img src="{{ $project->getImageUri() }}" alt="" class="img-fluid" id="img-preview">
            </div>
        </div>
    </div>
@endsection
