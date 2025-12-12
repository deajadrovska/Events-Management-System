<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Систем за Настани</title>
</head>
<body>
<header>
    <h1>Систем за Настани и Организатори</h1>
    <nav>
        <ul>
            <li><a href="{{ route('organizers.index') }}">Организатори</a></li>
            <li><a href="{{ route('events.index') }}">Настани</a></li>
        </ul>
    </nav>
</header>
<main>
    @if(session('success'))
        <div style="color: green; padding: 10px; border: 1px solid green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>
