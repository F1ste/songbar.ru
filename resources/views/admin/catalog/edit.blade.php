@extends('layouts.admin_layout')

@section('title', 'Каталог')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
            href="#custom-content-below-load" role="tab" aria-controls="custom-content-below-home"
            aria-selected="true">Загрузка каталога</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-songs"
            role="tab" aria-controls="custom-content-below-home" aria-selected="true">Каталог песен</a>
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
        <div class="tab-pane fade show active" id="custom-content-below-load" role="tabpanel"
          aria-labelledby="custom-content-below-load-tab">
          <h5 class="mt-3">Загрузите песни в формате xlsx, csv</h5>
          <p><a href="">Скачать образец</a></p>
          <form id="upload-form" action="{{ route('importExcell') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="catalog_id" value="{{ $catalog->id }}">
            <input type="file" name="file" required>
            <button type="submit">Загрузить файл</button>
          </form>
          <div id="progress-bar" style="width: 100%; background-color: grey; margin-top: 20px;">
            <div id="progress" style="width: 0; height: 20px; background-color: green;"></div>
          </div>
          <p id="status-text">Загружено 0 из 0 композиций</p>

        </div>
        <div class="tab-pane fade show" id="custom-content-below-songs" role="tabpanel"
          aria-labelledby="custom-content-below-songs-tab">
          <h5 class="mt-3">Каталог песен</h5>
          <div class="row mb-3">
            <div class="col-md-6">
              <input type="text" id="songInput" class="form-control" placeholder="Поиск песен...">
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>Исполнитель</th>
                  <th>Песня</th>
                  <th>Действие</th>
                </tr>
              </thead>
              <tbody id="songTable">
              </tbody>
            </table>
          </div>

          <nav aria-label="Song Pagination">
            <ul class="pagination justify-content-center" id="pagination">

            </ul>
          </nav>

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
                  <input type="text" name="color" value="{{$design->color}}" class="form-control update-field">

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
                  <input type="checkbox" value="{{$design->pagination_color}}" class="update-field"
                    name="pagination" checked data-bootstrap-switch>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <!-- Color Picker -->
              <div class="form-group">
                <label>Пагинация цвет</label>

                <div id="paginationcolor" class="input-group my-colorpicker2">
                  <input type="text" name="pagination-color" value="{{$design->pagination_color}}"
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
                  <input type="text" name="search-color" value="{{$design->search_color}}"
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
                  <input type="text" name="search-border-color" value="{{$design->search_border_color}}"
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
                  <input type="text" name="search-font-color" value="{{$design->search_font_color }}"
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
                  <input type="text" name="searchres-color" value="{{$design->searchres_color }}"
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
                  <input type="text" name="searchres-border-color" value="{{$design->searchres_border_color }}"
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
                  <input type="text" name="searchres-font-color" value="{{$design->searchres_font_color }}"
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
                      <input type="text" name="headbutton-font-color" value="{{$design->headbutton_font_color }}"
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
                      <input type="text" name="headbutton-font-size" value="{{$design->headbutton_font_size }}"
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
                      <input type="text" name="headcontact-font-color" value="{{$design->headcontact_font_color }}"
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
                    <input type="file" name="logo" value="{{$info->logo}}" id="fileLogo" class="form-control">
                    @if(1 == 1)
            <div class="col-md-6">
              <img id="imgLogo" src="/{{$info->logo}}" alt="">
              <button type="button" id="clearButton" class="btn btn-block btn-danger">Удалить</button>
            </div>
          @endif
                  </div>
                </div>
                <div class="col-md-5 offset-md-1">
                  <div class="form-group">
                    <label>Контактная информация</label>
                    <textarea class="form-control" rows="5" name="contact" value="{!! $info->contact !!}"
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
                        <input class="form-control" name="button_text" value="{{$info->button_text }}"
                          placeholder="Текст" type="text">
                      </div>
                      <div class="col-md-6">
                        <input class="form-control" name="button_href" value="{{$info->button_text}}"
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
      <iframe src="http://{{($catalog->address).'.songbar'}}" style="width:100%; height:600px; border:none;"></iframe>
    </div>
  </div><!-- /.container-fluid -->
</section>

<script>
  $(document).ready(function () {
    // Функция для загрузки iframe
    function loadIframe() {
      // Создаем элемент iframe с помощью jQuery
      var iframe = $('<iframe>', {
        src: 'https://{{$catalog->address}}.songbar', // Укажите URL, который вы хотите загрузить
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
    $('#loadIframeButton').on('click', function () {
      loadIframe();
    });

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
          loadIframe();
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
          loadIframe();
          $('#response').html('<br><br><a class="btn btn-info mt-3" id="download-link" href="' + response.download_link + '" download="qr-code.png">Скачать QR</a><br><br><img src="' + response.qr_code + '" alt="QR Code"><br><br><a target="_blank" href="' + response.href + '">' + response.href + '</a>');
        },
        error: function (response) {
          //$('#response').html('An error occurred.');
        }
      });
    });

    $('#clearButton').click(function () {
      loadIframe();
      $('#fileLogo').val('');  // Очистка значения элемента input
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

    var progressInterval = setInterval(function () {
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
          clearInterval(progressInterval);
        });
    }, 1000);
  }

  function initialCheck() {
    var catalogId = document.querySelector('input[name="catalog_id"]').value;
    if (catalogId) {
      checkProgress({{$catalog->id}});
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    initialCheck();
  });

  document.getElementById('upload-form').addEventListener('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();

    xhr.open('POST', this.action, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', getCsrfToken());

    xhr.onload = function () {
      if (xhr.status === 200) {
        var catalogId = document.querySelector('input[name="catalog_id"]').value;
        checkProgress(catalogId);
      } else {
        alert('Ошибка при загрузке файла.');
      }
    };

    xhr.send(formData);
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const catalogId = {{ $catalog->id }};
    const songInput = document.getElementById('songInput');
    const tbody = document.getElementById('songTable');

    const addButtonRow = `<tr>
            <td><input type="text" id="newSongSinger" placeholder="Исполнитель" class="form-control"></td>
            <td><input type="text" id="newSongTitle" placeholder="Песня" class="form-control"></td>
            <td>
                <button class="btn btn-primary btn-sm add-song">Добавить</button>
            </td>
        </tr>`;

    function fetchSongs(page = 1) {
      fetch(`{{ route('songs.fetch') }}?catalogId=${catalogId}&page=${page}`)
        .then(response => response.json())
        .then(data => {
          renderTable(data.songs);
          renderPagination(data.pagination);
        });
    }

    function renderTable(songs) {
      tbody.innerHTML = '';

      if (!songs.length) {
        const noResultRow = `<tr>
            <td colspan="3" class="text-center">
            ${songInput.value === '' ? '<p class="text-muted">В каталоге нет песен</p>'
            : '<p class="text-muted">По Вашему запросу ничего не найдено</p>'}
            </td>
        </tr>`;
        tbody.insertAdjacentHTML('beforeend', noResultRow);
      }

      songs.forEach(song => {
        const row = `<tr>
            <td>${song.singer}</td>
            <td>${song.title}</td>
            <td>
                <button class="btn btn-danger btn-sm delete-song" data-id="${song.id}">Удалить</button>
            </td>
        </tr>`;
        tbody.insertAdjacentHTML('beforeend', row);
      });

      tbody.insertAdjacentHTML('beforeend', addButtonRow);

      document.querySelectorAll('.delete-song').forEach(button => {
        button.addEventListener('click', function () {
          const songId = this.getAttribute('data-id');
          deleteSong(songId);
        });
      });

      document.querySelector('.add-song').addEventListener('click', function () {
        const singer = document.getElementById('newSongSinger').value;
        const title = document.getElementById('newSongTitle').value;
        addSong(singer, title);
      });

    }

    function renderPagination(paginationHtml) {
      pagination.innerHTML = "";
      
      if (songInput.value === "") {        
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = paginationHtml;
  
        document.querySelectorAll('#pagination a').forEach(link => {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            const page = new URL(this.href).searchParams.get('page');
            fetchSongs(page);
          });
        });
      }
    }

    function addSong(singer, title) {
      fetch(`{{ route('songs.store') }}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
          singer: singer,
          title: title,
          catalogId: catalogId,
        }),
      })
        .then(response => response.json())
        .then(data => {
          console.log(data);

          if (data.status === 'success') {
            fetchSongs();
          } else {
            alert('Ошибка при добавлении песни');
          }
        });
    }

    function deleteSong(songId) {
      fetch(`/admin_panel/catalog/songs/${songId}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ catalog_id: catalogId }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            fetchSongs();
          } else {
            alert('Ошибка при удалении песни');
          }
        });
    }

    function searchSongs() {
      fetch(`{{ route('songs.search') }}?songInput=${songInput.value}&catalogId=${catalogId}`).then(response => response.json()).then((data) => {
        const songsData = data.songs || [];
        tbody.innerHTML = "";
        renderTable(songsData);
      })

      if (songInput.value === '') fetchSongs();
      renderPagination();
    }

    songInput.addEventListener("input", searchSongs);

    fetchSongs();
  });
</script>
<!-- /.content -->
@endsection