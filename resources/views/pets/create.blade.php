@extends('layouts.layout')

@section('title', 'Dodaj Nowe Zwierzę')

@section('content')
    <div class="container">
        <h1>Dodaj Nowe Zwierzę</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pets.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nazwa Zwierzęcia</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="" disabled selected>Wybierz status</option>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Dostępne</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Oczekujące</option>
                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sprzedane</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategoria</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}">
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tagi (oddzielone przecinkami)</label>
                <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags') }}">
            </div>

            <div class="mb-3">
                <label for="photoUrls" class="form-label">URL Zdjęcia (oddzielone przecinkami)</label>
                <input type="text" name="photoUrls" id="photoUrls" class="form-control" value="{{ old('photoUrls') }}">
            </div>

            <button type="submit" class="btn btn-success">Zapisz</button>
            <a href="{{ route('pets.index') }}" class="btn btn-secondary">Anuluj</a>
        </form>
    </div>
@endsection
