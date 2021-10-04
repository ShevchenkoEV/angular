@extends('layout.layout')

@section('navigation')

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            @foreach($menus as $menu)

                <li><a href="#">{{$menu->title}}</a></li>

            @endforeach

{{--                <li><a href="{{ route('main.page') }}" class="nav-link px-4  text-warning">Main admin page</a></li>--}}
{{--                <li><a href="{{ route('users.index') }}" class="nav-link px-4  text-white">Users</a></li>--}}
{{--                <li><a href="{{ route('posts.index') }}" class="nav-link px-4  text-white">Посты</a></li>--}}
{{--                <li><a href="{{ route('categories.index') }}" class="nav-link px-4  text-white">Категории</a></li>--}}
{{--                <li><a href="{{ route('menus.index') }}" class="nav-link px-4  text-white">Меню</a></li>--}}
{{--            <li><a href="{{ route('home') }}" class="nav-link px-4  text-white">Главная страница</a></li>--}}
        </ul>



{{--    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">--}}
{{--        @if(auth()->check() && auth()->user()->is_admin)--}}
{{--            <li><a href="{{ route('main.page') }}" class="nav-link px-4  text-warning">Main admin page</a></li>--}}
{{--            <li><a href="{{ route('users.index') }}" class="nav-link px-4  text-white">Users</a></li>--}}
{{--            <li><a href="{{ route('posts.index') }}" class="nav-link px-4  text-white">Посты</a></li>--}}
{{--            <li><a href="{{ route('categories.index') }}" class="nav-link px-4  text-white">Категории</a></li>--}}
{{--            <li><a href="{{ route('menus.index') }}" class="nav-link px-4  text-white">Меню</a></li>--}}
{{--        @endif--}}
{{--        <li><a href="{{ route('home') }}" class="nav-link px-4  text-white">Главная страница</a></li>--}}
{{--    </ul>--}}


@endsection
