@extends('layouts.base')


@section('content')

@include ('includes.slider')

@include ('includes.services_slider')

		<section class="main-page_our-advantage text-area">
			<div class="container">

				<h2>Наши преимущества</h2>

				<div class="main-page_our-advantage-bl">

					<div class="main-page_our-advantage-element">
						<div class="main-page_our-advantage_img">
							<img src="{{ asset('img/our_vibor.png') }}">
						</div>
						<div class="main-page_our-advantage_title">
							Большой выбор направлений
						</div>
					</div>

					<div class="main-page_our-advantage-element">
						<div class="main-page_our-advantage_img">
							<img src="{{ asset('img/our_oborud.png') }}">
						</div>
						<div class="main-page_our-advantage_title">
							Современное оборудование
						</div>
					</div>

					<div class="main-page_our-advantage-element">
						<div class="main-page_our-advantage_img">
							<img src="{{ asset('img/our_personal.png') }}">
						</div>
						<div class="main-page_our-advantage_title">
							Опытный персонал
						</div>
					</div>

					<div class="main-page_our-advantage-element">
						<div class="main-page_our-advantage_img">
							<img src="{{ asset('img/our_price.png') }}">
						</div>
						<div class="main-page_our-advantage_title">
							Доступная стоимость услуг
						</div>
					</div>

					<div class="main-page_our-advantage-element">
						<div class="main-page_our-advantage_img">
							<img src="{{ asset('img/our_raspol.png') }}">
						</div>
						<div class="main-page_our-advantage_title">
							Удобное расположение
						</div>
					</div>

					<div class="main-page_our-advantage-element">
						<div class="main-page_our-advantage_img">
							<img src="{{ asset('img/our_rezhim.png') }}">
						</div>
						<div class="main-page_our-advantage_title">
							Работаем ежедневно
						</div>
					</div>

				</div>
			</div>
		</section>

		<section class="main-page_map text-area">
			<div class="container">

				<h2>Как нас найти</h2>

				<p><strong>г. Минск, ул. Романовская Слобода, 26</strong> (в двух шагах от станции метро «Фрунзенская») </p>
			</div>

			<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad965a0c3e57833100af5d8457269866f208be3cda0dceed75c7515a85e1ac053&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>

		</section>


@endsection

@section('css')
    @parent

<link href="{{ asset('css/rslides.css') }}" rel="stylesheet">

@endsection

@section('scripts')
    @parent

<script src="{{ asset('js/responsiveslides.js') }}"></script>

<script>
	$(function() {
		$(".rslides").responsiveSlides({
auto: true,             // Анимация автоматически, true или false
speed: 2000,            // Скорость смены
timeout: 5000,          // Время между переходами
pager: false,           // Показывать нумерацию слайдов
nav: true,             // Показывать навигацию, true или false
random: false,          // Случайный показ слайдов true или false
pause: false,           // Пауза при наведении true или false
pauseControls: true,    // Пауза при наведении на кнопки навигации
prevText: "<img src='/img/slider_left.png'>",   // Текст кнопки "Назад"
nextText: "<img src='/img/slider_right.png'>",       // Текст кнопки "Следующий"
maxwidth: "",           // Максимальная ширина слайдера
navContainer: "",       // Контейнер слайдера, по умолчанию 'ul'
manualControls: "",     // Точки навигации
namespace: "links",   // класс слайдера
before: function(){},   // Function: Before callback
after: function(){}     // Function: After callback
		});
	});


</script>

<script src="{{ asset('js/jquery.bxslider.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){$('.bxslider').bxSlider();});
</script>
@endsection