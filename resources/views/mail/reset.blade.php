@extends('mail.layout')

@section('preheader')
Сброс пароля Songbar
@endsection

@section('content')
<h1 style="font-family: Helvetica, sans-serif; Margin: 0; margin-bottom: 16px; font-size: 22px;">Сброс пароля</h1>
<p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; Margin: 0; margin-bottom: 16px;">
    Вы получили это письмо, поскольку мы получили запрос на сброс пароля для Вашей учетной записи.
</p>
<div align="center">
    <a
        href="{{ $url }}"
        style="
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        position: relative;
        -webkit-text-size-adjust: none;
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        overflow: hidden;
        text-decoration: none;
        background-color: #2d3748;
        border-bottom: 8px solid #2d3748;
        border-left: 18px solid #2d3748;
        border-right: 18px solid #2d3748;
        border-top: 8px solid #2d3748;"
        target="_blank" 
        rel="noopener noreferrer">
        Сбросить пароль
    </a>
</div>
<p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; Margin: 0; margin-bottom: 16px;">
    Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.
</p>
<p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; Margin: 0; margin-bottom: 16px;">
    С уважением, <br>Songbar
</p>
<p
    style="box-sizing:border-box;font-family:'-apple-system' , 'blinkmacsystemfont' , 'segoe ui' , 'roboto' , 'helvetica' , 'arial' , sans-serif , 'apple color emoji' , 'segoe ui emoji' , 'segoe ui symbol';font-size:14px;line-height:1.5em;margin-top:15px;text-align:left">
    Если у вас возникли проблемы с нажатием кнопки "Сбросить пароль", скопируйте и вставьте URL-адрес, указанный ниже в
    адресную строку браузера: <span class="c4f3af36893d04dabreak-all"
        style="box-sizing:border-box;font-family:'-apple-system' , 'blinkmacsystemfont' , 'segoe ui' , 'roboto' , 'helvetica' , 'arial' , sans-serif , 'apple color emoji' , 'segoe ui emoji' , 'segoe ui symbol';word-break:break-all"><a
            href="{{ $url }}"
            style="box-sizing:border-box;color:#3869d4;font-family:'-apple-system' , 'blinkmacsystemfont' , 'segoe ui' , 'roboto' , 'helvetica' , 'arial' , sans-serif , 'apple color emoji' , 'segoe ui emoji' , 'segoe ui symbol'"
            data-link-id="8" target="_blank" rel="noopener noreferrer">{{ $url }}</a></span>
</p>
@endsection