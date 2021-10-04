<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>
<header class="p-3 bg-dark text-white mt-3 shadow-lg">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            @include('layout.navigation')

            <div class="text-end">
                @auth
                    <p>Позователь:  {{auth()->user()->name}}</p>
                    <a class="btn btn-outline-danger me-2" href="{{ route('logout') }}" role="button">Выход</a>
                @else
                    <a class="btn btn-outline-light me-2" href="{{ route('login.create') }}" role="button">Вход</a>
                    <a class="btn btn-warning me-2" href="{{ route('register.create') }}" role="button">Регистрация</a>
                @endauth
            </div>
        </div>
    </div>
</header>
<div class="container py-2 mt-3 mx-auto ">

    @yield('content')

</div>
</body>
</html>