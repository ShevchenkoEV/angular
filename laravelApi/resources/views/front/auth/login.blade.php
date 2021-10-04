@extends('layout.layout')

@section('content')

    <main>
        <div class="container">
            <div class="mx-5 mt-5">
                <div class="card shadow-lg" style="width: 25rem;">
                    <div class="card-body">
                        @include('message.message')
                        <h5 class="card-title mb-3">Вход пользоваателя</h5>

                        <form action="{{ route('login') }} " method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                            </div>

                            <div class="row">
                                <div >
                                    <button type="submit" class="btn btn-primary btn-block">Вход пользователя</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
