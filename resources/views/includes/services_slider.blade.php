		<section class="services-slider-section">

			<div class="container">

				<ul class="bxslider">

	        		<li class="services-slider_links-bl">
			            @foreach($sr1 as $service)

	        			<a href="{{ asset('/uslugi/'.$service->slug) }}" class="services-slider_links-bl_element" title="Жми, чтобы узнать больше" onclick="true">
		        			<div class="services-slider_links-bl_img">
					            <img src="{{ asset('img/'.$service->pic) }}" alt="{{ $service->name }}">
	    	    			</div>
	    	    			<div class="services-slider_links-bl_title">
					            {{ $service->name }}
	    	    			</div>
	        			</a>
           				@endforeach
	        		</li>
				
	        		<li class="services-slider_links-bl">
			            @foreach($sr2 as $service)

	        			<a href="{{ asset('/uslugi/'.$service->slug) }}" class="services-slider_links-bl_element" title="Жми, чтобы узнать больше" onclick="true">
		        			<div class="services-slider_links-bl_img">
					            <img src="{{ asset('img/'.$service->pic) }}" alt="{{ $service->name }}">
	    	    			</div>
	    	    			<div class="services-slider_links-bl_title">
					            {{ $service->name }}
	    	    			</div>
	        			</a>
           				@endforeach
	        		</li>

	        		<li class="services-slider_links-bl">
			            @foreach($sr3 as $service)

	        			<a href="{{ asset('/uslugi/'.$service->slug) }}" class="services-slider_links-bl_element" title="Жми, чтобы узнать больше" onclick="true">
		        			<div class="services-slider_links-bl_img">
					            <img src="{{ asset('img/'.$service->pic) }}" alt="{{ $service->name }}">
	    	    			</div>
	    	    			<div class="services-slider_links-bl_title">
					            {{ $service->name }}
	    	    			</div>
	        			</a>
           				@endforeach
	        		</li>
				</ul>
			</div>


		</section>
