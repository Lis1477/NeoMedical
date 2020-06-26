@extends('layouts.app')

@section('content')

        <h2>Обновите данные администратора &laquo;{{ $adm->name }}&raquo;.</h2>

@if(session('res'))
        <div class="resp">
            {{ session('res') }}
        </div>
@endif

        <form method="POST" action="{{ asset('adm/admin/edit/'.$adm->id) }}" class="service_edit-form">
            {{ csrf_field() }}          

        	<div class="service_bottom">
        		<p>Имя:<br>
                <span class="form-notice">(Максимум 30 знаков. Если оставить пустым, в поле Имя запишется Логин.)</span></p>
	        	<input type="text" name="name" value="{{ $adm->name }}" maxlength="30" class="txt-input">
        	</div>

            <div class="service_bottom">
                <p>Логин:*<br>
                <span class="form-notice">(Максимум 30 знаков. Не используйте кириллические символы!)</span></p>
                <input type="text" name="login" value="{{ $adm->login }}" maxlength="30" required class="txt-input">
            </div>

            <div class="service_bottom">
                <p>Новый Пароль:<br>
                <span class="form-notice">(Минимум 6 знаков, максимум 30 знаков. Не используйте кириллические символы! Если пароль менять не надо, оставьте пустым.)</span></p>
                <input type="password" name="password" value="" minlength="6" maxlength="30" class="txt-input">
            </div>

            <div class="service_bottom">
                <p>E-mail:<br>
                <span class="form-notice">(Если оставить пустым, данные для входа будут отправлены на admin@neomedical.by)</p>
                <input type="email" name="email" value="{{ $adm->email }}" maxlength="30" class="txt-input">
            </div>

@php
    if($adm->role == 'admin') $a_sel = ' selected'; else $a_sel = '';
    if($adm->role == 'redactor') $r_sel = ' selected'; else $r_sel = '';
    if($adm->role == 'price_redactor') $p_sel = ' selected'; else $p_sel = '';
    if($adm->role == 'admin' && $par == 1) $disabled = ' disabled'; else $disabled = '';
@endphp

            <div class="service_bottom">
                <p>Выберите роль:</p>
                <select name="role">
                    <option value="admin"{{ $a_sel }}>Администратор</option>
                    <option value="redactor"{{ $r_sel }}{{ $disabled }}>Редактор</option>
                    <option value="price_redactor"{{ $p_sel }}{{ $disabled }}>Прайс-редактор</option>
                </select>
            </div>

        	<div>
				<button type="submit">Обновить</button>
        	</div>

@if($adm->role != 'admin' || $par > 1)

        <a href="{{ asset('/adm/admin/del/'.$adm->id) }}" title="Удалить администратора" class="del-link" onclick="return confirm('Вы уверены? Действие необратимо!')"><img src="{{ asset('img/del_ico.png') }}"></a>
        </form>

@endif
@endsection
