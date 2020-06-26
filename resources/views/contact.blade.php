@extends('layouts.base')


@section('content')

@include ('includes.url_line')

		<article>
	        <div class="container text-area">

        		<h1>{{ $con->name }}</h1>

	        	<div class="contact-page">

	    	   		<div class="contact-page_block">
	        			
	    	   			<div class="contact-page_block-left">

			        		<h2>Медицинский центр НеоМедикал</h2>

	    	   				<div class="contact-page_address">
	    	   					<h2>Адрес:</h2>

	    	   					<p><strong>г. Минск, ул. Романовская Слобода, 26</strong><br>
	    	   					(станция метро «Фрунзенская»)</p>
	    	   				</div>

	    	   				<div class="contact-page_work-time">
	    	   					<h2>Время работы:</h2>

	    	   					<p><strong>08:00 - 21:00</strong> ежедневно</p>
	    	   				</div>

	    	   				<div class="contact-page_phones">
	    	   					<h2>Телефоны:</h2>

	    	   					<img src="/img/tel_ico.png" alt="иконка телефон">
	    	   					<a href="tel:+375172704848" title="Позвоните нам!">+375 (17) <strong>270 48 48</strong></a>
	    	   					<br>
	    	   					<img src="/img/tel_ico.png" alt="иконка телефон">
	    	   					<a href="tel:+375172704613" title="Позвоните нам!">+375 (17) <strong>270 46 13</strong></a>
	    	   					<br>
	    	   					<img src="/img/a1_ico.png" alt="иконка a1">
	    	   					<a href="tel:+375296182000" title="Позвоните нам!">+375 (29) <strong>618 20 00</strong></a>
	    	   					<br>
	    	   					<img src="/img/a1_ico.png" alt="иконка a1">
	    	   					<a href="tel:+375296198000" title="Позвоните нам!">+375 (29) <strong>619 80 00</strong></a>
	    	   				</div>

	    	   				<div class="contact-page_phones">
	    	   					<h2>Мессенджеры:</h2>

	    	   					<a href="viber:+375296182000"><img src="/img/viber_ico.png" alt="иконка viber"></a>
	    	   					<a href="whatsapp:+375296182000"><img src="/img/whatsapp_ico.png" alt="иконка whatsapp"></a>
	    	   					<a href="tg://resolve?domain=nikname" target="_blank"><img src="/img/telegram_ico.png" alt="иконка telegram"></a>
	    	   					<a href="tel:+375296182000" title="Позвоните нам!">+375 (29) <strong>618 20 00</strong></a>
	    	   					<br>
	    	   					<img src="/img/viber_ico.png" alt="иконка viber">
	    	   					<img src="/img/whatsapp_ico.png" alt="иконка whatsapp">
	    	   					<img src="/img/telegram_ico.png" alt="иконка telegram">
	    	   					<a href="tel:+375296198000" title="Позвоните нам!">+375 (29) <strong>619 80 00</strong></a>
	    	   				</div>

	    	   				<div class="contact-page_email">
	    	   					<h2>E-mail:</h2>

	    	   					<img src="/img/email_ico.png" alt="иконка email">
	    	   					<a href="mailto:info@neomedical.by" title="Напишите нам!">info@neomedical.by</a>
	    	   				</div>

	    	   			</div>


	    	   			<div class="contact-page_form">

	    	   				<h2>Написать нам через форму обратной связи</h2>

	    	   				<form method="post" action="{{ asset('contact/form') }}">
	    	   					{!! csrf_field() !!}

	    	   					<div>
	    	   						<p class="contact-page_input-header"><strong>Ваше имя: *</strong></p>
	    	   						@error('name')<p class="form_error_string">{!! $message !!}</p>@enderror
	    	   						<input type="text" name="name" placeholder="введите" title="Введите Имя" value="{{ old('name', '') }}" required>
	    	   					</div>

	    	   					<div>
	    	   						<p class="contact-page_input-header"><strong>Ваш телефон: *</strong></p>
	    	   						@error('phone')<p class="form_error_string">{!! $message !!}</p>@enderror
	    	   						<input type="tel" name="phone" placeholder="введите" title="Введите Ваш Телефон" value="{{ old('phone', '') }}" required>
	    	   					</div>

	    	   					<div>
	    	   						<p class="contact-page_input-header"><strong>Ваш e-mail:</strong></p>
	    	   						<input type="email" name="mail" placeholder="введите" title="Введите Ваш E-mail" value="{{ old('mail', '') }}">
	    	   					</div>

	    	   					<div class="contact-page_form_text">
	    	   						<p class="contact-page_input-header"><strong>Сообщение:</strong></p>
	    	   						<textarea name="text" placeholder="введите">{{ old('text', '') }}</textarea>
	    	   					</div>

	    	   					<div class="contact-page_form_submit">
	    	   						<input type="submit" name="submit" value="Отправить">
	    	   					</div>

	    	   				</form>

	    	   			</div>

	        		</div>

					<div class="contact-page_address">
		        		<h2>Карта проезда:</h2>

		        		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad965a0c3e57833100af5d8457269866f208be3cda0dceed75c7515a85e1ac053&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>

					</div>

	        	</div>
	        </div>
		</article>
@endsection
