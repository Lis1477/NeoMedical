@extends('layouts.app')

@section('content')

        <h2>Выберите категорию для редактирования:</h2>
       	@foreach($cats as $cat)

        <div class="price-category_element">
        	<p class="price-category_main"><a href="{{ asset('adm/main-category/edit-form/'.$cat->id) }}">{{ $cat->name }}</a></p>
        </div>
       	@endforeach

@endsection