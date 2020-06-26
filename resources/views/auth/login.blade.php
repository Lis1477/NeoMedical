@extends('layouts.base')


@section('content')

<div class="container">
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div>
            <p>Логин</p>
            @error('login')<span class="form_error_string">{{ $message }}</span>@enderror
            <input name="login" value="{{ old('login') }}" required autofocus>
        </div>

        <div>
            <p>Пароль</p>
            @error('password')<span class="form_error_string">{{ $message }}</span>@enderror
            <input type="password" name="password" required autocomplete="current-password">
        </div>

        <div>
            <input class="check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span>Запомнить меня</span>
        </div>

        <button type="submit">Войти</button>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">Забыл пароль?</a>
        @endif
    </form>
</div>

@endsection
