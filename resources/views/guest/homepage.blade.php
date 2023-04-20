@extends('layouts.app')
@section('content')
    <h1>Portfolio Progetti</h1>
    <div class="row justify-content-center g-4 mb-3 ">
        @foreach ($projects as $project)
            <div class="col-4">
                <div class="card shadow h-100 ">
                    <img src="{{ $project->getImageUri() }}" class="card-img-top image-fluid" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">Nome progetto: {{ $project->name }}</h4>
                        <p>Data di inzio: {{ $project->start_date }}</p>
                        <p>Data fine: {{ $project->end_date }}</p>
                        @if ($project->type?->type_of_stack)
                            <p>Tipo di stack: {{ $project->type?->type_of_stack }}</p>
                        @endif
                        <a href="#" class="btn btn-primary">Dettagli</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $projects->links('pagination::bootstrap-5') }}
@endsection
