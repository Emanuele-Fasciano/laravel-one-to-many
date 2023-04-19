@extends('layouts.app')

@section('title', 'Modifica progetto')

@section('content')
    <a class="btn btn-primary my-4" href="{{ route('admin.projects.index') }}">Torna alla lista</a>
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-5">
                <label for="name" class="form-label">Nome progetto</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name') ?? $project->name }}" />
            </div>
            <div class="col-5 mt-3">
                <label for="start_date" class="form-label">Data di inzio</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ old('start_date') ?? $project->start_date }}" />
            </div>
            <div class="col-5 mt-3">
                <label for="end_date" class="form-label">Data fine</label>
                <input type="date" class="form-control" id="end_date" name="end_date"
                    value="{{ old('end_date') ?? $project->end_date }}" />
            </div>
            <label for="description" class="form-label mt-4">Descrizione</label>
            <textarea class="col-10 mb-4 ms-3" name="description" id="description" placeholder="Descrizione">{{ old('description') ?? $project->description }}</textarea>
            <div class="row">
                <div class="col-4">
                    <label for="image" class="form-label">Carica un' immagine</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <div class="col-3">
                        <img src="{{ $project->getImageUri() }}" alt="" class="img-fluid my-3" id="image-preview">
                    </div>
                </div>
                <div class="col-4 ms-5">
                    <label for="type_id" class="form-label">Tipo di stack utilizzato</label>
                    <select class="form-select" name='type_id' id='type_id' aria-label="Default select example">
                        <option value="">Non categorizzato</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if (old('type_id', $project->type_id) == $type->id) selected @endif>
                                {{ $type->type_of_stack }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salva</button>
    </form>
@endsection

@section('script')
    {{-- script per vedere l'immagine in anteprima prima di modificarla --}}
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
