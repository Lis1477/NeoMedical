		<section class="url-line-section">
			<div class="container">
				<div class="url-line">
					<div>
						<a href="{{ asset('/') }}" title="Переход на Главную страницу">Главная</a> /

						@if(!isset($ur_2))

						<strong>{{ $ur_1['name'] }}</strong>

						@else

						<a href="{{ asset('/'.$ur_1['slug']) }}">{{ $ur_1['name'] }}</a> /
						<strong>{{ $ur_2['name'] }}</strong>

						@endif

					</div>
				</div>
			</div>
		</section>
