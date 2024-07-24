@extends('layouts.admin_layout')

@section('title','Каталог')

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
    <section class="content">
      <input type="hidden" value="" name="catalog_id" id="catalog_id">
      <div class="container-fluid">
      <div class="card-body">
            <h4>Добавьте информацию</h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Каталог</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Дизайн</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Информация</a>
              </li>
              
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
              <h5 class="mt-3">Загрузите песни в формате xlsx, csv</h5>
              <p><a href="">Скачать образец</a></p>
              <form action="/songs/import" method="post" enctype="multipart/form-data">
              <p><input id="catalogfile" type="file"></p>
              </form>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <h5 class="mt-3">Общее</h5>
              <div class="row">
              <div class="col-sm-3">
                      <!-- select -->
                      <div class="form-group">
                        <label>Шрифт</label>
                        <select name="font-family" class="form-control">
                          <option>Шрифт 1</option>
                          <option>Шрифт 2</option>
                          <option>Шрифт 3</option>
                          <option>Шрифт 4</option>
                          <option>Шрифт 5</option>
                        </select>
                      </div>
                    </div>
                    
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Фон: цвет</label>

                  <div id="fon" name="color" class="input-group my-colorpicker2">
                    <input type="text" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group" style="text-align:center">
                    <label>Пагинация</label>
                    <div class="input-group" style="justify-content: center">
                    <input type="checkbox" name="pagination" checked data-bootstrap-switch>
                    </div>
                    </div>
                    </div>
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Пагинация цвет</label>

                  <div id="paginationcolor" class="input-group my-colorpicker2">
                    <input type="text" name="pagination-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
              </div>
              <h5 class="mt-3">Поисковая строка</h5>
              <div class="row">
              <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Поисковик фон (цвет)</label>

                  <div id="fonsearch" class="input-group my-colorpicker2">
                    <input type="text" name="search-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                    
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет границы</label>

                  <div id="bordersearch" class="input-group my-colorpicker2">
                    <input type="text" name="search-border-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет шрифта</label>

                  <div id="searchFontColor" class="input-group my-colorpicker2">
                    <input type="text" name="search-font-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                <div class="col-sm-3">
                      <!-- select -->
                      <div class="form-group">
                        <label>Размер шрифта</label>
                        <select name="search-font-size" class="form-control">
                          <option value="10">10px</option>
                          <option value="11">11px</option>
                          <option value="12">12px</option>
                          <option value="13">13px</option>
                          <option value="14">14px</option>
                        </select>
                      </div>
                    </div>
              </div>
              
              <h5 class="mt-3">Результаты поиска</h5>
              <div class="row">
              <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Фон (цвет)</label>

                  <div id="fonsearchresult" class="input-group my-colorpicker2">
                    <input type="text" name="searchres-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                    
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет границы</label>

                  <div id="bordersearchresult" class="input-group my-colorpicker2">
                    <input type="text" name="searchres-border-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет шрифта</label>

                  <div id="searchfontcolorresult" class="input-group my-colorpicker2">
                    <input type="text" name="searchres-font-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                <div class="col-sm-3">
                      <!-- select -->
                      <div class="form-group">
                        <label>Размер шрифта</label>
                        <select name="searchres-font-size" class="form-control">
                          <option value="10">10px</option>
                          <option value="11">11px</option>
                          <option value="12">12px</option>
                          <option value="13">13px</option>
                          <option value="14">14px</option>
                        </select>
                      </div>
                    </div>
              </div>              
              <h5 class="mt-3">Шапка</h5>
              <div class="row">
              <div class="col-md-6">
              
                <h6>Кнопка</h6>
                <div class="row">
                <div class="col-md-6">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет фона</label>

                  <div id="buttonheaderfoncolor" class="input-group my-colorpicker2">
                    <input type="text" name="headbutton-font-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
              
              <div class="col-md-6">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет текста</label>

                  <div id="buttonheadertextcolor" class="input-group my-colorpicker2">
                    <input type="text" name="headbutton-font-size" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                </div>
              </div>
             
              <div class="col-md-4 offset-md-1">
                <h6>Контактная информация</h6>
                <div class="row">
                <div class="col-md-10">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет текста</label>

                  <div id="contactheadertextcolor" class="input-group my-colorpicker2">
                    <input type="text" name="headcontact-font-color" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                </div>
              </div>
              </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
              <div class="row">
              <form class="mt-3 col-md-12" action="">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Логотип(в формате png, svg)</label>
                            <input type="file" name="logo" class="form-control">
                            @if(1==1)
                            <div class="col-md-6">
                            <img src="" alt="">
                            <button type="button" class="btn btn-block btn-danger">Удалить</button>
                            </div>                        
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="form-group">
                            <label>Контактная информация</label>
                            <textarea class="form-control" rows="5" name="contact" id=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Кнопка</label>
                        <div class="row">
                            <div class="col-md-6"><input class="form-control" name="button_text" placeholder="Текст" type="text"></div>
                            <div class="col-md-6"><input class="form-control" name="button_href" placeholder="Ссылка" type="text"></div>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div class="form-group">
                        <label>Наш логотип</label>
                        <div class="row">
                            <input type="checkbox" name="ourlogo" checked data-bootstrap-switch>
                        </div>
                    </div>
                </div>
                </div>       
                
                <button type="submit" class="btn btn-success mt-3">Сохранить</button>
              </form>
              </div>
              </div>
            </div>           
          </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
    @endsection