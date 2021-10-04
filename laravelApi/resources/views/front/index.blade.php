@extends('layout.layout')

@section('content')
    <main>

        <section class="py-2 text-center container">
            <div class="row py-lg-3">
                <div class="col-lg-6 col-md-8 mx-auto">
                    @include('message.message')
                    <h1 class="fw-light">Посты</h1>

                </div>
            </div>
        </section>

        <div>
            <div class="container">
                <div class="row mb-4">
                    @foreach($posts as $post)
                        <div class="card mx-2 my-2 shadow-lg" style="width: 400px; ">
                            <img src="{{ $post->getImage() }}" class="card-img-top mt-2" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <h3 class="text-success">Категория: {{ $post->category->title }}</h3></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </main>
@endsection