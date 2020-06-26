@extends('layouts.base')


@section('content')

@include ('includes.url_line')

		<article>
	        <div class="container text-area">

        		<h1>Страница благодарности</h1>

	        	<div class="thanks-page_bl">
					<p class="thanks-page_thanks"><span>Спасибо</span><br>за Ваше обращение к нам!</p>

					<div class="thanks-page_line"></div>

					<p class="thanks-page_name">Уважаемый(ая) {{ $fio }}!</p>
					<p>Ваш запрос принят!<br>Очень скоро мы свяжемся с Вами для уточнения деталей.</p>

					<div class="thanks-page_line"></div>

					<div class="thanks-page_follow-socials">
						<p>Присоединяйтесь к нам в социальных сетях</p>

	                    <div class="header_info-line_social-bl">
    	                    <a href="https://www.facebook.com/NeoMedicalBelarus/" title="Мы в Facebook">
        	                    <img src="{{ asset('img/fb_ico.png') }}">
            	            </a>
                	        <a href="https://www.instagram.com/neomedical.by/" title="Мы в Instagramm">
                    	        <img src="{{ asset('img/insta_ico.png') }}">
                        	</a>
                    	</div>

					</div>

                    <div class="thanks-page_back-button">
                    	<a href="{{ asset('/uslugi') }}">
                    		<img src="{{ asset('img/back_ico.png') }}">
                    		Вернуться на сайт
                    	</a>
                    </div>

	        	</div>
	        </div>
		</article>
@endsection
