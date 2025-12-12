@extends('layout')
@section('content')
    <h1>Креирај Нов Организатор</h1>
    <form method="POST" action="{{ route('organizers.store') }}">
        @csrf
        <div>
            <label for="full_name">Име и Презиме:</label>
            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}">
            @error('full_name')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phone_number">Телефонски Број:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
            @error('phone_number')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Креирај Организатор</button>
    </form>
    <a href="{{ route('organizers.index') }}">Назад кон Организатори</a>
@endsection
