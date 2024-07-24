@extends('layouts.admin_layout')

@section('title','Каталог')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" value="{{$catalog->id}}" id="catalog_id">
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
      <div class="container-fluid row">
      <div class="card-body col-md-8">

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
              <form id="importExcell" enctype="multipart/form-data">
              <p><input type="file" id="excellfile" name="file" required></p>
              <button type="submit">Загрузить</button>
              </form>
              <div id="progress-bar" style="width: 100%; background-color: grey;">
                  <div id="progress" style="width: 0; height: 20px; background-color: green;"></div>
              </div>
              <p id="status-text">Загружено 0 из 0 композиций</p>

              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <h5 class="mt-3">Общее</h5>
              <div class="row">
              <div class="col-sm-3">
                      <!-- select -->
                      <div class="form-group">
                        <label>Шрифт</label>
                        <select name="font-family" class="form-control update-field">
                          <option value="10">Шрифт 1</option>
                          <option value="10">Шрифт 2</option>
                          <option value="10">Шрифт 3</option>
                          <option value="10">Шрифт 4</option>
                          <option value="10">Шрифт 5</option>
                        </select>
                      </div>
                    </div>
                    
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Фон: цвет</label>

                  <div id="fon" class="input-group my-colorpicker2">
                    <input type="text" name="color" class="form-control update-field">

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
                    <input type="checkbox" class="update-field" name="pagination" checked data-bootstrap-switch>
                    </div>
                    </div>
                    </div>
                <div class="col-md-3">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Пагинация цвет</label>

                  <div id="paginationcolor" class="input-group my-colorpicker2">
                    <input type="text" name="pagination-color" class="form-control update-field">

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
                    <input type="text" name="search-color" class="form-control update-field">

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
                    <input type="text" name="search-border-color" class="form-control update-field">

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
                    <input type="text" name="search-font-color" class="form-control update-field">

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
                        <select name="search-font-size" class="form-control update-field">
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
                    <input type="text" name="searchres-color" class="form-control update-field">

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
                    <input type="text" name="searchres-border-color" class="form-control update-field">

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
                    <input type="text" name="searchres-font-color" class="form-control update-field">

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
                        <select name="searchres-font-size" class="form-control update-field">
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
              <div class="col-md-12">
              
                <h6>Кнопка</h6>
                <div class="row">
                <div class="col-md-4">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет фона</label>

                  <div id="buttonheaderfoncolor" class="input-group my-colorpicker2">
                    <input type="text" name="headbutton-font-color" class="form-control update-field">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
              
              <div class="col-md-4">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет текста</label>

                  <div id="buttonheadertextcolor" class="input-group my-colorpicker2">
                    <input type="text" name="headbutton-font-size" class="form-control update-field">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>

                <div class="col-md-4">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет границы кнопки</label>

                  <div id="headbuttonbordercolor" class="input-group my-colorpicker2">
                    <input type="text" name="headbutton_border_color" class="form-control update-field">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>



                </div>
              </div>
             
              <div class="col-md-12">
                <h6>Контактная информация</h6>
                <div class="row">
                <div class="col-md-4">
                    <!-- Color Picker -->
                <div class="form-group">
                  <label>Цвет текста</label>

                  <div id="contactheadertextcolor" class="input-group my-colorpicker2">
                    <input type="text" name="headcontact-font-color" class="form-control update-field">

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
              <form class="mt-3 col-md-12" id="ajaxForm" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden"  value="{{$catalog->id}}" name="catalog_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Логотип(в формате png, svg)</label>
                            <input type="file" name="logo" id="fileLogo" class="form-control">
                            @if(1==1)
                            <div class="col-md-6">
                            <img src="" alt="">
                            <button type="button" id="clearButton" class="btn btn-block btn-danger">Удалить</button>
                            </div>                        
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Контактная информация</label>
                            <textarea class="form-control" rows="5" name="contact" id=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Кнопка</label>
                        <div class="row">
                            <div class="col-md-6"><input class="form-control" name="button_text" placeholder="Текст" type="text"></div>
                            <div class="col-md-6"><input class="form-control" name="button_href" placeholder="Ссылка" type="text"></div>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Наш логотип</label>
                        <div class="row">
                            <input type="checkbox" name="ourlogo" id="ourlogo" checked data-bootstrap-switch>
                        </div>
                    </div>
                </div>
                </div>       
                
                <button type="submit" class="btn btn-success mt-3">Сохранить</button>
              </form>
              <div id="response"></div>
              </div>
              </div>
            </div> 
                      
          </div>
     <div class="preview col-md-4" id="iframeContainer">
     
     </div>
        </div><!-- /.container-fluid -->
    </section>

  <script>
    $(document).ready(function(){
      // Функция для загрузки iframe
    function loadIframe() {
        // Создаем элемент iframe с помощью jQuery
        var iframe = $('<iframe>', {
            src: 'https://{{$catalog_temaddress}}', // Укажите URL, который вы хотите загрузить
            height: '400',
            overflow: 'hidden',
            frameborder: '0'
        });

        // Очищаем контейнер перед вставкой нового iframe (если это необходимо)
        $('#iframeContainer').empty();

        // Вставляем iframe в контейнер
        $('#iframeContainer').append(iframe);
    }

    // Загрузка iframe после загрузки страницы
    loadIframe();

    // Добавляем обработчик на кнопку для перезагрузки iframe по нажатию
    $('#loadIframeButton').on('click', function() {
        loadIframe();
    });

    $('.update-field').change(function(){
        var fieldName = $(this).attr('name');
        var catalog_id = $('#catalog_id').val();
        var fieldValue;

        if ($(this).attr('type') === 'checkbox') {
            fieldValue = $(this).is(':checked') ? 1 : 0;
        } else {
            fieldValue = $(this).val();
        }

        $.ajax({
            url: '/admin_panel/updateField', // Маршрут к вашему методу обновления поля в контроллере
            method: 'POST',
            data: {
                fieldName: fieldName,
                fieldValue: fieldValue,
                catalog_id: catalog_id,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF токен для безопасности
            },
            success: function(response){
                // Обработка успешного ответа
                console.log(response.message);
                loadIframe();
            },
            error: function(xhr, status, error){
                // Обработка ошибки
                console.error(xhr.responseText);
            }
        });
    });

    $('#importExcell').on('submit', function(e) {
                e.preventDefault();
                
                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('file', $('#excellfile')[0].files[0]);
                formData.append('catalog_id', $('#catalog_id').val());


                if (!$('#excellfile')[0].files[0]) {
                    $('#message').text('Please select a file.');
                    return;
                }

                $('#progress-wrapper').show();

                $.ajax({
                    url: '{{ route('importExcell') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,                   
                    success: function(response) {
                        $('#message').html('<div class="alert alert-success">'+response.message+'</div>'); 
                        checkStatus(response.path);                       
                    }
                });
                
            });

            function checkStatus(path) {
              //setInterval(function () {
                  $.ajax({
                      url: '{{ route('processing.status') }}',
                      method: 'GET',
                      data: { path: path },
                      success: function (response) {
                          var progress = (response.processed_rows / response.total_rows) * 100;
                          $('#progress').css('width', progress + '%');
                          $('#status-text').text('Загружено ' + response.processed_rows + ' из ' + response.total_rows + ' композиций');
                      }
                  });
              //}, 3000);
          }

            $('#ajaxForm').on('submit', function(event) {
                event.preventDefault();

                let formData = new FormData(this);
                formData.append('ourlogo', $('#ourlogo').is(':checked') ? 1 : 0);

                $.ajax({
                    url: "{{ route('infoupdate') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                      loadIframe();                      
                        $('#response').html('<br><br><a class="btn btn-info mt-3" id="download-link" href="'+response.download_link+'" download="qr-code.png">Скачать QR</a><br><br><img src="'+response.qr_code+'" alt="QR Code"><br><br><a target="_blank" href="'+response.href+'">'+response.href+'</a>');
                    },
                    error: function(response) {
                        //$('#response').html('An error occurred.');
                    }
                });
            });

            $('#clearButton').click(function() {
              loadIframe();
                $('#fileLogo').val('');  // Очистка значения элемента input
            });
});
</script>
    <!-- /.content -->
    @endsection