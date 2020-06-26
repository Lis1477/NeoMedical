<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallbackFormRequest;

class CallbackFormController extends Controller
{
    public function postIndex(CallbackFormRequest $r) {

        $name = strip_tags(htmlspecialchars($r['call_back_name']));
        $phone = strip_tags(htmlspecialchars($r['call_back_tel']));
        $day = strip_tags(htmlspecialchars($r['call_back_day']));
        $time = strip_tags(htmlspecialchars($r['call_back_time']));

        if($day == 'Завтра' && $time == 'Сейчас') $txt_time = '';
        	else $txt_time = ", $time";

        $title = 'Запрос ОБРАТНЫЙ ЗВОНОК с сайта neomedical.by';
        $body = "
<div>
    <p>Имя: <strong>$name</strong></p>
    <p>Телефон: <strong>$phone</strong></p>
    <p>Позвонить: <strong>$day$txt_time</strong></p>
</div>            
        ";
        $headers = array(
          'MIME-Version' => '1.0',
          'Content-type' => 'text/html; charset=utf-8',
          'From' => 'info@neomedical.by'
        );

        $mailing = mail('info@neomedical.by', $title, $body, $headers);

   		if($mailing) $note = "Ваш запрос отправлен!";
            else $note = "Упс... Что-то пошло не так!<br><br>Попробуйте еще раз.";

   		return redirect()->back()->with(['note' => $note]);
    }
}
