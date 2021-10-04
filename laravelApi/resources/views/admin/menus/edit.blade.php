@extends('layout.layout')

@section('content')

    <div class="card col-9 shadow-lg">

        <div class="card-header">
            <h3 class="card-title">Редактирование меню</h3>
        </div>
        <form method="post" action="{{ route('menus.update', ['menu' => $menu->id]) }}" class="row g-3 p-4" enctype="multipart/form-data">
            @csrf
            @method('patch')
            @include('message.message')

            <div class="col-12">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $menu->title }}">
            </div>

            <div class="col-12">
                <label for="path" class="form-label">Путь</label>
                <input type="text" class="form-control" id="path" name="path" value="{{ $menu->path }}">
            </div>

            <div class="col-12">
                <label for="path_api" class="form-label">Путь для API</label>
                <input type="text" class="form-control" id="path_api" name="path_api" value="{{ $menu->path_api }}">
            </div>

            <div class="col-12">
                <label for="type" class="form-label">Тип</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ $menu->type }}">
            </div>

            <div class="col-12">
                <label for="sort_order" class="form-label">сортировка</label>
                <input type="text" class="form-control" id="sort_order" name="sort_order" value="{{ $menu->sort_order }}">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>

@endsection
