@extends('layout.layout')

@section('content')

    <div class="card shadow-lg" >
        <div class="card-header">
            <h3 class="card-title"> Список постов</h3>
        </div>
        <div class="card-body">
            @include('message.message')
            <div class="col-2">
                <a href="{{ route('posts.create') }}" class="btn btn-block btn-outline-primary mb-3">Создать пост</a>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">slug</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Картинка</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td><img src="{{ $post->getImage() }}" width=100" alt="img"></td>
                    <td>
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                           class="btn btn-warning btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}"
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