@extends('layout')
@section('content')
    <h1>Настани</h1>
    <form method="GET" action="{{ route('events.index') }}">
        <div>
            <label for="search">Пребарај по Име:</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Внеси име на настан...">
        </div>
{{--        <label for="type">Филтрирај по Тип:</label>--}}
{{--        <select name="type" id="type">--}}
{{--            <option value="">Сите</option>--}}
{{--            @foreach(\App\Enums\EventTypeEnum::cases() as $type)--}}
{{--                <option value="{{ $type->value }}" {{ request('type') == $type->value ? 'selected' : '' }}>--}}
{{--                    {{ ucfirst($type->value) }}--}}
{{--                </option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
        <button type="submit">Филтрирај</button>
    </form>
    <a href="{{ route('events.create') }}">
        <button>Креирај Настан</button>
    </a>
    <table border="1">
        <thead>
        <tr>
            <th>Име на Настан</th>
            <th>Организатор</th>
            <th>Датум</th>
            <th>Тип</th>
            <th>Акции</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>
                    <a href="{{ route('organizers.show', $event->organizer->id) }}">
                        {{ $event->organizer->full_name }}
                    </a>
                </td>
                <td>{{ $event->date->format('d.m.Y') }}</td>
                <td>{{ ucfirst($event->type->value) }}</td>
                <td>
                    <a href="{{ route('events.show', $event->id) }}">Прегледај</a>
                    <a href="{{ route('events.edit', $event->id) }}">Уреди</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Дали сте сигурни дека сакате да го избришете овој настан?')">
                            Избриши
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $events->appends(request()->query())->links() }}
@endsection
