@extends('layouts.base')


@section('content')

@include ('includes.url_line')

		<article>
	        <div class="container text-area">

	        	<div class="online-page">
	        		<h1>Онлайн-запись</h1>

			        <div class="online-page_form">

			        	<h2>Запись на приём</h2>

			        	<p class="online-page_header-form">
			        		Благодарим Вас за интерес к услугам нашего центра!<br>
			        		Заполните, пожалуйста, все обязательные поля формы, чтобы мы смогли с Вами оперативно связаться!
			        	</p>

			            <form method="post" action="{{ asset('/thanks-page') }}">
                			{!! csrf_field() !!}

			                <div class="online-page_form_fio">
			                	<p class="online-page_input-header"><strong>Фамилия и имя:</strong> обязательно *</p>
						        @error('fio')<p class="form_error_string">{!! $message !!}</p>@enderror
			                    <input type="text" name="fio" placeholder="введите" title="Введите Вашу Фамилию Имя" value="{{ old('fio', '') }}" required>
            			    </div>

			                <div class="online-page_form_phone">
			                	<p class="online-page_input-header"><strong>Телефон:</strong> обязательно *</p>
						        @error('phone')<p class="form_error_string">{!! $message !!}</p>@enderror
			                    <input type="tel" name="phone" placeholder="введите" title="Введите Ваш Телефон" value="{{ old('phone', '') }}" required>
            			    </div>

		                    <div class="online-page_form_service">
			                	<p class="online-page_input-header"><strong>Услуга:</strong> обязательно *</p>
						        @error('srv')<p class="form_error_string">{!! $message !!}</p>@enderror

                        		<select name="srv" required="required">
                            		<option selected disabled hidden>Выберите направление</option>
       					            @foreach($ser as $service)

		                            <option value="{{ $service->id }}"@if(old('srv') == $service->id){{ ' selected' }}@endif>{{ $service->name }}</option>
		                            @endforeach

		                        </select>
		                    </div>

		                    <div class="online-page_form_text">
			                	<p class="online-page_input-header"><strong>Жалоба / комментарий:</strong> необязательно</p>
		                    	<textarea name="text" placeholder="введите">{{ old('text', '') }}</textarea>
		                    </div>

		                    <div class="online-page_form_submit">
		                    	<input type="submit" name="submit" value="Записаться">
							</div>

            			</form>

			        </div>
	        	</div>
	        </div>
		</article>


@endsection