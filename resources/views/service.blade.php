@extends('layouts.base')


@section('content')

@include ('includes.url_line')

		<article>
	        <div class="container text-area">

	        	<div class="uslugi-page">
	        		<h1>Услуги</h1>

	        		<div class="uslugi-page_links-bl">
			            @foreach($srv as $service)

	        			<a href="{{ asset('/uslugi/'.$service->slug) }}" class="uslugi-page_links-bl_element" title="Жми, чтобы узнать больше">
		        			<div class="uslugi-page_links-bl_img">
					            <img src="{{ asset('img/'.$service->pic) }}" alt="{{ $service->name }}">
	    	    			</div>
	    	    			<div class="uslugi-page_links-bl_title">
					            {{ $service->name }}
	    	    			</div>
	        			</a>
           				@endforeach

	        		</div>
	        		
	        	</div>

	        </div>
		</article>


@endsection