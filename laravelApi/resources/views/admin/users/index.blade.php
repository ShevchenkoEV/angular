@extends('layout.layout')

@section('content')

    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"> Список пользователей</h3>
        </div>
        <div class="card-body">
            @include('message.message')
            <div class="col-2">
                <a href="{{ route('users.create') }}" class="btn btn-block btn-outline-primary mb-3">Создать
                    пользователя</a>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">email</th>
                    <th scope="col">is_admin</th>
                    <th scope="col">avatar</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin == 1 ? 'admin': 'user' }}</td>
                        <td><img src="{{ $user->getImage() }}" width=80" alt="img"></td>
                        <td>
                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                               class="btn btn-warning btn-sm float-left mr-1">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                        </td>
                        <td>
                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                  method="post" class="float-left">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Подтвердите удаление')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection