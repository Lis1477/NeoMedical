@extends('layouts.base')


@section('content')

@include ('includes.url_line')

		<article>
	        <div class="container text-area">

	        	<div class="price-page">
	        		<h1>{{ $name }}</h1>

					<div class="price-page_open-close-price">
						<span id="open_price" title="Развернуть весь прайслист">развернуть</span>
						/
						<span id="close_price" title="Свернуть весь прайслист">свернуть</span>
					</div>

	        		<table class="first">
	        			<tr class="price-page_main-cat-title">
	        				<td class="price-page_header-tbl" colspan="2">Название услуги</td>
	        				<td class="price-page_cost-cell">Цена *</td>
	        			</tr>
	        		</table>

@foreach($ser as $service)

					<table>

	        			<tr class="price-page_main-cat-title">
	        				<td class="price-page_plus">
	        					<div>
	        						<img id="{{ str_replace('-', '_', $service->slug) }}" src="{{ asset('img/price_plus.png') }}" title="Раскрыть и посмотреть цены">
	        					</div>
	        				</td>
	        				<td colspan="2">{{ $service->name }}</td>
	        			</tr>

	        		</table>

					<div class="{{ str_replace('-', '_', $service->slug) }}" style="display: none;">
					<table>

	@foreach($price_cat as $cat)
		@if($cat->service_id == $service->id)

						<tr>
							<td class="price-page_cat-title" colspan="3">{{ $cat->name }}</td>
						</tr>

			@foreach($price as $cost)
				@if($cost->category_id == $cat->id)

						<tr>
							<td class="price-page_name-srv" colspan="2">{{ $cost->name }}</td>
							<td class="price-page_cost-srv">
								{{ $cost->remark_before }}
								{{ number_format((float)$cost->price, 2, '.', '') }} руб.
								{{ $cost->remark_after }}
							</td>
						</tr>

				@endif
			@endforeach

			@foreach($price_cat as $cat2)
				@if($cat2->parent_id == $cat->id)

						<tr>
							<td class="price-page_sub-cat-title" colspan="3">{{ $cat2->name }}</td>
						</tr>

					@foreach($price as $cost2)
						@if($cost2->category_id == $cat2->id)

						<tr>
							<td class="price-page_name-srv" colspan="2">{{ $cost2->name }}</td>
							<td class="price-page_cost-srv">
								{{ $cost2->remark_before }}
								{{ number_format((float)$cost2->price, 2, '.', '') }} руб.
								{{ $cost2->remark_after }}
							</td>
						</tr>

						@endif
					@endforeach
				@endif
			@endforeach
		@endif
	@endforeach

	        		</table>
					</div>
@endforeach
	        		
	        	</div>

	        	<div class="price-page_bottom-info">
	        		<p>* Цены на сайте представлены справочно, подробную информацию уточняйте у администратора центра</p>
	        	</div>

	        </div>
		</article>


@endsection

@section('scripts')
    @parent
<!-- Для отображения элементов прайслиста -->
<script type="text/javascript">

@foreach($ser as $service)

{{ str_replace('-', '_', $service->slug) }}.onclick = (function () {
	if(document.getElementsByClassName('{{ str_replace('-', '_', $service->slug) }}')[0].style.display == 'none') {
		document.getElementsByClassName('{{ str_replace('-', '_', $service->slug) }}')[0].style.display = 'block';
		{{ str_replace('-', '_', $service->slug) }}.style.marginLeft = '-30px';
		{{ str_replace('-', '_', $service->slug) }}.title = 'Закрыть';
	} else {
		document.getElementsByClassName('{{ str_replace('-', '_', $service->slug) }}')[0].style.display = 'none';
		{{ str_replace('-', '_', $service->slug) }}.style.marginLeft = '0';
		{{ str_replace('-', '_', $service->slug) }}.title = 'Раскрыть и посмотреть цены';
	}
});

@endforeach

open_price.onclick = (function() {
	@foreach($ser as $service)

	document.getElementsByClassName('{{ str_replace('-', '_', $service->slug) }}')[0].style.display = 'block';
	{{ str_replace('-', '_', $service->slug) }}.style.marginLeft = '-30px';
	{{ str_replace('-', '_', $service->slug) }}.title = 'Закрыть';

	@endforeach
});

close_price.onclick = (function() {
	@foreach($ser as $service)

	document.getElementsByClassName('{{ str_replace('-', '_', $service->slug) }}')[0].style.display = 'none';
	{{ str_replace('-', '_', $service->slug) }}.style.marginLeft = '0';
	{{ str_replace('-', '_', $service->slug) }}.title = 'Раскрыть и посмотреть цены';

	@endforeach
});

</script>

@if(!empty($open_pr))
<script type="text/javascript">
	var open = document.getElementsByClassName('{{ str_replace('-', '_', $open_pr) }}')[0];
	if(open) {
		open.style.display = 'block';
		{{ str_replace('-', '_', $open_pr) }}.style.marginLeft = '-30px';
		{{ str_replace('-', '_', $open_pr) }}.title = 'Закрыть';
	}
</script>
@endif
@endsection
