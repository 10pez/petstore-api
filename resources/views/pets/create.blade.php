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
            <div class="form-group">
                <label for="name">Nazwa:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="available">Dostępne</option>
                    <option value="pending">Oczekujące</option>
                    <option value="sold">Sprzedane</option>
                </select>
            </div>

            <div class="form-group">
                <label for="category">Kategoria:</label>
                <input type="text" id="category" name="category" class="form-control">
            </div>

            <div class="form-group">
                <label for="photoUrls">Adresy URL zdjęć (oddzielone przecinkami):</label>
                <input type="text" name="photoUrls" id="photoUrls" class="form-control">
            </div>

            <div class="form-group">
                <label for="tags">Tagi (oddzielone przecinkami):</label>
                <input type="text" name="tags" id="tags" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Dodaj zwierzę</button>
        </form>

    </div>
@endsection
