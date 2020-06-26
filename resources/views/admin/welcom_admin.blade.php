@extends('layouts.app')

@section('content')

        <h2>Здравствуйте, {{ Auth::user()->name }}!<br>Добро пожаловать в панель управления контентом!</h2>

@endsection