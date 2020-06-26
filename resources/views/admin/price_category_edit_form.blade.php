@extends('layouts.app')

@section('content')

<h2>Отредактируйте данные прайс-категории &laquo;{{ $cat_choiced->name }}&raquo;:</h2>

@if(session('res'))
<div class="resp">
    {{ session('res') }}
</div>
@endif

<div class="price-category-edit-form">
    <form method="post" action="{{ asset('adm/price-category/edit/'.$cat_choiced->id) }}">
        {!! csrf_field() !!}
        <div>
            <p>Название Прайс-Категории (максимум 150 знаков):*</p>
            <input type="text" name="name" value="{{ $cat_choiced->name }}" title="Введите имя Прайс-Категории" maxlength="150" class="name" required onkeypress="if(event.keyCode == 13) return false;">
        </div>

        <div>
            <p>Выберите родителя:*</p>
            <select name="parent" class="parent" title="Выберите родителя для Прайс-Категории" required>
                @foreach($services as $service)

                <option value="{{ $service->id.'-0' }}"@if($cat_choiced->service_id == $service->id) {{ 'selected' }}@endif class="cat_0">{{ $service->name }}</option>

                    @foreach($pr_cats as $cat)@if($cat->service_id != $service->id) @continue @endif

                <option value="{{ '0-'.$cat->id }}"@if($cat_choiced->parent_id == $cat->id) {{ 'selected' }}@endif class="cat_1"> - {{ $cat->name }}</option>

                    @endforeach
                @endforeach
            </select>
        </div>

        <div>
            <p>Установите порядок сортировки (вес):</p>
            <input type="number" name="order" value="{{ $cat_choiced->order }}" min="1" class="number" title="Установите порядок сортировки (вес) Прайс-Категории" onkeypress="if(event.keyCode == 13) return false;">
        </div>

        <div>
            <p>Установите видимость:</p>
            <select name="display" class="display" title="Установите видимость Прайс-Категории">
                <option value='0'@if($cat_choiced->display == 0) {{ 'selected' }}@endif>Скрыто</option>
                <option value='1'@if($cat_choiced->display == 1) {{ 'selected' }}@endif>Видно</option>
            </select>
        </div>

        <div class="submit_but">
            <input type="submit" title="Обновить" value="Обновить">
        </div>

        <a href="{{ asset('/adm/price-category/del/'.$cat_choiced->id) }}" title="Удалить Прайс-Категорию" class="del-link" onclick="return confirm('Вы уверены? Действие необратимо!')"><img src="{{ asset('img/del_ico.png') }}"></a>
    </form>
</div>

<div>
    <p><span style="color: red; font-weight: bold;">Внимание!</span> При удалении Прайс-категории будут удалены ВСЕ подчиненные подкатегории и элементы Прайс-листа. <span style="color: red; font-weight: bold;">Будьте внимательны!</span></p>
</div>

@endsection