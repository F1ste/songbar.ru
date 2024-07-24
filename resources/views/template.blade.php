<html lang="ru-RU" itemscope="" itemtype="https://schema.org/WebPage"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Песни караоке-бара MIMONOT</title>
<meta name="robots" content="max-image-preview:large">

<link rel="stylesheet" id="blankslate-style-css" href="style.css" type="text/css" media="all">
<link rel="stylesheet" href="/custom.css">
  <!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<style>
    ::-webkit-input-placeholder {font-size:{{$design->search_font_size}}px; color:{{$design->search_font_color}};}
    ::-moz-placeholder          {font-size:{{$design->search_font_size}}px; color:{{$design->search_font_color}};}/* Firefox 19+ */
    :-moz-placeholder           {font-size:{{$design->search_font_size}}px; color:{{$design->search_font_color}};}/* Firefox 18- */
    :-ms-input-placeholder      {font-size:{{$design->search_font_size}}px; color:{{$design->search_font_color}};}
</style>
</head>
<body class="">


<div class="main_conteiner" style="font-family:{{$design->font_family}}; background:{{$design->color}};">



	<div class="header">
        <div class="logo">
            <img src="{{$info->logo}}">
        </div>
        <div class="menu">
            <a href="{{$info->button_href}}" class="btn_menu" style="text-decoration: none;"><p style="background:{{$design->headbutton_font_color}}; color:{{$design->headbutton_font_size}}; border-color:{{$design->headbutton_border_color}};">{{$info->button_text}}</p></a>

        </div>
        <div class="info">
            <p style="color:{{$design->headcontact_font_color}};">
            {!! $info->contact !!}
            </p>
        </div>
        <div class="seti"></div>
    </div>

<div class="content">


	<div class="serc_box" style="position: relative;">
		<div class="serc_input" style="background:{{$design->search_color}}; border-color:{{$design->search_border_color}};">
			<div style="width: 100%;">
				<input class="serth_input" id="search" type="text" name="" value="" placeholder="Поиск песен" style="font-size:{{$design->search_font_size}}px; color:{{$design->search_font_color}};">
			</div>
            <input type="hidden" value="{{$design->catalog_id}}" name="catalog_id" id="catalog_id">


		</div>

        <div id="results">

        @include($view, ['results' => $results])
        </div>
		<!--<div class="ajax_serch_box">
			<ul class="ajax-search"></ul>
		</div>-->


	</div>

    <!--<table id="chert">
    <thead>
        <tr>
            <th style="border-right: 1px solid #A02EE0;">Песня</th>
            <th>Исполнитель</th>
        </tr>
  </thead>
<tbody>

    </tbody>
</table>-->


<!--<tr>
      <td style="border-right: 1px solid #A02EE0;">АЛЕКСАНДР</td>
      <td>3.15</td>
    </tr>

<tr>
      <td style="border-right: 1px solid #A02EE0;">ЗВЁЗДЫ В ЛУЖАХ</td>
      <td>30.02</td>
    </tr>-->





<!--<div class="wp-pagenavi" role="navigation">
<span class="pages">Страница 1 из 2&nbsp;446</span>
<span aria-current="page" class="current">1</span>
<a class="page larger" title="Страница 2" href="https://k.mimonot73.ru/?paged=2">2</a>
<a class="page larger" title="Страница 3" href="https://k.mimonot73.ru/?paged=3">3</a>
<span class="extend">...</span>
<a class="larger page" title="Страница 10" href="https://k.mimonot73.ru/?paged=10">10</a>
<a class="larger page" title="Страница 20" href="https://k.mimonot73.ru/?paged=20">20</a>
<span class="extend">...</span>
<a class="nextpostslink" rel="next" aria-label="Следующая страница" href="https://k.mimonot73.ru/?paged=2">Дальше</a>
</div>-->


</div>


<script>
        $(document).ready(function() {
            var designPagination = @json($design->pagination);
            var isLoading = false;

            function fetch_data(query, page) {
                if (isLoading) return;
                isLoading = true;

                $.ajax({
                    url: "{{ route('template') }}",
                    type: "GET",
                    data: { query: query, page: page },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (designPagination) {
                            $('#results').html(data.data);
                            $('#pagination').html(data.pagination);
                        } else {
                            if (page === 1) {
                                $('#results').html(data.data);
                            } else {
                                $('#result-list').append($(data.data).find('#result-list').html());
                                if (!$(data.data).find('#load-more').length) {
                                    $('#load-more').remove();
                                }
                            }
                        }
                        isLoading = false;
                    },
                    error: function() {
                        isLoading = false;
                    }
                });
            }

            $('#search').on('input', function() {
                var query = $(this).val();
                fetch_data(query, 1);
            });

            if (designPagination) {
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    var query = $('#search').val();
                    var page = $(this).attr('href').split('page=')[1];
                    fetch_data(query, page);
                });
            } else {
                $(document).on('click', '#load-more button', function() {
                    var query = $('#search').val();
                    var page = $(this).data('page');
                    fetch_data(query, page);
                    $(this).data('page', page + 1);
                });

                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                        $('#load-more button').trigger('click');
                    }
                });
            }
        });
    </script>


</div>





</div>




</body></html>
