@extends('layouts.base')


@section('content')

@include ('includes.url_line')

		<article>
	        <div class="container text-area">

	        	<div class="about-center-page">
	        		<h1>{{ $about->name }}</h1>

	        		{!! $about->text !!}

	        		<div class="about-center-page_service-link">
	        			<a href="{{ asset('/uslugi') }}" target="_blank" title="Переход на страницу Услуги">Наши услуги</a>
	        		</div>

	        		<div class="about-center-page_gallery">
	        			<h2>Галерея</h2>

	        			<div class="about-center-page_gallery-block">
	        				@foreach($gal as $el)
								@php
								if(empty($el->alt)) $alt = "Медцентр «НеоМедикал»";
									else $alt = $el->alt;
								if(empty($el->title)) $ttl = "Медицинский центр «НеоМедикал»";
									else $ttl = $el->title;
								@endphp

	        				<div class="about-center-page_gallery-element">
	        					<a data-fancybox="images" data-caption="{{ $ttl }}" href="{{ asset('/img/'.$el->big_pic) }}">
		        					<img src="{{ asset('/img/'.$el->sm_pic) }}" alt="{{ $alt }}" title="{{ $ttl }}">
	        					</a>
	        				</div>

							@endforeach	        				
	        			</div>
	        		</div>

	        		<div class="about-center-page_lits">
	        			<h2>Лицензия</h2>

	        			<div class="about-center-page_lits-block">
	        				<div class="about-center-page_lits-element">
	        					<a data-fancybox="images2" data-caption="Лицензия, титульный лист" href="{{ asset('/img/litsensia_1_big.jpg') }}">
		        					<img src="{{ asset('/img/litsensia_1_sm.jpg') }}" alt="Лицензия, титульный лист" title="Лицензия, титульный лист">
	        					</a>
	        				</div>
	        				<div class="about-center-page_lits-element">
	        					<a data-fancybox="images2" data-caption="Лицензия, лист 2" href="{{ asset('/img/litsensia_2_big.jpg') }}">
		        					<img src="{{ asset('/img/litsensia_2_sm.jpg') }}" alt="Лицензия, лист 2" title="Лицензия, лист 2">
	        					</a>
	        				</div>
	        				<div class="about-center-page_lits-element">
	        					<a data-fancybox="images2" data-caption="Лицензия, лист 3" href="{{ asset('/img/litsensia_3_big.jpg') }}">
		        					<img src="{{ asset('/img/litsensia_3_sm.jpg') }}" alt="Лицензия, лист 3" title="Лицензия, лист 3">
	        					</a>
	        				</div>
	        			</div>
	        		</div>


	        	</div>
	        </div>
		</article>
@endsection

@section('css')
    @parent

        <link href="{{ asset('css/jquery.fancybox.css') }}" rel="stylesheet">

@endsection

@section('scripts')
    @parent

<script src="{{ asset('/js/jquery.fancybox.js') }}"></script>
<script>
$(function() {
$("[data-fancybox]").fancybox({loop:true});
});
</script>

@endsection
