<html lang="ru-RU" itemscope="" itemtype="https://schema.org/WebPage"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Пример шаблона каталога караоке</title>
<meta name="robots" content="max-image-preview:large">

<link rel="stylesheet" id="blankslate-style-css" href="{{ asset('style.css') }}" type="text/css" media="all">
@if ($design->font_family == 'Montserrat')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endif
@if ($design->font_family == 'Montserrat_Alternates')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
@endif
@if ($design->font_family == 'Oswald')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
@endif
@if ($design->font_family == 'PT_Sans_Narrow')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
@endif
@if ($design->font_family == 'Roboto')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endif
@if ($design->font_family == 'Tektur')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tektur:wght@400..900&display=swap" rel="stylesheet">
@endif
@if ($design->font_family == 'Yanone_Kaffeesatz')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@200..700&display=swap" rel="stylesheet">
@endif

<style>
    ::-webkit-input-placeholder {font-size:inherit; color:inherit;}
    ::-moz-placeholder          {font-size:inherit; color:inherit;}/* Firefox 19+ */
    :-moz-placeholder           {font-size:inherit; color:inherit;}/* Firefox 18- */
    :-ms-input-placeholder      {font-size:inherit; color:inherit;}
    .custom-pagination .page-item.active .page-link {
}

.pagination {
    margin-top: 20px;
    display: flex;
    gap: 5px;
    list-style: none;
    justify-content: center;
    color: {{$design->pagination_color ?? '#fff'}};
    font-size: {{$design->pagination_font_size ?? '14'}}px;
}
#pagination {
  @if (!$design->is_pagination ?? true)
    visibility: hidden;
    pointer-events: none;
  @endif
}
.page-item{
    color: inherit;
    font-size: inherit;
}

.page-item.active {
    color: {{$design->pagination_color_active ?? '#A02EE0'}};
}

.page-link{
    color: inherit;
    padding: 3px;
    text-decoration: none;
}

.table{
  color: {{$design->search_results_font_color ?? '#fff'}};
  background-color: {{$design->search_results_color ?? '#000'}};
  border: 1px solid;
  border-color: {{$design->search_results_border_color ?? '#A02EE0'}};
  font-size: {{$design->search_font_size ?? '16'}}px;
}
</style>
{!! $head_script !!}
</head>
<body class="" style="font-family:'{{ str_replace('_', ' ', $design->font_family) ?? 'Arial' }}', sans-serif;">

<div class="main_conteiner" style="background:{{$design->bg_color ?? '#000'}}; display: flex; flex-direction: column; box-sizing: border-box; padding-bottom: 0;">
	<div class="header">
        <div class="logo">
            <img src="{{$info->logo ? '/'.$info->logo : asset('uploads/logo.png')}}">
        </div>
        
        @if(!empty($info->button_text))
            <div class="menu">
                <a href="{{ $info->button_href ?? '#' }}" class="btn_menu" style="text-decoration: none;">
                    <p style="background:{{ $design->header_btn_bg_color ?? '#000' }}; 
                              color:{{ $design->header_btn_font_color ?? '#fff' }}; 
                              font-size:{{ $design->header_btn_font_size ?? '16' }}px; 
                              border-color:{{ $design->header_btn_border_color ?? '#A02EE0' }};">
                        {{ $info->button_text }}
                    </p>
                </a>
            </div>
        @endif
        <div class="info">
            <p style="color:{{$design->header_contact_font_color ?? '#fff'}}; font-size: {{$design->header_contact_font_size ?? 14}}px;">
            {!! $info->contact ?? 'ул. Пушкина д. 5 <br> ПН-ВС с 18:00 до 5:00' !!}
            </p>
        </div>
        <div class="seti"></div>
    </div>

    <div class="content">

      <div class="serc_box" style="position: relative;">
        <div class="serc_input" style="background:{{$design->bg_search_color ?? '#000'}}; border-color:{{$design->search_border_color ?? '#A02EE0'}};">
          <div style="width: 100%;">
            <input class="serth_input" id="search" type="text" name="" value="" placeholder="Поиск песен" style="font-size:{{$design->search_font_size ?? '14'}}px; color:{{$design->search_font_color ?? '#fff'}};">
          </div>
          <input type="hidden" value="{{$design->catalog_id ?? ''}}" name="catalog_id" id="catalog_id">
        </div>

          <div id="results">
              <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th width="50%">Исполнитель</th>
                    <th>Песня</th>
                  </tr>
                </thead>
                <tbody id="songTable">
                </tbody>
              </table>
              <div id="pagination"></div>
          </div>
      </div>
    </div>
    @if ($info->ourlogo)
    <div id="songbarCopy" style="min-height: 25px; background: #000; color: #fff; display: flex;align-items: center;justify-content: center; margin-top: auto; padding: 10px;">
      <a href="https://songbar.ru" target="_blank" style="color:inherit; text-decoration: none;">
        ©2025 SONGBAR - онлайн каталог песен для караоке-бара
      </a>
    </div>
    @endif
  </div>


</body>
{!! $body_script !!}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const currentUrl = window.location.href;
    const urlSegments = currentUrl.split('/');
    let catalogId = isNaN(urlSegments[urlSegments.length - 1]) ? 1 : parseInt(urlSegments[urlSegments.length - 1]);
    @if (isset($catalog_id))
      catalogId = {{$catalog_id}}
    @endif
    
    
    const songInput = document.getElementById('search');
    const tbody = document.getElementById('songTable');

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
            <td colspan="2" style="text-align: center;">
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
        </tr>`;
        tbody.insertAdjacentHTML('beforeend', row);
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

    function debounce(func, delay) {
      let timeout;
      return function(...args) {
          const context = this;
          clearTimeout(timeout);
          timeout = setTimeout(() => func.apply(context, args), delay);
      };
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

    songInput.addEventListener("input", debounce(searchSongs, 500));

    fetchSongs();
  });
</script>
</html>
