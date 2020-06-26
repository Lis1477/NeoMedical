@extends('layouts.app')

@section('content')

@isset($resp)

        <div class="resp">
            {!! $resp !!}
        </div>
@endisset

        <h2>Выберите Администратора (Редактора) для редактирования:</h2>

        <h3>Администраторы: <span class="form-notice">(Имеют доступ ко всем пунктам меню)</span></h3>
        

       	@foreach($adms as $adm)

        	<p><a href="{{ asset('adm/admin/edit-form/'.$adm->id) }}">{{ $adm->name }}</a></p>

       	@endforeach

       	<hr>

        <h3>Редакторы: <span class="form-notice">(Имеют доступ ко всем пунктам меню, кроме Управления администраторами)</span></h3>
        

       	@foreach($reds as $red)

        	<p><a href="{{ asset('adm/admin/edit-form/'.$red->id) }}">{{ $red->name }}</a></p>

       	@endforeach

       	<hr>
        <h3>Прайс-Редакторы: <span class="form-notice">(Имеют доступ только к пунктам меню редактирования прайс-листа)</span></h3>
        

       	@foreach($pr_reds as $pr_red)

        	<p><a href="{{ asset('adm/admin/edit-form/'.$pr_red->id) }}">{{ $pr_red->name }}</a></p>

       	@endforeach

@endsection