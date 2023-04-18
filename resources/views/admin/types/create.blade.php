@extends('layouts.app')

@section('title', 'Crea nuovo tipo di stack')

@section('content')
    <a class="btn btn-primary my-4" href="{{ route('admin.types.index') }}">Torna alla lista</a>
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
    <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-5">
                <label for="type_of_stack" class="form-label">Nome stack</label>
                <input type="text" class="form-control" id="type_of_stack" name="type_of_stack"
                    value="{{ old('type_of_stack') }}" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary my-3">Salva</button>
    </form>
@endsection
{{-- 
@section('script')
    {{-- script per vedere l'immagine in anteprima prima di salvarla --}}
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
