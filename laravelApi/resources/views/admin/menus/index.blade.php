@extends('layout.layout')

@section('content')

    <div class="card shadow-lg" >
        <div class="card-header">
            <h3 class="card-title"> Список меню</h3>
        </div>
        <div class="card-body">
            @include('message.message')
            <div class="col-2">
                <a href="{{ route('menus.create') }}" class="btn btn-block btn-outline-primary mb-3">Создать пункт меню</a>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">path</th>
                    <th scope="col">path_api</th>
                    <th scope="col">type</th>
                    <th scope="col">сортировка</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $menu)
                <tr>
                    <th scope="row">{{ $menu->id}}</th>
                    <td>{{ $menu->title}}</td>
                    <td>{{ $menu->path }}</td>
                    <td>{{ $menu->path_api }}</td>
                    <td>{{ $menu->type }}</td>
                    <td>{{ $menu->sort_order }}</td>

                    <td>
                        <a href="{{ route('menus.edit', ['menu' => $menu->id]) }}"
                           class="btn btn-warning btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('menus.destroy', ['menu' => $menu->id]) }}"
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