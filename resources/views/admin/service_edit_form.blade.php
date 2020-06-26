@extends('layouts.app')

@section('content')

        <h2>Выберите новую иконку направления &laquo;{{ $service->name }}&raquo;, или оставьте без изменений.</h2>

@if(session('res'))
		<div class="resp">
			{{ session('res') }}
		</div>
@endif

		<div class="service_add-pic-bl">
	        <div>
	        	<p>Текущая иконка:</p>
	        	<img src="{{ asset('img/'.$service->pic) }}">
	        </div>

	        <form action="{{ asset('adm/service/edit-icon/'.$service->id) }}" method="POST" enctype="multipart/form-data" class="add-slide-form">
	        	{{ csrf_field() }}          
	        	<p>Выберите иконку (<span class="form-notice">* Изображение должно быть формата ".png", с прозрачным фоном, размером по горизонтали минимум 90 пикселей.</span>)</p>
	        	<input type="file" name="image" accept="image/*" required>
	        	<button type="submit">Загрузить</button>
	        </form>
		</div>

		<hr>

        <h2>Обновите информацию направления &laquo;{{ $service->name }}&raquo;.</h2>

@if(session('res2'))
        <div class="resp">
            {{ session('res2') }}
        </div>
@endif

        <form method="POST" action="{{ asset('adm/service/edit/'.$service->id) }}" class="service_edit-form">
            {{ csrf_field() }}          
        	<div class="service_bottom">
        		<p>Название (максимум 150 знаков):*</p>
	        	<input type="text" name="name" value="{{ $service->name }}" maxlength="150" required class="txt-input">
        	</div>

        	<div class="service_bottom">
        		<p>Псевдоним (максимум 150 знаков):<br>
        			(<span class="form-notice red">Внимание! Производить смену псевдонима НЕ РЕКОМЕНДУЕТСЯ! Это негативно повлияет на рейтинг в поисковых системах в связи с переиндексацией новой, с точки зрения поиска, страницы.</span> <span class="form-notice">Можно оставить пустым, будет сформирован автоматически.</span>)</p>
	        	<input type="text" name="slug" value="{{ $service->slug }}" maxlength="150" class="txt-input">
        	</div>

        	<div>
        		<p>Текст: *</p>
        		<textarea id="summernote" name="text" required class="txt-textarea">{{ $service->text }}</textarea>
        	</div>

        	<div class="service_bottom service_top">
        		<p>Описание (максимум 254 знака):<br>
        			(<span class="form-notice">Краткое описание должно содержать главную мысль страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставить пустым.</span>)</p>
        		<textarea name="description" maxlength="254" class="desc-textarea">{{ $service->description }}</textarea>
        	</div>

        	<div class="service_bottom">
        		<p>Заголовок на ярлыке страницы (максимум 150 знаков):<br>
        			(<span class="form-notice">Требуется для тега title. Можно оставить пустым, будет сформирован автоматически.</span>)</p>
	        	<input type="text" name="title" value="{{ $service->title }}" maxlength="150" class="txt-input">
        	</div>

        	<div class="service_bottom">
        		<p>Порядок сортировки (вес):</p>
       			<input type="number" name="order" value="{{ $service->order }}" min="1" title="Установите порядок сортировки (вес)" class="number">
        	</div>
<!--
        	<div class="service_bottom">
        		<p>Видимость:</p>
				<select name="display" title="Установите видимость элемента">
					<option value="0" @if($service->display == 0){{ 'selected' }}@endif>Скрыто</option>
					<option value="1" @if($service->display == 1){{ 'selected' }}@endif>Видно</option>
				</select>
        	</div>
-->
        	<div>
				<button type="submit">Обновить</button>
        	</div>
        </form>

@endsection


@section('css')
    @parent
    <link href="{{ asset('css/summernote-lite.min.css') }}" rel='stylesheet' type='text/css'>
@endsection


@section('scripts')
    @parent
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/summernote-lite.min.js') }}"></script>
<script src="{{ asset('js/summernote-ru-RU.min.js') }}"></script>
<script>
	$(document).ready(function() {
	  $('#summernote').summernote({
	  	lang: "ru-RU",
	  	height: 300,
	  	placeholder: "Ведите данные"
	  });
	});
</script>
@endsection
