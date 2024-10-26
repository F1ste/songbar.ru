@extends('layouts.dummy_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="display-4 text-danger">Ошибка платежа</h1>
                    <p class="lead">К сожалению, ваш платеж не был обработан. Пожалуйста, попробуйте еще раз.</p>
                    <a href="{{ route('tarif') }}" class="btn btn-primary mt-3">К тарифам</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection