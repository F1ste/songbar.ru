@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="display-4 text-muted">Каталог временно недоступен</h1>
                    <p class="lead">Этот каталог еще не опубликован. Пожалуйста, вернитесь позже.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary mt-3">На главную</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection