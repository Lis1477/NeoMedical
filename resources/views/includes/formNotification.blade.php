<div class="subscribe-form-notification-wrapper">
    <div class="subscribe-form-notification-panel">
        <div class="close_notification">
            <img src="{{ asset('img/close_ico.png') }}" title="Закрыть окно">
        </div>
        <div class="subscribe-form-notification-text">
            <p>
            	@if(session('note'))
            		@if(session('name')) {{ session('name') }},<br>@endif {!! session('note') !!}
            	@endif
            	@if($errors->any()) При заполнении формы возникли ошибки!<br><br>Повторите попытку. @endif
            </p>
        </div>
    </div>
</div>


<script>
    var cl = document.getElementsByClassName('subscribe-form-notification-wrapper')[0];
    cl.onclick = () => cl.classList.add('wrapper-closed');
</script>
