@extends('layouts.app')

@section('content')

        <h2>Добавьте нового Администратора (Редактора).</h2>

@if(session('res'))
        <div class="resp">
            {{ session('res') }}
        </div>
@endif

        <form method="POST" action="{{ asset('adm/admin/add') }}" class="service_edit-form">
            {{ csrf_field() }}          

        	<div class="service_bottom">
        		<p>Имя:<br>
                <span class="form-notice">(Максимум 30 знаков. Если оставить пустым, в поле Имя запишется Логин.)</span></p>
	        	<input type="text" name="name" value="" maxlength="30" class="txt-input">
        	</div>

            <div class="service_bottom">
                <p>Логин:*<br>
                <span class="form-notice">(Максимум 30 знаков. Не используйте кириллические символы!)</span></p>
                <input type="text" name="login" value="" maxlength="30" required class="txt-input">
            </div>

            <div class="service_bottom">
                <p>Пароль:*<br>
                <span class="form-notice">(Минимум 6 знаков, максимум 30 знаков. Не используйте кириллические символы!)</span></p>
                <input type="password" name="password" value="" minlength="6" maxlength="30" required class="txt-input">
            </div>

            <div class="service_bottom">
                <p>E-mail:<br>
                <span class="form-notice">(Можно оставить пустым.)</p>
                <input type="email" name="email" value="" maxlength="30" class="txt-input">
            </div>

            <div class="service_bottom">
                <p>Выберите роль:</p>
                <select name="role" required>
                    <option value="" selected disabled>Выберите роль</option>
                    <option value="admin">Администратор</option>
                    <option value="redactor">Редактор</option>
                    <option value="price_redactor">Прайс-редактор</option>
                </select>
            </div>

        	<div>
				<button type="submit">Сохранить</button>
        	</div>
        </form>

@endsection
