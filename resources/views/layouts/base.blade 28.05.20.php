<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167773573-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167773573-1');
</script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description }}">
        <meta name="yandex-verification" content="b6df3d95bc38ff02" />
        <title>{{ $title }}</title>
        <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@section('css')
@show

    </head>
    <body>

        <header>

            <div class="header_info-line">
                <div class="container">
                    <div class="header_info-line_time-bl" title="Режим работы">
                        <img src="{{ asset('img/time_ico.png') }}">
                        <span><strong>08:00 - 21:00</strong> ежедневно</span>
                    </div>

                    <div class="header_info-line_vertical-line"></div>

                    <div class="header_info-line_phone-bl">
                        <img src="{{ asset('img/a1_ico.png') }}">
                        <a href="tel:+375296182000" title="Позвоните нам">
                            <span>+375 (29) <strong>618 20 00</strong></span>
                        </a>
                    </div>

                    <div class="header_info-line_vertical-line"></div>

                    <div class="header_info-line_online-but-bl">
                        <a href="{{ asset('/onlain-zapis') }}" title="Онлайн-запись на прием">Онлайн-запись</a>
                    </div>

                    <div class="header_info-line_vertical-line last"></div>

                    <div class="header_info-line_social-bl">
                        <a href="https://www.facebook.com/NeoMedicalBelarus/" title="Мы в Facebook" target="_blank">
                            <img src="{{ asset('img/fb_ico.png') }}">
                        </a>
                        <a href="https://www.instagram.com/neomedical.by/" title="Мы в Instagramm" target="_blank">
                            <img src="{{ asset('img/insta_ico.png') }}">
                        </a>
                    </div>

                    <div class="header_info-line_vertical-line last"></div>

                    <div class="header_info-line_call-bl" id="open-button">
                        <img src="{{ asset('img/call_me_ico.png') }}" alt="Заказать звонок" title="Заказать обратный звонок">
                    </div>
                </div>
            </div>

            <div class="header_menu-line">
                <div class="container">
                    <div class="header_menu-line_logo">
                        <a href="{{ asset('/') }}" title="Переход на Главную страницу">
                            <img src="{{ asset('img/logo.png') }}" alt="Логотип НЕОМЕДИКАЛ">
                        </a>
                    </div>

                    <div class="header_menu-line_menu-bl">
                        <nav id='cssmenu'>
                            <div id="head-mobile"></div> 
                            <div class="button"><span>Меню</span></div> 
                            <ul>
                                <li>
                                    <a href="{{ asset('/uslugi') }}"@if(isset($srv) || isset($srv_area)) class="active"@endif>Услуги</a>
                                </li>
                                <li>
                                    <a href="{{ asset('/o-tsentre') }}"@if(isset($about)) class="active"@endif>О центре</a>
                                </li>
                                <li>
                                    <a href="{{ asset('/tseny') }}"@if(isset($price)) class="active"@endif>Цены</a>
                                </li>
                                <li>
                                    <a href="{{ asset('/kontakty') }}"@if(isset($con)) class="active"@endif>Контакты</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    
                </div>
            </div>

        </header>

@yield('content')

        <footer>
            <div class="container">
                <div>
                    © 2020 ООО &laquo;НеоМедикал&raquo;
                </div>
            </div>
        </footer>

@include ('includes.call_me')

@if(session('note') || $errors->any())
    @include('includes.formNotification')
@endif

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(64405321, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/64405321" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script src="{{ asset('js/call_me.js') }}"></script>

<script src="{{ asset('js/main-menu.js') }}"></script>

@section('scripts')
@show

    </body>
</html>
