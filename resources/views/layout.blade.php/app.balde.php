<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KostFinder</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>KostFinder</h1>
        <nav>
            <a href="/">Beranda</a> |
            <a href="/kost">Daftar Kost</a> |
            <a href="/login">Login</a>
        </nav>
    </header>
    <hr>
    <main>
        @yield('content')
    </main>
</body>
</html>
