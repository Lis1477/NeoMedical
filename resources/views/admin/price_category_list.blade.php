@extends('layouts.app')

@section('content')

@isset($resp)

        <div class="resp">
            {!! $resp !!}
        </div>
@endisset

        <h2>Выберите категорию прайс-листа для редактирования:</h2>
       	@foreach($services as $service)

        <div class="price-category_element">
        	<h3 class="price-category_services">{{ $service->name }}</h3>

        	@foreach($pr_cats as $main)
        		@if($main->service_id != $service->id) @continue @endif

        	<p class="price-category_main"><a href="{{ asset('adm/price-category/edit-form/'.$main->id) }}">{{ $main->name }}</a></p>

	        	@foreach($pr_cats as $sub)
	        		@if($sub->parent_id != $main->id) @continue @endif

        	<p class="price-category_sub"><a href="{{ asset('adm/price-category/edit-form/'.$sub->id) }}">{{ $sub->name }}</a></p>

	        	@endforeach
        	@endforeach

			<hr>

        </div>
       	@endforeach

@endsection