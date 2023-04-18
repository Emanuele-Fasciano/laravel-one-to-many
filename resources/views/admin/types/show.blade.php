@extends('layouts.app')

@section('title', 'Type Details')

@section('content')
    <a href="{{ route('admin.types.index') }}" class="btn btn-primary my-4">Torna alla lista</a>
    <div class="card">
        <div class="card-body my-2">
            <h5 class="card-title my-2"><strong>Nome stack:</strong> {{ $type->type_of_stack }}</h5>
        </div>
    </div>
@endsection
