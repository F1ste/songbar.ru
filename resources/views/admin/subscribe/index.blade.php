@extends('layouts.admin_layout')

@section('title','Информация о подписке')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="my-4">Управление подпиской</h2>
                <!-- Карточка текущей подписки -->
                <div class="card subscription-card mb-5">
                    @php
                         $userTarif = $activeTarifs->first();
                    @endphp
                    <div class="card-header subscription-header py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Текущая подписка</h5>
                            <span class="badge bg-success subscription-badge">{{ $userTarif->tarif_name }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="subscription-feature">
                                    <i class="fas fa-check feature-icon"></i>
                                    <span>10000 рублей / ежемесячно + применимые налоги</span>
                                </div>
                                <div class="subscription-feature">
                                    <i class="fas fa-calendar-alt feature-icon"></i>
                                    <span>Ваша подписка продлится до {{ \Carbon\Carbon::parse($userTarif->tarif_end)->format('d.m.Y') }} г.</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- <button class="btn btn-primary btn-action">
                                    <i class="fas fa-arrow-up me-2"></i>Улучшить подписку
                                </button> -->
                                <button class="btn btn-outline-danger btn-action">
                                    Отменить подписку
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- История платежей -->
                <!-- <h4 class="mb-4">История платежей</h4>
                <div class="card subscription-card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Сумма</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>3 окт. 2023 г.</td>
                                    <td>$7.99</td>
                                    <td><span class="badge bg-success">Оплачено</span></td>
                                    <td><a href="#" class="text-primary">Чек</a></td>
                                </tr>
                                <tr>
                                    <td>3 сент. 2023 г.</td>
                                    <td>$7.99</td>
                                    <td><span class="badge bg-success">Оплачено</span></td>
                                    <td><a href="#" class="text-primary">Чек</a></td>
                                </tr>
                                <tr>
                                    <td>3 авг. 2023 г.</td>
                                    <td>$7.99</td>
                                    <td><span class="badge bg-success">Оплачено</span></td>
                                    <td><a href="#" class="text-primary">Чек</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
            </div>
        </div>
          
      </div>
    </section>
    <!-- /.content -->
    @endsection