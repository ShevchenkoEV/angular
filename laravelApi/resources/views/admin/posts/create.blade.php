@extends('layout.layout')

@section('content')

    <div class="card col-9 shadow-lg">

        <div class="card-header">
            <h3 class="card-title">Создание поста</h3>
        </div>
        <form method="post" action="{{ route('posts.store') }}" class="row g-3 p-4" enctype="multipart/form-data">
            @csrf
            @include('message.message')
            <div class="col-12">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="title" value="{{ old('name') }}">
            </div>

            <div class="col-12">
                <label for="category_id">Категория</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $categoryId => $categoryTitle)
                        <option value="{{ $categoryId }}"> {{ $categoryTitle }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="content" class="form-label">Контент</label>
                <textarea class="form-control" name="content" id="content" rows="3" >{{ old('content') }}</textarea>
            </div>

            <div class="col-12">
                <label for="image">Изображение</label>
                <div class="custom-file">
                    <input type="file" class="form-control" id="image" name="image"
                           aria-label="file example">
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>

@endsection