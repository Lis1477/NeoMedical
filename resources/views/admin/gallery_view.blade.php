@extends('layouts.app')

@section('content')

        <h2>Добавление изображения в Галерею</h2>

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

        <form action="{{ asset('adm/gallery/add') }}" method="POST" enctype="multipart/form-data" class="add-slide-form">
        	{{ csrf_field() }}          
        	<p>Выберите изображение (<span class="form-notice">* Изображение должно быть горизонтальным. Предпочтительный размер от 1000х646 пикселей (или более в пропорции). Будет создано 2 изображения (основное и превью), сохранены в формате ".jpg".</span>)</p>
        	<input type="file" name="image" accept="image/*" required>
        	<button type="submit">Загрузить</button>
        </form>


        <hr>

        <h2>Редактирование элементов галереи</h2>

@if(session('resp'))
		<div class="resp">
			{!! session('resp') !!}
		</div>
@endif

        <div class="gallery-view">
        	@foreach($pictures as $picture)
        	<div class="gallery-view_element" @if(session('picture_id') == $picture->id){!! 'style="background-color: pink;"' !!}@endif >

	        	<div class="gallery-img">
    	    		<img src="{{ asset('img/'.$picture->sm_pic) }}">
        		</div>

                <form method="POST" action="{{ asset('adm/gallery-edit/'.$picture->id) }}">
                    {!! csrf_field() !!}
                    <p>Заголовок изображения (максимум 254 знака):</p>
                    <input type="text" name="title" value="{{ $picture->title }}" title="Заголовок для изображения (Если оставить пустым, будет сформирован автоматически.)" maxlength="254" class="text-input">
                    <p>Alt текст для изображения (максимум 100 знаков):</p>
                    <input type="text" name="alt" value="{{ $picture->alt }}" title="Текст который появляется на месте изображения, если в браузере отключено отображение изображений. (Можно оставить пустым.)" maxlength="100" class="text-input">
                    <input type="number" name="order" value="{{ $picture->order }}" min="1" title="Установите порядок сортировки (вес)" class="number">
                    <select name="display" title="Установите видимость элемента">
                        <option value="0" @if($picture->display == 0){{ 'selected' }}@endif>Скрыто</option>
                        <option value="1" @if($picture->display == 1){{ 'selected' }}@endif>Видно</option>
                    </select>
                    <button type="submit">Сохранить</button>
                    @if(session('res') && session('picture_id') == $picture->id)<span class="red">{{ session('res') }}</span>@endif
                </form>

                <a href="{{ asset('adm/gallery-del/'.$picture->id) }}" title="Удалить изображение" class="del-link" onclick="return confirm('Вы уверены? Действие необратимо!')">
                    <img src="{{ asset('img/del_ico.png') }}">
                </a>

        	</div>
        	@endforeach
        </div>

@endsection