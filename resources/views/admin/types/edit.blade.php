@extends('layouts.app')

@section('title', 'Modifica progetto')

@section('content')
    <a class="btn btn-primary my-4" href="{{ route('admin.types.index') }}">Torna alla lista</a>
    <form action="{{ route('admin.types.update', $type) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-5">
                <label for="type_of_stack" class="form-label">Nome stack:</label>
                <input type="text" class="form-control" id="type_of_stack" name="type_of_stack"
                    value="{{ old('type_of_stack') ?? $type->type_of_stack }}" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salva</button>
    </form>
@endsection

{{-- @section('script') --}}
{{-- script per vedere l'immagine in anteprima prima di modificarla --}}
{{-- <script>
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
@endsection --}}
