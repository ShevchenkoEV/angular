@extends('layout.layout')

@section('content')

    <div class="card col-9 shadow-lg">

        <div class="card-header">
            <h3 class="card-title">Создание категории</h3>
        </div>
        <form method="post" action="{{ route('categories.store') }}" class="row g-3 p-4" enctype="multipart/form-data">
            @csrf
            @include('message.message')
            <div class="col-12">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>

@endsection