@extends('layouts.app')

@section('title', 'Lista progetti')


@section('content')
    <table class="table table-striped">
        <a class="btn btn-primary my-3" href="{{ route('admin.projects.create') }}">Aggiungi progetto</a>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome Progetto</th>
                <th scope="col">Linguaggi utilizzati</th>
                <th scope="col">Data inizio progetto</th>
                <th scope="col">Data fine progetto</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->programming_languages_used }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>
                        <a href={{ route('admin.projects.show', $project) }} class="action-icon">
                            <i class=" bi bi-eye mx-2"></i>
                        </a>
                        <a href={{ route('admin.projects.edit', $project) }} class="action-icon">
                            <i class="bi bi-pencil mx-2"></i>
                        </a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-modal-{{ $project->id }}">
                            <i class="bi bi-trash mx-2"></i>
                        </button>
                        @foreach ($projects as $project)
                            <!-- Modal -->
                            <div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1"
                                aria-labelledby="delete-modal-{{ $project->id }}-label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="delete-modal-{{ $project->id }}-label">
                                                Conferma eliminazione</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Sei sicuro di voler eliminare il progetto <strong>{{ $project->name }}</strong>
                                            <br>
                                            L'operazione non è reversibile
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annulla</button>

                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                                class="">
                                                @method('DELETE')
                                                @csrf

                                                <button type="submit" class="btn btn-danger">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $projects->links('pagination::bootstrap-5') }}
@endsection
