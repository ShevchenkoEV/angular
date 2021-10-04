@extends('layout.layout')

@section('content')

    <div class="card col-9 shadow-lg">

        <div class="card-header">
            <h3 class="card-title">Редактирование поста</h3>
        </div>
        <form method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" class="row g-3 p-4" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('message.message')
            <div class="col-12">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="title" value="{{ $post->title }}">
            </div>

            <div class="col-12">
                <label for="category_id">Категория</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $categoryId => $categoryTitle)
                        <option value="{{ $categoryId }}"
                                @if ($categoryId == $post->category_id)
                                selected
                                @endif>
                            {{ $categoryTitle }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="content" class="form-label">Контент</label>
                <textarea class="form-control" name="content" id="content" rows="3" >{{ $post->content }}</textarea>
            </div>

            <div class="col-12">
                <label for="image">Изображение</label>
                <div class="custom-file">
                    <input type="file" class="form-control" id="image" name="image"
                           aria-label="file example">
                </div>
                <div>
                    <img src="{{ $post->getImage()}}" class="img-thumbnail mt-2" alt="image" width="200px">
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>

@endsection