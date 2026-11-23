<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        .aviso-ok    { border-left: 6px solid #2f7d52; }
        .aviso-error { border-left: 6px solid #b3261e; }
        .acciones    { display: flex; gap: 1rem; align-items: center; }
    </style>
</head>
<body>
    <header class="container">
        <nav>
            <ul><li><strong>{{ config('app.name') }}</strong></li></ul>
            <ul>
                <li><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
                <li><a href="#">Pacientes</a></li>
                <li><a href="#">Personal médico</a></li>
                <li><a href="#">Citas</a></li>
                <li><a href="#">Atenciones</a></li>
            </ul>
        </nav>
    </header>
 
    <main class="container">
        @if (session('ok'))
            <article class="aviso-ok">{{ session('ok') }}</article>
        @endif
        @if (session('error'))
            <article class="aviso-error">{{ session('error') }}</article>
        @endif

        @yield('contenido')
    </main>
 
    <footer class="container">
        <small>DSI406 · Tecnología Backend · IES Túpac Amaru</small>
    </footer>
</body>
</html>