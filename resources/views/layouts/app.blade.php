<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/globalStyle.css')
    <title>G Trigueiro</title>
</head>
<body>
    <nav class="navbar">
        <ul class="main-menu">
            @auth
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="{{ route("records") }}">Registros</a>
            </li>
            @endauth
        </ul>
        <ul class="secondary-menu">
            @auth
            <li>
                <a class="username" href="">
                    <ion-icon class="person-icon" name="person"></ion-icon>{{ auth()->user()->name }}
                </a>
            </li>
            <li>
                <form action="{{ route("logout") }}" method="post">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            </li>
            @endauth
            @guest
            <li>
                <a href="{{ route("signin") }}">Entrar</a>
            </li>
            <li>
                <a href="{{ route("register") }}">Cadastrar</a>
            </li>
            @endguest
        </ul>
    </nav>

    @yield("content")
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
