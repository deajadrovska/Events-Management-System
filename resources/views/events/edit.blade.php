@extends('layout')
@section('content')
    <h1>Уреди Настан</h1>
    <form method="POST" action="{{ route('events.update', $event->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Име на Настан:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}">
            @error('name')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Опис:</label>
            <textarea name="description" id="description" rows="5">{{ old('description', $event->description) }}</textarea>
            @error('description')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="date">Датум:</label>
            <input type="date" name="date" id="date" value="{{ old('date', $event->date->format('Y-m-d')) }}">
            @error('date')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="type">Тип на Настан:</label>
            <select name="type" id="type">
                <option value="">Избери Тип</option>
                @foreach(\App\Enums\EventTypeEnum::cases() as $type)
                    <option value="{{ $type->value }}" {{ old('type', $event->type->value) == $type->value ? 'selected' : '' }}>
                        {{ ucfirst($type->value) }}
                    </option>
                @endforeach
            </select>
            @error('type')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="organizer_id">Организатор:</label>
            <select name="organizer_id" id="organizer_id">
                <option value="">Избери Организатор</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ old('organizer_id', $event->organizer_id) == $organizer->id ? 'selected' : '' }}>
                        {{ $organizer->full_name }}
                    </option>
                @endforeach
            </select>
            @error('organizer_id')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Ажурирај Настан</button>
    </form>
    <a href="{{ route('events.index') }}">Назад кон Настани</a>
@endsection
