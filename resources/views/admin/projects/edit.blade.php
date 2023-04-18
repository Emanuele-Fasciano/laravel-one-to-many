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
            <div class="col-5">
                <label for="programming_languages_used" class="form-label">Linguaggi utilizzati</label>
                <input type="text" class="form-control" id="programming_languages_used" name="programming_languages_used"
                    value="{{ old('programming_languages_used') ?? $project->programming_languages_used }}" />
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
            <textarea class="col-10 my-3 ms-3" name="description" id="description" placeholder="Descrizione">{{ old('description') ?? $project->description }}</textarea>
            <div class="col-4">
                <input type="file" name="image" id="image" class="form-control">
                <img src="{{ $project->getImageUri() }}" alt="" class=" my-3" id="image-preview">
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
