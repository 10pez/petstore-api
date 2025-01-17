@extends('layouts.layout')

@section('title', 'Szczegóły Zwierzęcia')

@section('content')
    <div class="container">
        <h1>Szczegóły Zwierzęcia</h1>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $pet['id'] }}</td>
            </tr>
            <tr>
                <th>Nazwa</th>
                <td>{{ $pet['name'] ?? 'Brak nazwy' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $pet['status'] }}</td>
            </tr>
            <tr>
                <th>Kategoria</th>
                <td>{{ $pet['category']['name'] ?? 'Brak kategorii' }}</td>
            </tr>
            <tr>
                <th>Tagi</th>
                <td>
                    @if (!empty($pet['tags']))
                        <ul>
                            @foreach ($pet['tags'] as $tag)
                                <li>{{ $tag['name'] }}</li>
                            @endforeach
                        </ul>
                    @else
                        Brak tagów
                    @endif
                </td>
            </tr>
            <tr>
                <th>Zdjęcia</th>
                <td>
                    @if (!empty($pet['photoUrls']))
                        @foreach ($pet['photoUrls'] as $url)
                            <img src="{{ $url }}" alt="Zdjęcie zwierzęcia" class="img-thumbnail" width="150">
                        @endforeach
                    @else
                        Brak zdjęć
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('pets.index') }}" class="btn btn-secondary">Powrót do listy</a>
        <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-warning">Edytuj</a>
        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Usuń</button>
        </form>
    </div>
@endsection
