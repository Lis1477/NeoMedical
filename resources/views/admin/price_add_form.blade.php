@extends('layouts.app')

@section('content')

@if(session('resp'))
<div class="resp">
	{!! session('resp') !!}
	<hr>
</div>
@endif

<h2>Добавление услуги в прайс.</h2>

<div class="price-edit">
	<form method="post" action="{{ asset('adm/price-add/add') }}">
		{!! csrf_field() !!}
		<div>
			<p>Введите содержание услуги (максимум 254 знака):*</p>
			<textarea name="name" class="name" title="Введите содержание услуги" maxlength="254" required></textarea>
		</div>
		<div>
			<p>Ремарка ДО цены (максимум 15 знаков):</p>
			<input type="text" name="remark_before" value="" maxlength="15" class="remark_before" title="Ремарка ДО цены" onkeypress="if(event.keyCode == 13) return false;">
		</div>
		<div>
			<p>Установите цену услуги (только число! максимум 9999.99):*</p>
			<input type="text" name="price" value="" maxlength="7" required class="price" title="Установите цену - только число!" onkeypress="if(event.keyCode == 13) return false;">
		</div>
		<div>
			<p>Ремарка ПОСЛЕ цены (максимум 15 знаков):</p>
			<input type="text" name="remark_after" value="" maxlength="15" class="remark_after" title="Ремарка ПОСЛЕ цены" onkeypress="if(event.keyCode == 13) return false;">
		</div>
		<div>
			<p>Установите порядок сортировки (вес) услуги (если оставить "0", будет размещено в конце соответствующего раздела):</p>
			<input type="number" name="order" value="0" min="0" class="number" title="Установите порядок сортировки (вес)" onkeypress="if(event.keyCode == 13) return false;">
		</div>
		<div>
			<p>Установите видимость услуги:</p>
			<select name="display" class="display" title="Установите видимость элемента">
				<option value="0">Скрыто</option>
				<option value="1" selected>Видно</option>
			</select>
		</div>
		<div>
			<p>Выберите родительский каталог для услуги:*</p>
			<select name="category_id" class="parent" title="Выберите родителя для элемента" required>
				<option disabled selected value="">Выберите родителя</option>
				@foreach($srvn as $sr)
				<option disabled class="cat_0">{{ $sr->name }}</option>
				@foreach($cats as $cat11)@if($cat11->service_id != $sr->id) @continue @endif
				<option value="{{ $cat11->id }}" class="cat_1"> - {{ $cat11->name }}</option>
				@foreach($cats as $cat22)@if($cat22->parent_id != $cat11->id) @continue @endif
				<option value="{{ $cat22->id }}" class="cat_2"> -- {{ $cat22->name }}</option>
				@endforeach
				@endforeach
				@endforeach
			</select>
		</div>
		<div>
			<input type="submit" title="Сохранить" value="Сохранить" class="submit_but">
		</div>
	</form>
</div>

@endsection