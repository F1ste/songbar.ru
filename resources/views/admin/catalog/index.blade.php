@extends('layouts.admin_layout')

@section('title', 'Список каталогов')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@yield('title')</h1>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{route('catalog.create')}}" class="btn bg-gradient-info btn-block btn-flat"><i
                        class="fa fa-book"></i> Создать Каталог</a><br>
            </div>

        </div>
        @if($catalogs->count() == 0)
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('tarif')}}" class="btn bg-gradient-warning btn-block btn-flat"><i
                            class="fa fa-book"></i> Пример Каталогов</a>
                </div>
            </div>
        @else           
        <div class="card mt-3">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Адрес
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catalogs as $catalog)
                                <tr>
                                    <td>
                                        <a href="https://{{ $catalog->address }}.songbar.ru" target="_blank">
                                            {{ $catalog->address }}.songbar.ru
                                        </a>
                                        @if ($catalog->is_published)
                                            <span class="text-success">(Опубликован)</span>
                                        @else
                                            <span class="text-danger">(Не опубликован)</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        @if($catalog->qr_code_path)
                                            <a href="{{ asset($catalog->qr_code_path) }}" download class="btn btn-secondary btn-sm">
                                                <i class="fas fa-download"></i> Скачать QR-код
                                            </a>
                                        @endif

                                        <a class="btn btn-info btn-sm" href="{{ route('catalog.edit', $catalog->id) }}">
                                            <i class="fas fa-pencil-alt"></i> Редактировать
                                        </a>

                                        <form style="display:inline-block" action="{{ route('catalog.destroy', $catalog->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash"></i> Удалить
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endif
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection