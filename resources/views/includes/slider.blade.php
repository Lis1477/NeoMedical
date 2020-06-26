		<section class="main-slider-section">

			<ul class="rslides">
				@foreach($sliders as $slider)

				<li><img src="{{ asset('img/'.$slider->img) }}" alt="{{ $slider->img }}"></li>

				@endforeach

			</ul>

		</section>
