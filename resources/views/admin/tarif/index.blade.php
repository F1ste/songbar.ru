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
              @php
                  $allTarifs = [
                      ['name' => 'Lite', 'price' => 5000, 'description' => 'Lite/Месяц'],
                      ['name' => 'Medium', 'price' => 10000, 'description' => 'Medium/Месяц'],
                      ['name' => 'VIP', 'price' => 15000, 'description' => 'Vip/Месяц']
                  ];
              @endphp

              <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                      <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                          <div class="col-md-12">
                              <div class="row">
                                  @foreach ($allTarifs as $tarif)
                                      @php
                                          $userTarif = $activeTarifs->firstWhere('tarif_name', strtolower($tarif['name']));
                                      @endphp

                                      <div class="order">
                                          <p class="title">{{ $tarif['name'] }}</p>
                                          <p class="priсe">{{ $tarif['price'] }} рублей/мес</p>
                                          @if ($userTarif)
                                              <button type="button" class="btn btn-block btn-secondary btn-sm" disabled>
                                                  Активен до {{ \Carbon\Carbon::parse($userTarif->tarif_end)->format('d.m.Y') }}
                                              </button>
                                          @else
                                              <form action="{{ route('order.create') }}" method="post">
                                                  @csrf
                                                  <input type="hidden" name="amount" value="{{ $tarif['price'] }}">
                                                  <input type="hidden" name="description" value="{{ $tarif['description'] }}">
                                                  <button type="submit" class="btn btn-block btn-warning btn-sm">Оплатить</button>
                                              </form>
                                          @endif
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                          <p class="description">При оплате за год, 1 месяц обслуживания БЕСПЛАТНО</p>
                      </div>

                      <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                          <div class="col-md-12">
                              <div class="row">
                                  @foreach ($allTarifs as $tarif)
                                      @php
                                          $userTarif = $activeTarifs->firstWhere('tarif_name', strtolower($tarif['name']));
                                      @endphp

                                      <div class="order">
                                          <p class="title">{{ $tarif['name'] }}</p>
                                          <p class="priсe">{{ $tarif['price'] }} рублей/мес</p>

                                          @if ($userTarif)
                                              <button type="button" class="btn btn-block btn-secondary btn-sm" disabled>
                                                  Активен до {{ \Carbon\Carbon::parse($userTarif->tarif_end)->format('d.m.Y') }}
                                              </button>
                                          @else
                                              <form action="{{ route('order.create') }}" method="post">
                                                  @csrf
                                                  <input type="hidden" name="amount" value="{{ $tarif['price'] * 12 }}">
                                                  <input type="hidden" name="description" value="{{ $tarif['description'] }}/12Месяц">
                                                  <button type="submit" class="btn btn-block btn-warning btn-sm">Оплатить</button>
                                              </form>
                                          @endif
                                      </div>
                                  @endforeach
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