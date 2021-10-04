@extends('layout.layout')

@section('content')

    <div class="card shadow-lg" >
        <div class="card-header">
            <h3 class="card-title"> Список категорий</h3>
        </div>
        <div class="card-body">
            @include('message.message')
            <div class="col-2">
                <a href="{{ route('categories.create') }}" class="btn btn-block btn-outline-primary mb-3">Создать категорию</a>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">slug</th>
                    <th scope="col">Связи с постом</th>
                    <th scope="col">edit</th>
                    <th scope="col">delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id}}</th>
                    <td>{{ $category->title}}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        @if($category->posts->count() > 0 )
                        @foreach($category->posts as $post)
                            {{ $post->title }}
                        @endforeach
                        @else нет связей
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                           class="btn btn-warning btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
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