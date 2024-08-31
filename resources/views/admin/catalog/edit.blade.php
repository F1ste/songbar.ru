@extends('layouts.admin_layout')

@section('title', 'Каталог')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" value="{{$catalog}}" id="catalog_id">
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
  <div class="container-fluid">
    <div class="card-body">
      <h4>Добавьте информацию</h4>
      <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
            href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
            aria-selected="true">Каталог</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
            href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
            aria-selected="false">Дизайн</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill"
            href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages"
            aria-selected="false">Информация</a>
        </li>

      </ul>
      <div class="tab-content" id="custom-content-below-tabContent">
        <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
          aria-labelledby="custom-content-below-home-tab">
          <h5 class="mt-3">Загрузите песни в формате xlsx, csv</h5>
          <p><a href="">Скачать образец</a></p>
          <form id="upload-form" action="{{ route('importExcell') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="catalog_id" value="{{ $catalog }}">
            <input type="file" name="file" required>
            <button type="submit">Загрузить файл</button>
          </form>
          <div id="progress-bar" style="width: 100%; background-color: grey; margin-top: 20px;">
            <div id="progress" style="width: 0; height: 20px; background-color: green;"></div>
          </div>
          <p id="status-text">Загружено 0 из 0 композиций</p>

        </div>
        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
          aria-labelledby="custom-content-below-profile-tab">
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
                  <input type="text" name="color" value="{{$design->color ?? ''}}" class="form-control update-field">

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
                  <input type="checkbox" value="{{$design->pagination_color ?? ''}}" class="update-field" name="pagination"
                    checked data-bootstrap-switch>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <!-- Color Picker -->
              <div class="form-group">
                <label>Пагинация цвет</label>

                <div id="paginationcolor" class="input-group my-colorpicker2">
                  <input type="text" name="pagination-color" value="{{$design->pagination_color ?? ''}}"
                    class="form-control update-field">

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
                  <input type="text" name="search-color" value="{{$design->search_color ?? ''}}"
                    class="form-control update-field">

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
                  <input type="text" name="search-border-color" value="{{$design->search_border_color ?? ''}}"
                    class="form-control update-field">

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
                  <input type="text" name="search-font-color" value="{{$design->search_font_color ?? ''}}"
                    class="form-control update-field">

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
                  <input type="text" name="searchres-color" value="{{$design->searchres_color ?? ''}}"
                    class="form-control update-field">

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
                  <input type="text" name="searchres-border-color" value="{{$design->searchres_border_color ?? ''}}"
                    class="form-control update-field">

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
                  <input type="text" name="searchres-font-color" value="{{$design->searchres_font_color ?? ''}}"
                    class="form-control update-field">

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
            <div class="col-md-6">

              <h6>Кнопка</h6>
              <div class="row">
                <div class="col-md-6">
                  <!-- Color Picker -->
                  <div class="form-group">
                    <label>Цвет фона</label>

                    <div id="buttonheaderfoncolor" class="input-group my-colorpicker2">
                      <input type="text" name="headbutton-font-color" value="{{$design->headbutton_font_color ?? ''}}"
                        class="form-control update-field">

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
                      <input type="text" name="headbutton-font-size" value="{{$design->headbutton_font_size ?? ''}}"
                        class="form-control update-field">

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
                      <input type="text" name="headcontact-font-color" value="{{$design->headcontact_font_color ?? ''}}"
                        class="form-control update-field">

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
        <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel"
          aria-labelledby="custom-content-below-messages-tab">
          <div class="row">
            <form class="mt-3 col-md-12" id="ajaxForm" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" value="{{$catalog}}" name="catalog_id">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Логотип(в формате png, svg)</label>
                    <input type="file" name="logo" value="{{$info->logo ?? ''}}" id="fileLogo" class="form-control">
                    @if(1 == 1)
            <div class="col-md-6">
              <img id="imgLogo" src="/{{$info->logo ?? ''}}" alt="">
              <button type="button" id="clearButton" class="btn btn-block btn-danger">Удалить</button>
            </div>
          @endif
                  </div>
                </div>
                <div class="col-md-5 offset-md-1">
                  <div class="form-group">
                    <label>Контактная информация</label>
                    <textarea class="form-control" rows="5" name="contact" value="{!! $info->contact ?? '' !!}"
                      id=""></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Кнопка</label>
                    <div class="row">
                      <div class="col-md-6">
                        <input class="form-control" name="button_text" value="{{$info->button_text ?? ''}}"
                          placeholder="Текст" type="text">
                      </div>
                      <div class="col-md-6">
                        <input class="form-control" name="button_href" value="{{$info->button_text ?? ''}}"
                          placeholder="Ссылка" type="text">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 offset-md-1">
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
    <div class="preview">
      <iframe src="{{$catalog->address ?? ''}}" style="width:100%; height:600px; border:none;"></iframe>
    </div>
  </div><!-- /.container-fluid -->
</section>

<script>
  $(document).ready(function () {
    $('.update-field').change(function () {
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
        success: function (response) {
          // Обработка успешного ответа
          console.log(response.message);
        },
        error: function (xhr, status, error) {
          // Обработка ошибки
          console.error(xhr.responseText);
        }
      });
    });



    $('#ajaxForm').on('submit', function (event) {
      event.preventDefault();

      let formData = new FormData(this);
      formData.append('ourlogo', $('#ourlogo').is(':checked') ? 1 : 0);

      $.ajax({
        url: "{{ route('infoupdate') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          $('#response').html('<img src="' + response.qr_code + '" alt="QR Code">');
        },
        error: function (response) {
          //$('#response').html('An error occurred.');
        }
      });
    });

    $('#clearButton').click(function () {
      $('#fileLogo').val('');  // Очистка значения элемента input
      $('#imgLogo').attr('src', '');  // Очистка значения элемента input
    });
  });
</script>
<script>
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

function checkProgress(catalogId) {
    const csrfToken = getCsrfToken();
    const routeUrl = @json(route('processing.status'));
    const url = `${routeUrl}?catalog_id=${catalogId}`;

    var progressInterval = setInterval(function() {
        fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('progress').style.width = data.progress + '%';
            document.getElementById('status-text').innerText = `Загружено ${data.processed_rows} из ${data.total_rows} композиций`;

            if (data.progress === 100 && data.status === 'completed') {
                clearInterval(progressInterval);
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            clearInterval(progressInterval); // Остановить интервал, если ошибка
        });
    }, 1000);
}

// Функция для проверки статуса сразу при загрузке страницы
function initialCheck() {
    var catalogId = document.querySelector('input[name="catalog_id"]').value;
    if (catalogId) {
        checkProgress({{$catalog->id ?? $catalog}});
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initialCheck(); // Проверяем статус при загрузке страницы
});

document.getElementById('upload-form').addEventListener('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();

    xhr.open('POST', this.action, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', getCsrfToken());

    xhr.onload = function () {
        if (xhr.status === 200) {
            var catalogId = document.querySelector('input[name="catalog_id"]').value;
            checkProgress(catalogId); // Проверяем статус после отправки формы
        } else {
            alert('Ошибка при загрузке файла.');
        }
    };

    xhr.send(formData);
});
</script>

<!-- /.content -->
@endsection