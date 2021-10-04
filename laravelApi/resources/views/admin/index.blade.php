@extends('layout.layout')

@section('content')

    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"> Main Admin Panel</h3>
        </div>
        <div class="card-body">
            @include('message.message')
            <div class="col-2">
              <p> info server </p>
            </div>

        </div>
    </div>
@endsection