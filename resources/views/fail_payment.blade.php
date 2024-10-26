@extends('layouts.dummy_layout')

@section('content')
<main class="py-4 d-flex align-items-center" style="min-height: 100%;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="display-5 text-danger">Ошибка платежа</h1>
                        <p class="lead">К сожалению, ваш платеж не был обработан. Пожалуйста, попробуйте еще раз.</p>
                        <a href="https://songbar.ru/home/" class="btn btn-primary mt-3">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection