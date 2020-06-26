@extends('layouts.base')


@section('content')

@include ('includes.url_line')

		<article>
	        <div class="container text-area">

	        	<div class="uslugi-text">
	        		<h1>{{ $srv_area->name }}</h1>

{!! $srv_area->text !!}

	        		<div class="service-price-link">
	        			<a href="{{ asset('/tseny?p='.$srv_area->slug) }}">Узнать стоимость услуг</a>
	        		</div>
	        		
	        		<div class="services-link">
	        			<a href="{{ asset('/uslugi') }}">Все наши услуги</a>
	        		</div>

	        	</div>

	        </div>
		</article>


@endsection