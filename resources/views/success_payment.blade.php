@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="display-4 text-success">Платеж прошел успешно!</h1>
                    <p class="lead">Спасибо за ваш платеж. Ваш заказ был успешно обработан.</p>
                    <a href="{{ route('catalogs') }}" class="btn btn-primary mt-3">К каталогам</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection