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
          <div class="row align-items-baseline">
            <div class="col-sm-3">
              <!-- select -->
              <div class="form-group">
                <label>Шрифт</label>
                <select id="fontFamily" name="font-family" class="form-control update-field">
                  <option value="1">Шрифт 1</option>
                  <option value="2">Шрифт 2</option>
                  <option value="3">Шрифт 3</option>
                  <option value="4">Шрифт 4</option>
                  <option value="5">Шрифт 5</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <!-- Color Picker -->
              <div class="form-group">
                <label>Фон: цвет</label>

                <div id="bg" class="input-group my-colorpicker2">
                  <input type="text" name="bg_color" value="{{$design->bg_color ?? '#000'}}" class="form-control update-field">

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
                  <input id="is_pagination" type="checkbox" value="{{$design->is_pagination ?? true}}" class="update-field"
                    name="is_pagination" {{ $design->is_pagination ? 'checked' : '' }} data-bootstrap-switch>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <!-- Color Picker -->
              <div class="form-group">
                <label>Пагинация цвет</label>

                <div id="pagination_color" class="input-group my-colorpicker2">
                  <input type="text" name="pagination_color" value="{{$design->pagination_color ?? '#fff'}}"
                    class="form-control update-field">

                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Пагинация цвет активной страницы</label>

                <div id="pagination_color_active" class="input-group my-colorpicker2">
                  <input type="text" name="pagination_color_active" value="{{$design->pagination_color_active ?? '#A02EE0'}}"
                    class="form-control update-field">

                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <div class="col-md-3">
              <!-- input -->
              <div class="form-group">
                <label>Пагинация размер шрифта</label>
                <input type="number" id="pagination_size" name="pagination_font_size" value="{{$design->pagination_font_size ?? '14'}}" class="form-control update-field"></input>
              </div>
            </div>
          </div>
          <h5 class="mt-3">Поисковая строка</h5>
          <div class="row">
            <div class="col-md-3">
              <!-- Color Picker -->
              <div class="form-group">
                <label>Поисковик фон (цвет)</label>

                <div id="search_bg" class="input-group my-colorpicker2">
                  <input type="text" name="bg_search_color" value="{{$design->bg_search_color ?? '#000'}}"
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

                <div id="search_border_color" class="input-group my-colorpicker2">
                  <input type="text" name="search_border_color" value="{{$design->search_border_color ?? '#A02EE0'}}"
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

                <div id="search_font_color" class="input-group my-colorpicker2">
                  <input type="text" name="search_font_color" value="{{$design->search_font_color ?? '#fff' }}"
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
                <input type="number" id="search_font_size" name="search_font_size" value="{{$design->search_font_size ?? '14'}}" class="form-control update-field"></input>
              </div>
            </div>
          </div>

          <h5 class="mt-3">Результаты поиска</h5>
          <div class="row">
            <div class="col-md-3">
              <!-- Color Picker -->
              <div class="form-group">
                <label>Фон (цвет)</label>

                <div id="search_results_bg" class="input-group my-colorpicker2">
                  <input type="text" name="search_results_color" value="{{$design->search_results_color ?? '#000' }}"
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

                <div id="search_results_border_color" class="input-group my-colorpicker2">
                  <input type="text" name="search_results_border_color" value="{{$design->search_results_border_color ?? '#A02EE0' }}"
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

                <div id="search_results_font_color" class="input-group my-colorpicker2">
                  <input type="text" name="search_results_font_color" value="{{$design->search_results_font_color ?? '#fff' }}"
                    class="form-control update-field">

                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <div class="col-sm-3">
              <!-- input -->
              <div class="form-group">
                <label>Размер шрифта</label>
                <input id="search_results_font_size" type="number" name="search_results_font_size" value="{{$design->search_results_font_size ?? '16'}}" class="form-control update-field"></input>
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

                    <div id="header_btn_bg" class="input-group my-colorpicker2">
                      <input type="text" name="header_btn_bg_color" value="{{$design->header_btn_bg_color ?? '#000' }}"
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
                    <label>Цвет границы</label>

                    <div id="header_btn_border_color" class="input-group my-colorpicker2">
                      <input type="text" name="header_btn_border_color" value="{{$design->header_btn_border_color ?? '#A02EE0' }}"
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

                    <div id="header_btn_font_color" class="input-group my-colorpicker2">
                      <input type="text" name="header_btn_font_color" value="{{$design->header_btn_font_color ?? '#fff' }}"
                        class="form-control update-field">

                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

              <div class="col-sm-6">
                  <!-- input -->
                  <div class="form-group">
                    <label>Размер шрифта</label>
                    <input id="header_btn_font_size" type="number" name="header_btn_font_size" value="{{$design->header_btn_font_size ?? '16'}}" class="form-control update-field"></>
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

                    <div id="contact_font_color" class="input-group my-colorpicker2">
                      <input type="text" name="header_contact_font_color" value="{{$design->header_contact_font_color ?? '#fff' }}"
                        class="form-control update-field">

                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-md-10">
                  <!-- input -->
                  <div class="form-group">
                    <label>Размер шрифта</label>
                    <input type="number" id="contact_font_size" name="header_contact_font_size" value="{{$design->header_contact_font_size ?? '14'}}" class="form-control update-field"></input>
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
              <input type="hidden" value="{{$catalog->id}}" name="catalog_id">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Логотип(в формате png, svg)</label>
                    <input type="file" name="logo" value="{{$info->logo}}" id="fileLogo" class="form-control">
                    <div id="image_preview">
                      <img id="imgLogo" src="{{$info->logo ? '/' . $info->logo : asset('uploads/logo.png')}}" alt="Превью логотипа">
                      <button type="button" id="clearButton" class="btn btn-block btn-danger" style="display:none;">Удалить</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 offset-md-1">
                  <div class="form-group">
                    <label>Контактная информация</label>
                    <textarea class="form-control" rows="5" name="contact" value="{!! $info->contact ?? 'ул. Пушкина д. 5 <br> ПН-ВС с 18:00 до 5:00' !!}"
                      id="contact_info_text">{!! $info->contact ?? 'ул. Пушкина д. 5 <br> ПН-ВС с 18:00 до 5:00' !!}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Кнопка</label>
                    <div class="row">
                      <div class="col-md-6">
                        <input id="header_btn_text" class="form-control" name="button_text" value="{{$info->button_text ?? 'Меню' }}"
                          placeholder="Текст" type="text">
                      </div>
                      <div class="col-md-6">
                        <input id="header_btn_link" class="form-control" name="button_href" value="{{$info->button_href ?? ''}}"
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
      <iframe id="catalog-iframe" style="width:100%; height:600px; border:none; overflow: hidden;"></iframe>
    </div>
  </div><!-- /.container-fluid -->
