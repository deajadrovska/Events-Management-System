@extends('layout')
@section('content')
    <h1>Детали за Организатор</h1>
    <div>
        <strong>Име и Презиме:</strong> {{ $organizer->full_name }}
    </div>
    <div>
        <strong>Email:</strong> {{ $organizer->email }}
    </div>
    <div>
        <strong>Телефонски Број:</strong> {{ $organizer->phone_number }}
    </div>

    <h2>Настани на овој Организатор</h2>
    @if($organizer->events->count() > 0)
        <table border="1">
            <thead>
            <tr>
                <th>Име на Настан</th>
                <th>Датум</th>
                <th>Тип</th>
                <th>Акции</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organizer->events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->date->format('d.m.Y') }}</td>
                    <td>{{ ucfirst($event->type->value) }}</td>
                    <td>
                        <a href="{{ route('events.show', $event->id) }}">Прегледај</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Овој организатор нема креирано настани.</p>
    @endif

    <a href="{{ route('organizers.index') }}">Назад кон Организатори</a>
@endsection
