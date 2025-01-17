@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Lista Zwierząt</h1>
        <a href="{{ route('pets.create') }}" class="btn btn-primary">Dodaj Nowe Zwierzę</a>

        @if (!empty($pets))
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Status</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pets as $pet)
                        <tr>
                            <td>{{ $pet['id'] }}</td>
                            <td>{{ $pet['name'] ?? 'Brak nazwy' }}</td>
                            <td>{{ $pet['status'] }}</td>
                            <td>
                                <a href="{{ route('pets.show', $pet['id']) }}" class="btn btn-info btn-sm">Szczegóły</a>
                                <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-4">Brak dostępnych zwierząt.</p>
        @endif
    </div>
@endsection
