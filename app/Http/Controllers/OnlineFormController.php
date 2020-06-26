<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnlineFormRequest;
use App\Service;

class OnlineFormController extends Controller
{
    public function postIndex(OnlineFormRequest $r) {

        $fio = strip_tags(htmlspecialchars($r['fio']));
        $phone = strip_tags(htmlspecialchars($r['phone']));
        $srv = intval($r['srv']);
        $text = strip_tags(htmlspecialchars($r['text']));

        $serv = Service::where('id', $srv)->first('name');

        $title = 'ОНЛАЙН ЗАПИСЬ НА ПРИЕМ с сайта neomedical.by!';
        $body = "
<div>
    <p>Имя: <strong>$fio</strong></p>
    <p>Телефон: <strong>$phone</strong></p>
    <p>Направление: <strong>$serv->name</strong></p>
    <p>Комментарий:<br><strong>$text</strong></p>
</div>            
        ";
        $headers = array(
          'MIME-Version' => '1.0',
          'Content-type' => 'text/html; charset=UTF-8',
          'From' => 'info@neomedical.by'
        );

        $mailing = mail('info@neomedical.by', $title, $body, $headers);

   		if($mailing) {
        $title = "Страница благодарности - Медицинский центр «НеоМедикал»";
        $description = "";
        $ur_1 = array();
        $ur_1['name'] = 'Страница благодарности';

        
        return view('thanks', compact('fio', 'title', 'description', 'ur_1'));

      } else {
        $note = "Упс... Что-то пошло не так!<br><br>Попробуйте еще раз.";

        return redirect()->back()->with(['note' => $note]);
      }
    }
}
