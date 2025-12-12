@extends('layout')
@section('content')
    <h1>Организатори</h1>
    <a href="{{ route('organizers.create') }}">
        <button>Креирај Организатор</button>
    </a>
    <table border="1">
        <thead>
        <tr>
            <th>Име и Презиме</th>
            <th>Email</th>
            <th>Телефонски Број</th>
            <th>Акции</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($organizers as $organizer)
            <tr>
                <td>{{ $organizer->full_name }}</td>
                <td>{{ $organizer->email }}</td>
                <td>{{ $organizer->phone_number }}</td>
                <td>
                    <a href="{{ route('organizers.show', $organizer->id) }}">Прегледај</a>
                    <a href="{{ route('organizers.edit', $organizer->id) }}">Уреди</a>
                    <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Дали сте сигурни дека сакате да го избришете овој организатор?')">
                            Избриши
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $organizers->links() }}
@endsection
