@extends('layouts.app')

@section('content')

        <h2>Обновите данные категории &laquo;{{ $cat_choiced->name }}&raquo;.</h2>

@if(session('res'))
        <div class="resp">
            {{ session('res') }}
        </div>
@endif

        <form method="POST" action="{{ asset('adm/main-category/edit/'.$cat_choiced->id) }}" class="service_edit-form">
            {{ csrf_field() }}          

<!--
        	<div class="service_bottom">
        		<p>Название: *</p>
	        	<input type="text" name="name" value="{{ $cat_choiced->name }}" required class="txt-input">
        	</div>
-->

@if($cat_choiced->id != 5)

<!--
        	<div class="service_bottom">
        		<p>Псевдоним:<br>
        			(<span class="form-notice red">Внимание! Производить смену псевдонима НЕ РЕКОМЕНДУЕТСЯ! Это негативно повлияет на рейтинг в поисковых системах в связи с переиндексацией новой, с точки зрения поиска, страницы.</span> <span class="form-notice">Можно оставить пустым, будет сформирован автоматически.</span>)</p>
	        	<input type="text" name="slug" value="{{ $cat_choiced->slug }}" class="txt-input">
        	</div>
-->
@endif
@if($cat_choiced->id == 2)

        	<div>
        		<p>Текст: *</p>
        		<textarea id="summernote" name="text" required class="txt-textarea">{{ $cat_choiced->text }}</textarea>
        	</div>
@endif

        	<div class="service_bottom service_top">
        		<p>Описание (максимум 254 знака):<br>
        			(<span class="form-notice">Краткое описание должно содержать главную мысль страницы. Требуется только для тега description с целью лучшего отображения в поиске и продвижения в поисковых системах. Можно оставить пустым.</span>)</p>
        		<textarea name="description" maxlength="254" class="desc-textarea">{{ $cat_choiced->description }}</textarea>
        	</div>

        	<div class="service_bottom">
        		<p>Заголовок на ярлыке страницы (максимум 150 знаков):<br>
        			(<span class="form-notice">Требуется для тега title. Можно оставить пустым, будет сформирован автоматически.</span>)</p>
	        	<input type="text" name="title" value="{{ $cat_choiced->title }}" maxlength="150" class="txt-input">
        	</div>
@if($cat_choiced->id != 5)

<!--
        	<div class="service_bottom">
        		<p>Порядок сортировки (вес):</p>
       			<input type="number" name="order" value="{{ $cat_choiced->order }}" min="1" title="Установите порядок сортировки (вес)" class="number">
        	</div>

        	<div class="service_bottom">
        		<p>Видимость:</p>
				<select name="display" title="Установите видимость элемента">
					<option value="0" @if($cat_choiced->display == 0){{ 'selected' }}@endif>Скрыто</option>
					<option value="1" @if($cat_choiced->display == 1){{ 'selected' }}@endif>Видно</option>
				</select>
        	</div>
-->
@endif

        	<div>
				<button type="submit">Обновить</button>
        	</div>
        </form>

@endsection


@if($cat_choiced->id == 2)

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

@endif