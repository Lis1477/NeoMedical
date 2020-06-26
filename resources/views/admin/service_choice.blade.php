@extends('layouts.app')

@section('content')

        <h2>Выберите направление, в котором необходимо сделать правки.</h2>

        <div>
        	@foreach($services as $item)
        	<p>
        		<a href="{{ asset('adm/service/edit-form/'.$item->id) }}">{{ $item->name }}</a>
        	</p>
        	@endforeach
        </div>

@endsection