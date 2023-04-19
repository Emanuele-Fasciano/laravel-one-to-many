@extends('layouts.app')

@section('title', 'Crea nuovo progetto')

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
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-5">
                <label for="name" class="form-label">Nome progetto</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
            </div>
            <div class="col-5 mt-3">
                <label for="start_date" class="form-label">Data di inzio</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ old('start_date') }}" />
            </div>
            <div class="col-5 my-3">
                <label for="end_date" class="form-label">Data fine</label>
                <input type="date" class="form-control" id="end_date" name="end_date" alue="{{ old('end_date') }}" />
            </div>
            <label for="description" class="form-label mt-4">Descrizione</label>
            <textarea class="col-10 mb-4" name="description" id="description">{{ old('description') ?? $project->description }}</textarea>
            <div class="row">
                <div class="col-4">
                    <label for="image" class="form-label">Carica un' immagine</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="col-4 ms-5">
                    <label for="type_id" class="form-label">Tipo di stack utilizzato</label>

                    {{-- select per passarmi l'ID del type --}}
                    <select class="form-select" name='type_id' id='type_id' aria-label="Default select example">
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
