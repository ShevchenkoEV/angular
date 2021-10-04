<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
<body>

<header class="p-3 bg-dark text-white mt-3 shadow-lg">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                @if(auth()->check() && auth()->user()->is_admin)
                    <li><a href="{{ route('main.page') }}" class="nav-link px-4  text-warning">Main admin page</a></li>
                    <li><a href="{{ route('users.index') }}" class="nav-link px-4  text-white">Users</a></li>
                    <li><a href="{{ route('posts.index') }}" class="nav-link px-4  text-white">Посты</a></li>
                    <li><a href="{{ route('categories.index') }}" class="nav-link px-4  text-white">Категории</a></li>
                @endif
                <li><a href="{{ route('home') }}" class="nav-link px-4">Главная страница</a></li>
            </ul>

            {{--            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">--}}
            {{--                <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">--}}
            {{--            </form>--}}

            <div class="text-end">
                @auth
                    <p>Позователь:  {{auth()->user()->name}}</p>
                    <a class="btn btn-outline-danger me-2" href="{{ route('logout') }}" role="button">Выход</a>
                @else
                    <a class="btn btn-outline-light me-2" href="{{ route('login.create') }}" role="button">Вход</a>
                    <a class="btn btn-warning me-2" href="{{ route('register.create') }}" role="button">Регистрация</a>
                @endauth
{{--                <button type="button" class="btn btn-outline-light me-2">Login</button>--}}
{{--                <button type="button" class="btn btn-warning">Sign-up</button>--}}
            </div>
        </div>
    </div>
</header>

@yield('content')

</body>
</html>
