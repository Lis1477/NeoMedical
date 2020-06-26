<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления сайтом NEOMEDICAL.BY</title>
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="/image/x-icon">
    <link href="{{ asset('css/admstyles.css') }}" rel='stylesheet' type='text/css'>
@section('css')
@show

</head>

<body>

    <div class="admin-menu">

        <div class="logout_link">
            <a href="{{ asset('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>

            <form id="logout-form" action="{{ asset('logout') }}" method="POST" style="display: none;">
                {!!csrf_field()!!}
            </form>
        </div>

        <h2>Меню:</h2>

@if(Auth::user()->role == 'admin' || Auth::user()->role == 'redactor')
        <h3>Главные категории:</h3>
        <p><a href="{{ asset('adm/main-category/choice-category') }}" title="Редактирование главных категорий">Редактировать</a></p>
        <hr>

        <h3>Услуги:</h3>
        <p><a href="{{ asset('adm/service/choice-service') }}" title="Редактирование услуг">Редактировать</a></p>
        <hr>

        <h3>Слайдер:</h3>
        <p><a href="{{ asset('adm/slider') }}" title="Добавить/удалить изображение слайдера на Главной странице">Редактировать</a></p>
        <hr>

        <h3>Галерея:</h3>
        <p><a href="{{ asset('adm/gallery') }}" title="Добавить/редактировать/удалить изображение галереи на странице &laquoО центре&raquo">Редактировать</a></p>
        <hr>
@endif
        <h3>Прайс-лист категории:</h3>
        <p><a href="{{ asset('adm/price-category/add-form') }}" title="Добавить категорию прайса">Добавить</a></p>
        <p><a href="{{ asset('adm/price-category/list') }}" title="Редактировать/Удалить категорию прайса">Редактировать</a></p>

        <h3>Прайс-лист элементы:</h3>
        <p><a href="{{ asset('adm/price-add') }}" title="Добавить элемент прайса">Добавить</a></p>
        <p><a href="{{ asset('adm/price-choice') }}" title="Редактировать/Удалить элемент прайса">Редактировать</a></p>
        <hr>

@if(Auth::user()->role == 'admin')
        <h3>Управление администраторами:</h3>
        <p><a href="{{ asset('adm/admin/add-form') }}" title="Добавить администратора">Добавить</a></p>
        <p><a href="{{ asset('adm/admin/list') }}" title="Редактировать/Удалить администратора">Редактировать</a></p>
        <hr>
@endif

    </div>

    <div class="admin-content">
        <div class="header_logo">
            <a href="{{ asset('/adm') }}" title="Переход на Главную страницу Админки">
                <img src="{{ asset('img/logo.png') }}" alt="Логотип НЕОМЕДИКАЛ">
            </a>
        </div>

        <div class="admin-content_content">

            @yield('content')
            
        </div>


    </div>

@section('scripts')
@show

</body>
</html>