@extends('layouts.app')

@section('content')

        <h2>Выберите раздел, в котором необходимо сделать правки.</h2>

        <div>
        	@foreach($srv as $item)
        	<p>
        		<a href="{{ asset('adm/price-edit/'.$item->id) }}">{{ $item->name }}</a>
        	</p>
        	@endforeach
        </div>

@endsection