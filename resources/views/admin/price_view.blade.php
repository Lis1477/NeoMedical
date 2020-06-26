@extends('layouts.app')

@section('content')

@if(session('resp'))
<div class="resp">
	{!! session('resp') !!}
	<hr>
</div>
@endif


<h2>Редактирование прайса раздела "{{ $srvs->name }}".</h2>

<div class="price-edit">
	@foreach($cats as $cat)@if($cat->service_id != $srvs->id) @continue @endif

	<p class="cat_0">
		{{ $cat->name }}
	</p>

	@foreach($prices as $price)@if($price->category_id != $cat->id) @continue @endif

	<form @if(session('price_id') == $price->id){!! 'style="background-color: pink;"' !!}@endif method="post" action="{{ asset('adm/price-edit/edit/'.$price->id) }}">
		{!! csrf_field() !!}
		<textarea name="name" class="name" title="Введите содержание услуги (максимум 254 знака)" maxlength="254" required>{{ $price->name }}</textarea>
		<input type="text" name="remark_before" value="{{ $price->remark_before }}" maxlength="15" class="remark_before" title="Ремарка ДО цены (максимум 15 знаков)">
		<input type="text" name="price" value="{{ $price->price }}" maxlength="7" required class="price" title="Установите цену - только число! (максимум 9999.99)">
		<input type="text" name="remark_after" value="{{ $price->remark_after }}" maxlength="15" class="remark_after" title="Ремарка ПОСЛЕ цены (максимум 15 знаков)">
		<input type="number" name="order" value="{{ $price->order }}" min="1" class="number" title="Установите порядок сортировки (вес)">
		<select name="display" class="display" title="Установите видимость элемента">
			<option value="0" @if($price->display == 0){{ 'selected' }}@endif>Скрыто</option>
			<option value="1" @if($price->display == 1){{ 'selected' }}@endif>Видно</option>
		</select>
		<select name="category_id" class="parent" title="Выберите родителя для элемента">
			@foreach($srvn as $sr)
			<option disabled class="cat_0">{{ $sr->name }}</option>
			@foreach($cats as $cat11)@if($cat11->service_id != $sr->id) @continue @endif
			<option value="{{ $cat11->id }}" @if($cat->id == $cat11->id){{ 'selected' }}@endif class="cat_1"> - {{ $cat11->name }}</option>
			@foreach($cats as $cat22)@if($cat22->parent_id != $cat11->id) @continue @endif
			<option value="{{ $cat22->id }}" class="cat_2"> -- {{ $cat22->name }}</option>
			@endforeach
			@endforeach
			@endforeach
		</select>
		<input type="button" title="Сохранить изменения" value="Редактировать" class="submit_but" onclick="this.parentNode.submit();"> @if(session('res') && session('price_id') == $price->id)<span class="red">{{ session('res') }}</span>@endif
		<a href="{{ asset('/adm/price-del/'.$price->id) }}" title="Удалить элемент из прайса" class="del-link" onclick="return confirm('Вы уверены? Действие необратимо!')"><img src="{{ asset('img/del_ico.png') }}"></a>
	</form>
	@endforeach
	@foreach($cats as $cat2)
	@if($cat2->parent_id != $cat->id) @continue @endif
	<p class="cat_2">
		{{ $cat2->name }}
	</p>

	@foreach($prices as $price)

	@if($price->category_id != $cat2->id) @continue @endif

	<form @if(session('price_id') == $price->id){!! 'style="background-color: pink;"' !!}@endif method="post" action="{{ asset('adm/price-edit/edit/'.$price->id) }}">
		{!! csrf_field() !!}
		<textarea name="name" class="name" title="Введите содержание услуги" required>{{ $price->name }}</textarea>
		<input type="text" name="remark_before" value="{{ $price->remark_before }}" class="remark_before" title="Ремарка ДО цены">
		<input type="text" name="price" value="{{ $price->price }}" required class="price" title="Установите цену - только число!">
		<input type="text" name="remark_after" value="{{ $price->remark_after }}" class="remark_after" title="Ремарка ПОСЛЕ цены">
		<input type="number" name="order" value="{{ $price->order }}" class="number" title="Установите порядок сортировки (вес)">
		<select name="display" class="display" title="Установите видимость элемента">
			<option value="0" @if($price->display == 0){{ 'selected' }}@endif>Скрыто</option>
			<option value="1" @if($price->display == 1){{ 'selected' }}@endif>Видно</option>
		</select>
		<select name="category_id" class="parent" title="Выберите родителя для элемента">
			@foreach($srvn as $sr)
			<option disabled class="cat_0">{{ $sr->name }}</option>
			@foreach($cats as $cat11)@if($cat11->service_id != $sr->id) @continue @endif
			<option value="{{ $cat11->id }}" class="cat_1"> - {{ $cat11->name }}</option>
			@foreach($cats as $cat22)@if($cat22->parent_id != $cat11->id) @continue @endif
			<option value="{{ $cat22->id }}" @if($cat22->id == $cat2->id){{ 'selected' }}@endif class="cat_2"> -- {{ $cat22->name }}</option>
			@endforeach
			@endforeach
			@endforeach
		</select>
		<input type="button" title="Сохранить изменения" value="Редактировать" class="submit_but" onclick="this.parentNode.submit();"> @if(session('res') && session('price_id') == $price->id)<span class="red">{{ session('res') }}</span>@endif
		<a href="{{ asset('/adm/price-del/'.$price->id) }}" title="Удалить элемент из прайса" class="del-link" onclick="return confirm('Вы уверены? Действие необратимо!')"><img src="{{ asset('img/del_ico.png') }}"></a>
	</form>
	@endforeach
	@endforeach
	@endforeach
</div>

@endsection