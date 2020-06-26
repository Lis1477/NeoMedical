<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;

class ContactFormController extends Controller
{
    public function postIndex(ContactFormRequest $r) {

        $name = strip_tags(htmlspecialchars($r['name']));
        $phone = strip_tags(htmlspecialchars($r['phone']));
        $mail = strip_tags(htmlspecialchars($r['mail']));
        $text = strip_tags(htmlspecialchars($r['text']));

        $title = 'сообщение из ФОРМЫ ОБРАТНОЙ СВЯЗИ сайта neomedical.by!';
        $body = "
<div>
    <p>Имя: <strong>$name</strong></p>
    <p>Телефон: <strong>$phone</strong></p>
    <p>E-mail: <strong>$mail</strong></p>
    <p>Сообщение:<br><strong>$text</strong></p>
</div>            
        ";
        $headers = array(
          'MIME-Version' => '1.0',
          'Content-type' => 'text/html; charset=utf-8',
          'From' => 'info@neomedical.by'
        );

        $mailing = mail('info@neomedical.by', $title, $body, $headers);

   		if($mailing) $note = "Уважаемый(ая) $name!<br><br>Ваше сообщение отправлено!<br><br>Очень скоро мы свяжемся с Вами для уточнения деталей.";
            else $note = "Упс... Что-то пошло не так!<br><br>Попробуйте еще раз.";

   		return redirect()->back()->with(['note' => $note]);
    }
}
