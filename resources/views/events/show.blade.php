@extends('layout')
@section('content')
    <h1>Детали за Настан</h1>
    <div>
        <strong>Име на Настан:</strong> {{ $event->name }}
    </div>
    <div>
        <strong>Опис:</strong> {{ $event->description }}
    </div>
    <div>
        <strong>Датум:</strong> {{ $event->date->format('d.m.Y') }}
    </div>
    <div>
        <strong>Тип:</strong> {{ ucfirst($event->type->value) }}
    </div>
    <div>
        <strong>Организатор:</strong>
        <a href="{{ route('organizers.show', $event->organizer->id) }}">
            {{ $event->organizer->full_name }}
        </a>
    </div>
    <div>
        <strong>Email на Организатор:</strong> {{ $event->organizer->email }}
    </div>
    <div>
        <strong>Телефон на Организатор:</strong> {{ $event->organizer->phone_number }}
    </div>
    <a href="{{ route('events.index') }}">Назад кон Настани</a>
@endsection
