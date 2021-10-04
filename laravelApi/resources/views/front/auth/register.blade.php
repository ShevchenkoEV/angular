@extends('layout.layout')

@section('content')

    <main>
        <div class="container">
            <div class="mx-5 mt-5">
                <div class="card shadow-lg" style="width: 25rem;">
                    <div class="card-body">
                        @include('message.message')
                        <h5 class="card-title mb-3">Вход пользоваателя</h5>

                        <form action="{{ route('register') }} " method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Имя</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Имя" value="{{ old('name') }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Повторить пароль</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation" placeholder="Повторить пароль">
                            </div>
                            <div class="row">
                                <div class="col-6 offset-6">
                                    <button type="submit" class="btn btn-primary btn-block">Регистрация</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                        <p class="mt-3">
                            <a href="{{ route('login') }}" class="text-center">Я уже зарегистрирован</a>
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
