@extends('layouts.admin_layout')

@section('title','Тарифы')

@section('content')
<!-- Content Header (Page header) -->
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

    <!-- Main content -->
    <section class="content" id="tarif">
      <div class="row">
          <div class="col-md-8 offset-md-2 col-sm-6">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">1 месяц</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">12 месяцев</a>
                  </li>                               
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                     <div class="col-md-12">
                     <div class="row">
                        <div class="order">
                            <p class="title">Lite</p>
                            <p class="priсe">5000 рублей/мес</p>
                            <form action="{{ route('order.create') }}" method="post">
                              @csrf
                              <input type="hidden" name="amount" value="1.51">
                              <input type="hidden" name="description" value="Lite/Месяц">
                              <button type="submit" class="btn btn-block btn-warning btn-sm">Оплатить</button>
                            </form>
                           
                        </div>
                        <div class="order">
                            <p class="title">Medium</p>
                            <p class="priсe">10000 рублей/мес</p>
                            <button type="button" class="btn btn-block btn-warning btn-sm">Активен до 29.03.2024</button>
                        </div>                        
                        <div class="order">
                            <p class="title">VIP</p>
                            <p class="priсe">15000 рублей/мес</p>
                            <button type="button" class="btn btn-block btn-warning btn-sm">Выбрать</button>
                        </div>
                        </div>
                     </div>
                     <p class="description">При оплате за год, 1 месяц обслуживания БЕСПЛАТНО</p>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <div class="col-md-12">
                     <div class="row">
                        <div class="order">
                            <p class="title">Lite</p>
                            <p class="priсe">5000 рублей/мес</p>
                            <a type="button" href="" class="btn btn-block btn-warning btn-sm">Оплатить</a>
                        </div>
                        <div class="order">
                            <p class="title">Medium</p>
                            <p class="priсe">10000 рублей/мес</p>
                            <button type="button" class="btn btn-block btn-warning btn-sm">Активен до 29.03.2024</button>
                        </div>                        
                        <div class="order">
                            <p class="title">VIP</p>
                            <p class="priсe">15000 рублей/мес</p>
                            <button type="button" class="btn btn-block btn-warning btn-sm">Выбрать</button>
                        </div>
                        </div>
                     </div>
                     <p class="description">При оплате за год, 1 месяц обслуживания БЕСПЛАТНО</p>
                  </div>                  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          
      </div>
    </section>
    <!-- /.content -->
    @endsection