</section>

<script>
  const defaultImage = '{{ $info->logo ?? asset('uploads/logo.png') }}' ;
  const iframe = document.getElementById('catalog-iframe');
  const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
    function loadHTMLIntoIframe(htmlContent) {
        iframeDoc.open();
        iframeDoc.write(htmlContent);
        iframeDoc.close();
    }
    function loadPreviewPage(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                loadHTMLIntoIframe(data);
            })
            .catch(error => {
                console.error('Ошибка при загрузке HTML:', error);
                loadHTMLIntoIframe('<p>Ошибка загрузки страницы.</p>');
            });
    }

    function updateIframeDesign(color, element, styleProperty) {
        const el = iframeDoc.querySelector(`${element}`);
        
        if (!el) return; 
        el.style[styleProperty] = color;
    }

    function updatePaginationState (state) {
      const paginationEl = iframeDoc.getElementById(`pagination`);      
      if (!paginationEl) return;

      if (state) {
        paginationEl.style.visibility  = 'visible';
        paginationEl.style.pointerEvents = 'auto';
      } else {
        paginationEl.style.visibility  = 'hidden';
        paginationEl.style.pointerEvents = 'none';
      }
    }

    function updateText (value, element) {
      const el = iframeDoc.querySelector(`${element}`);
      el.innerHTML = value;
    }

    function updatePreviewImage (value, element) {
      const el = iframeDoc.querySelector(`${element}`);
      const preview = document.querySelector('#imgLogo');
      preview.src = value;
      el.src = value;
    }

    function debounce(func, delay) {
      let timeout;
      return function(...args) {
          const context = this;
          clearTimeout(timeout);
          timeout = setTimeout(() => func.apply(context, args), delay);
      };
  }

    function sanitizeHTML(input) {
    const allowedTags = ['b', 'i', 'br', 'strong', 'em', 'u'];
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = input;
    function cleanNode(node) {
        if (node.nodeType === 3) {
            return;
        }
        if (!allowedTags.includes(node.nodeName.toLowerCase())) {
            node.replaceWith(...node.childNodes);
        } else {
            for (let child of node.childNodes) {
                cleanNode(child);
            }
        }
    }

    for (let child of tempDiv.childNodes) {
        cleanNode(child);
    }

    return tempDiv.innerHTML;
}

    function changeColor (id, color) {
      switch (id) {
          case 'bg':
              updateIframeDesign(color.toString(), '.main_conteiner', 'backgroundColor');
              break;
          case 'pagination_color':
              updateIframeDesign(color.toString(), '.pagination', 'color');
              break;
          case 'pagination_color_active':
              updateIframeDesign(color.toString(), '.page-item.active', 'color');
              break;
          case 'search_bg':
              updateIframeDesign(color.toString(), '.serc_input', 'backgroundColor');
              break;
          case 'search_border_color':
              updateIframeDesign(color.toString(), '.serc_input', 'borderColor');
              break;
          case 'search_font_color':
              updateIframeDesign(color.toString(), '.serth_input', 'color');
              break;
          case 'search_results_bg':
              updateIframeDesign(color.toString(), '.table', 'backgroundColor');
              break;
          case 'search_results_border_color':
              updateIframeDesign(color.toString(), '.table', 'borderColor');
              break;
          case 'search_results_font_color':
              updateIframeDesign(color.toString(), '.table', 'color');
              break;
          case 'header_btn_bg':
              updateIframeDesign(color.toString(), '.menu p', 'backgroundColor');
              break;
          case 'header_btn_border_color':
              updateIframeDesign(color.toString(), '.menu p', 'borderColor');
              break;
          case 'header_btn_font_color':
              updateIframeDesign(color.toString(), '.menu p', 'color');
              break;
          case 'contact_font_color':
              updateIframeDesign(color.toString(), '.info p', 'color');
              break;
          default:
              console.log(`Неизвестный идентификатор: ${id}`);
      }
    }

    function changeFontSize(id, value) {
      switch (id) {
            case 'pagination_size':
                updateIframeDesign(value, '.pagination', 'fontSize');
                break;
            case 'search_font_size':
              updateIframeDesign(value, '.serth_input', 'fontSize');
                break;
            case 'search_results_font_size':
              updateIframeDesign(value, '.table', 'fontSize');
                break;
            case 'header_btn_font_size':
              updateIframeDesign(value, '.menu p', 'fontSize');
                break;
            case 'contact_font_size':
              updateIframeDesign(value, '.info', 'fontSize');
                break;
            default:
                console.log('Неизвестный селект');
        }
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        loadPreviewPage('{{ route(name: 'catalog.preview') }}?catalog_id={{$catalog->id}}'); 

      $('.my-colorpicker2').on('colorpickerChange', debounce(function(event) {
        changeColor(this.id, event.color)
        
        $('#'+this.id +' .fa-square').css('color', event.color.toString());
      }, 300));

      $('#pagination_size, #search_font_size, #search_results_font_size, #header_btn_font_size, #contact_font_size').on('change', function() {
        const selectedValue = $(this).val();
        const selectId = $(this).attr('id');
        changeFontSize(selectId, selectedValue);
      });

      $('#header_btn_text, #contact_info_text').on('change', function() {
          const newValue = $(this).val();
          const inputId = $(this).attr('id');
          
          switch (inputId) {
              case 'header_btn_text':
                  updateText(sanitizeHTML(newValue), '.menu p');
                  break;
              case 'contact_info_text':
                  updateText(sanitizeHTML(newValue), '.info p');
                  break;
              default:
                console.log('Неизвестный input');
          }
      });
        
      $("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function(event, state) {          
          updatePaginationState(state)
          
          $.ajax({
            url: '/admin_panel/updateField',
            method: 'POST',
            data: {
              fieldName: 'is_pagination',
              fieldValue: state ? 1 : 0,
              catalog_id: {{$catalog->id}},
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
              console.log(response);
            },
            error: function (xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
      });

      document.getElementById('fileLogo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                updatePreviewImage(e.target.result, '.logo img')

                const clearButton = document.getElementById('clearButton');
                clearButton.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    });

    document.getElementById('clearButton').addEventListener('click', function() {
      updatePreviewImage(defaultImage, '.logo img')

      const fileLogo = document.getElementById('fileLogo');
      fileLogo.value = '';
      this.style.display = 'none';
    });

    setTimeout(()=>{
      $('.my-colorpicker2').each(function() {
        const color = $(this).data('color')._original.color;
        
        changeColor(this.id, color)
        $('#'+this.id +' .fa-square').css('color', color);
    });
    
      $('#pagination_size, #search_font_size, #search_results_font_size, #header_btn_font_size, #contact_font_size').each(function() {
          const selectedValue = $(this).val();
          const selectId = $(this).attr('id');
          changeFontSize(selectId, selectedValue);
        });
    },1000)
    
    $('.update-field').change(debounce(function () {
      const fieldName = $(this).attr('name');
      let fieldValue;

      if ($(this).attr('type') === 'checkbox') {
        fieldValue = $(this).is(':checked') ? 1 : 0;
      } else {
        fieldValue = $(this).val();
      }

      
      $.ajax({
        url: '/admin_panel/updateField',
        method: 'POST',
        data: {
          fieldName: fieldName,
          fieldValue: fieldValue,
          catalog_id: {{$catalog->id}},
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          console.log(response);
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }, 300));

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
          $('#response').html(`
            <br><br>
            <a class="btn btn-info mt-3" id="download-link" href="${response.download_link}" download="qr-code.png">Скачать QR</a>
            <br><br>
            <img src="${response.qr_code}" alt="QR Code">
            <br><br>
            <a target="_blank" href="${response.href}">${response.href}</a>
          `);
        },
        error: function (response) {
          //$('#response').html('An error occurred.');
        }
      });
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