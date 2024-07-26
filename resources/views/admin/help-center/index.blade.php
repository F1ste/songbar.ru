@extends('layouts.admin_layout')

@section('title', 'Справочный центр')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@yield('title')</h1>
            </div><!-- /.col -->
            <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>-->
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="container">
    <div class="container-fluid" id="accordion">
        <div class="card">
            <div class="card-header" id="heading_1" data-toggle="collapse" data-target="#collapse_1"
                aria-expanded="true" aria-controls="collapse_1" role="button">
                <h5 class="mb-0">
                    <span class="btn-link">
                        Как я могу зарегистрироваться?
                    </span>
                </h5>
            </div>
            <div id="collapse_1" class="collapse" aria-labelledby="heading_1">
                <div class="card-body">
                    <span>Вы можете зарегистрироваться, перейдя по ссылке регистрации на главной странице и заполнив
                        необходимые
                        поля.</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="heading_2" data-toggle="collapse" data-target="#collapse_2"
                aria-expanded="false" aria-controls="collapse_2" role="button">
                <h5 class="mb-0">
                    <span class="btn-link">
                        Как я могу изменить пароль?
                    </span>
                </h5>
            </div>
            <div id="collapse_2" class="collapse" aria-labelledby="heading_2">
                <div class="card-body">
                    <span>Для изменения пароля перейдите в настройки профиля и следуйте инструкциям по смене
                        пароля.</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="heading_3" data-toggle="collapse" data-target="#collapse_3"
                aria-expanded="false" aria-controls="collapse_3" role="button">
                <h5 class="mb-0">
                    <span class="btn-link">
                        Как я могу связаться с поддержкой?
                    </span>
                </h5>
            </div>
            <div id="collapse_3" class="collapse" aria-labelledby="heading_3">
                <div class="card-body">
                    <span>Вы можете связаться с поддержкой, используя контактную форму на странице "Контакты".</span>
                </div>
            </div>
        </div>
    </div>

</section>
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- TODO добавить ссылку на ТГ -->
                <a href="#" class="btn btn-primary" target="_blank">Поддержка</a>
            </div>
        </div>
    </div>
</div>

@endsection