@extends('layouts.app')

@section('content')

<h2>Введите данные для новой Прайс-Категории:</h2>

@if(session('res'))
<div class="resp">
    {!! session('res') !!}
</div>
@endif

<div class="price-category-edit-form">
    <form method="post" action="{{ asset('adm/price-category/add') }}">
        {!! csrf_field() !!}
        <div>
            <p>Название Прайс-Категории: (максимум 150 знаков)*</p>
            <input type="text" name="name" value="" title="Введите имя Прайс-Категории" maxlength="150" class="name" required onkeypress="if(event.keyCode == 13) return false;">
        </div>

        <div>
            <p>Выберите родителя:*</p>
            <select name="parent" class="parent" title="Выберите родителя для Прайс-Категории" required>
                <option disabled selected value="">Выберите родителя</option>

                @foreach($services as $service)

                <option value="{{ $service->id.'-0' }}" class="cat_0">{{ $service->name }}</option>

                    @foreach($pr_cats as $cat)@if($cat->service_id != $service->id) @continue @endif

                <option value="{{ '0-'.$cat->id }}" class="cat_1"> - {{ $cat->name }}</option>

                    @endforeach
                @endforeach

            </select>
        </div>

        <div>
            <p>Установите порядок сортировки (вес) (если оставить 0, будет размещено в конце списка):</p>
            <input type="number" name="order" value="0" min="0" class="number" title="Установите порядок сортировки (вес) Прайс-Категории" onkeypress="if(event.keyCode == 13) return false;">
        </div>

        <div>
            <p>Установите видимость:</p>
            <select name="display" class="display" title="Установите видимость Прайс-Категории">
                <option value='0'>Скрыто</option>
                <option value='1' selected>Видно</option>
            </select>
        </div>

        <div class="submit_but">
            <input type="submit" title="Сохранить" value="Сохранить">
        </div>
    </form>
</div>

@endsection