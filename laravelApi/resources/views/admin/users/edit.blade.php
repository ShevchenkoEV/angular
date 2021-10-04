@extends('layout.layout')

@section('content')

    <div class="card col-9 shadow-lg">

        <div class="card-header">
            <h3 class="card-title">Изменение пользователя</h3>
        </div>
        <form method="post" action="{{ route('users.update', ['user' => $user->id]) }}" class="row g-3 p-4" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('message.message')
            <div class="col-12">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>

            <div class="col-12">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="col-12">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="col-12">
                <label for="password_confirmation" class="form-label">Повторите пароль</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
            </div>

            <div class="col-12">
                <label for="avatar">Аватар</label>
                <div class="custom-file">
                    <input type="file" class="form-control" id="avatar" name="avatar"
                           aria-label="file example">
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>

@endsection
