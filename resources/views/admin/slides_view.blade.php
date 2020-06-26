@extends('layouts.app')

@section('content')

        <h2>Добавление слайда</h2>

@if(session('success'))
		<div class="resp">
			{!! session('success') !!}
		</div>
@endif
@error('image')
		<div class="resp">
			{!! $message !!}
		</div>
@enderror

        <form action="{{ asset('adm/slider/add') }}" method="POST" enctype="multipart/form-data" class="add-slide-form">
        	{{ csrf_field() }}          
        	<p>Выберите изображение (<span class="form-notice">* Изображение должно быть горизонтальным, размером 2000 х 695 пикселей (или более в пропорции). Будет сохранено в формате ".jpg".</span>)</p>
        	<input type="file" name="image" accept="image/*" required>
        	<button type="submit">Загрузить</button>
        </form>


        <hr>

        <h2>Установка порядка сортировки, видимости и удаление слайдов</h2>

@if(session('resp'))
		<div class="resp">
			{!! session('resp') !!}
		</div>
@endif

        <div class="slides-view">
        	@foreach($slides as $slide)
        	<div class="slides-view_element" @if(session('slider_id') == $slide->id){!! 'style="background-color: pink;"' !!}@endif >

	        	<div class="slide-img">
    	    		<img src="{{ asset('img/'.$slide->img) }}">
        		</div>

        		<form method="POST" action="{{ asset('adm/slider-edit/'.$slide->id) }}">
					{!! csrf_field() !!}
        			<input type="number" name="order" value="{{ $slide->order }}" min="1" title="Установите порядок сортировки (вес)" class="number">
   					<select name="display" title="Установите видимость элемента">
						<option value="0" @if($slide->display == 0){{ 'selected' }}@endif>Скрыто</option>
						<option value="1" @if($slide->display == 1){{ 'selected' }}@endif>Видно</option>
					</select>
					<button type="submit">Сохранить</button>
	        		@if(session('res') && session('slider_id') == $slide->id)<span class="red">{{ session('res') }}</span>@endif
        		</form>

				<a href="{{ asset('adm/slide-del/'.$slide->id) }}" title="Удалить слайд" class="del-link" onclick="return confirm('Вы уверены? Действие необратимо!')">
					<img src="{{ asset('img/del_ico.png') }}">
				</a>

        	</div>
        	@endforeach
        </div>

@endsection