@extends('layouts.app')

@section('title', 'Lista tipi di stack')


@section('content')
    <table class="table table-striped">
        <a class="btn btn-primary my-3" href="{{ route('admin.types.create') }}">Aggiungi stack</a>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tipo di stack</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <th scope="row">{{ $type->id }}</th>
                    <td>{{ $type->type_of_stack }}</td>
                    <td>
                        <a href={{ route('admin.types.show', $type) }} class="action-icon">
                            <i class=" bi bi-eye mx-2"></i>
                        </a>
                        <a href={{ route('admin.types.edit', $type) }} class="action-icon">
                            <i class="bi bi-pencil mx-2"></i>
                        </a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-modal-{{ $type->id }}">
                            <i class="bi bi-trash mx-2"></i>
                        </button>
                        @foreach ($types as $type)
                            <!-- Modal -->
                            <div class="modal fade" id="delete-modal-{{ $type->id }}" tabindex="-1"
                                aria-labelledby="delete-modal-{{ $type->id }}-label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="delete-modal-{{ $type->id }}-label">
                                                Conferma eliminazione</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Sei sicuro di voler eliminare il type
                                            <strong>{{ $type->type_of_stack }}</strong>
                                            <br>
                                            L'operazione non è reversibile
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annulla</button>

                                            <form action="{{ route('admin.types.destroy', $type) }}" method="POST"
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
    {{-- {{ $->links('pagination::bootstrap-5') }} --}}
@endsection
