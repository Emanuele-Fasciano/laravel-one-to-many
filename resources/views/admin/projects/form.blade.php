@extends('layouts.app')

@section('title', $project->id ? 'Modifica progetto' : 'Crea nuovo progetto')

@section('content')
    <a class="btn btn-primary my-4" href="{{ route('admin.projects.index') }}">Torna alla lista</a>
    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Correggi i seguenti errori per proseguire: </h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($project->id)
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf

    <div class="row">
        <div class="col-10">
            <label for="name" class="form-label @error('name') is-invalid @enderror">Nome progetto</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name') ?? $project->name }}" />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-5 mt-3">
            <label for="start_date" class="form-label @error('start_date') is-invalid @enderror">Data di inzio</label>
            <input type="date" class="form-control" id="start_date" name="start_date"
                value="{{ old('start_date') ?? $project->start_date }}" />
            @error('start_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-5 my-3">
            <label for="end_date" class="form-label @error('end_date') is-invalid @enderror">Data fine</label>
            <input type="date" class="form-control" id="end_date" name="end_date"
                value="{{ old('end_date') ?? $project->end_date }}" />
            @error('end_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-10">
            <label for="technology_id" class="form-label me-3 @error('technology_id') is-invalid @enderror">Tecnologie
                utilizzate:</label> <br>
            @foreach ($technologies as $technology)
                <input type="checkbox" name="technology[]" id="technology{{ $technology->id }}"
                    value="{{ $technology->id }}" class="form-check-control"
                    @if (in_array($technology->id, old('technology', $project_technology ?? []))) checked @endif>
                <label for="technology{{ $technology->id }}">{{ $technology->name }}</label> <br>
            @endforeach

        </div>
        <label for="description" class="form-label mt-4 @error('description') is-invalid @enderror">Descrizione</label>
        <textarea class="col-10" name="description" id="description">{{ old('description') ?? $project->description }}</textarea>
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <div class="row mt-4">
            <div class="col-4">
                <label for="image" class="form-label @error('image') is-invalid @enderror">Carica un' immagine</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-4 ms-5">
                <label for="type_id" class="form-label @error('type_id') is-invalid @enderror">Tipo di stack
                    utilizzato</label>

                {{-- select per passarmi l'ID del type --}}
                <select class="form-select @error('type_id') is-invalid @enderror" name='type_id' id='type_id'
                    aria-label="Default select example">
                    <option value="">Non categorizzato</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id', $project->type_id) == $type->id) selected @endif>
                            {{ $type->type_of_stack }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3">
            <img src="{{ $project->getImageUri() }}" alt="" class="img-fluid my-3" id="image-preview">
            <button type="submit" class="btn btn-primary mb-3">Salva</button>
        </div>

        </form>
    @endsection

    @section('script')
        {{-- script per vedere l'immagine in anteprima prima di salvarla --}}
        <script>
            const imageEl = document.getElementById('image');
            const imagePreviewEl = document.getElementById('image-preview');

            imageEl.addEventListener('change', () => {
                if (imageEl.files && imageEl.files[0]) {
                    const reader = new FileReader();
                    reader.readAsDataURL(imageEl.files[0]);
                    reader.onload = e => {
                        imagePreviewEl.src = e.target.result
                    }
                }
            })
        </script>
    @endsection
