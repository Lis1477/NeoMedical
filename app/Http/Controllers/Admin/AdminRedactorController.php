<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;


class AdminRedactorController extends Controller
{
//***** Выводим форму добавления админа *************
    public function adminAddForm() {

        return view('admin.admin_add_form');
    }

//***** Выводим админов *****************************
    public function adminList() {
    	$adms = User::where('role', 'admin')->where('id', '!=', 1)->get();
    	$reds = User::where('role', 'redactor')->get();
    	$pr_reds = User::where('role', 'price_redactor')->get();

    	return view('admin.admin_list', compact('adms', 'reds', 'pr_reds'));
    }

//***** Добавляем админа ***************************
    public function adminAdd(Request $request) {

        // готовим переменные
        $login = Str::ascii(htmlspecialchars(trim($request->login), ENT_QUOTES), '_');
        if(!empty($request->name)) $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        	else $name = $login;
        $pass = Str::ascii(trim($request->password), '_');
        $secret_pass = bcrypt($pass);
        if(!empty($request->email)) $email = htmlspecialchars(trim($request->email), ENT_QUOTES);
        $role = htmlspecialchars(trim($request->role), ENT_QUOTES);

        // добавляем данные в бд
        $adm_add = new User;

        $adm_add->name = $name;
        $adm_add->login = $login;
        $adm_add->password = $secret_pass;
        if(!empty($request->email)) $adm_add->email = $email;
        $adm_add->role = $role;
        
        $adm_add->save();

        // готовим ответ
	    if($role == 'admin') $res_role = 'Администратора';
    	if($role == 'redactor') $res_role = 'Редактора';
    	if($role == 'price_redactor') $res_role = 'Прайс-Редактора';
        $res = "Данные {$res_role} {$name} успешно добавлены и отправлены на e-mail!";

        //отправляем сообщение добавляемому
        if(!empty($email)) {
	        $title = 'параметры входа в админ-панель сайта neomedical.by';
	        $body = "
<div>
    <p>Здравствуйте, {$name}!</p>
    <p>Администратор сайта NEOMEDICAL.BY добавил Вас как {$res_role} сайта.</p>
    <p>Пожалуйста, обратитесь к Администратору ".Auth::user()->name." для получения необходимой информации.</p>
</div>            
	        ";
	        $headers = array(
	          'MIME-Version' => '1.0',
	          'Content-type' => 'text/html; charset=utf-8',
	          'From' => 'admin@neomedical.by'
	        );

	        $mailing = mail($email, $title, $body, $headers);
        }
        //отправляем сообщение админу
        $title = "добавление {$res_role} сайта neomedical.by";
        $body = "
<div>
    <p>Здравствуйте, ".Auth::user()->name."!</p>
    <p>Для {$res_role} {$name} добавлены параметры входа в панель администратора.</p>
    <p>Логин: {$login}<br>
    Пароль: {$pass}</p>
    <p>В целях безопасности рекомендуется переписать данные в укромное место, сообщение удалить!</p>
</div>
        ";
        $headers = array(
          'MIME-Version' => '1.0',
          'Content-type' => 'text/html; charset=utf-8',
          'From' => 'admin@neomedical.by'
        );

        $mailing = mail(Auth::user()->email, $title, $body, $headers);

        // ВЫВОД ОШИБОК НА ЭКРАН

        return redirect()->back()->with(['res' => $res]);
	}

//***** Выводим форму редактирования админа *********
    public function adminEditForm($id) {

		$adm = User::find($id);

		$par = count(User::where('role', 'admin')->where('id', '!=', 1)->get('id'));

        return view('admin.admin_edit_form', compact('adm', 'par'));
    }

//***** Редактируем админа **************************
    public function adminEdit(Request $request, $id) {

        // готовим переменные
        $login = Str::ascii(htmlspecialchars(trim($request->login), ENT_QUOTES), '_');
        if(!empty($request->name)) $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        	else $name = $login;
        if(!empty($request->password)) $pass = Str::ascii(trim($request->password), '_');
        if(isset($pass)) $secret_pass = bcrypt($pass);
        $email = htmlspecialchars(trim($request->email), ENT_QUOTES);
        $role = htmlspecialchars(trim($request->role), ENT_QUOTES);
//dd($role);

        // обновляем данные в бд
        $adm_upd = User::find($id);
        $adm_upd->name = $name;
        $adm_upd->login = $login;
        if(isset($secret_pass)) $adm_upd->password = $secret_pass;
        $adm_upd->email = $email;
        $adm_upd->role = $role;
        
        $adm_upd->save();

        // готовим ответ
	    if($role == 'admin') $res_role = 'Администратора';
    	if($role == 'redactor') $res_role = 'Редактора';
    	if($role == 'price_redactor') $res_role = 'Прайс-Редактора';
        $res = "Данные {$res_role} успешно обновлены и отправлены на e-mail!";

        //отправляем сообщение редактиремому
        if(!empty($email)) {
	        $title = 'параметры входа в админ-панель сайта neomedical.by изменены';
	        $body = "
<div>
    <p>Здравствуйте, {$name}!</p>
    <p>Администратор сайта NEOMEDICAL.BY изменил параметры входа в панель администратора.</p>
    <p>Пожалуйста, обратитесь к ".Auth::user()->name." для получения необходимой информации.</p>
</div>            
	        ";
	        $headers = array(
	          'MIME-Version' => '1.0',
	          'Content-type' => 'text/html; charset=utf-8',
	          'From' => 'admin@neomedical.by'
	        );

	        $mailing = mail($email, $title, $body, $headers);
        }
        //отправляем сообщение админу
        $title = 'обновление параметров входа в админ-панель сайта neomedical.by';
        $body = "
<div>
    <p>Здравствуйте, ".Auth::user()->name."!</p>
    <p>Для {$res_role} {$name} изменены параметры входа в панель администратора.</p>
    <p>Имя: {$name}<br>
    <p>Логин: {$login}<br>
    	";
    	if(isset($pass)) $body .= "
    Пароль: {$pass}
    	";
    	$body .= "
    </p>
    <p>В целях безопасности рекомендуется переписать данные в укромное место, сообщение удалить!</p>
</div>
        ";
        $headers = array(
          'MIME-Version' => '1.0',
          'Content-type' => 'text/html; charset=utf-8',
          'From' => 'admin@neomedical.by'
        );

        $mailing = mail(Auth::user()->email, $title, $body, $headers);

        // ВЫВОД ОШИБОК НА ЭКРАН

        return redirect()->back()->with(['res' => $res]);
	}

//***** Удаляем админа **************************
    function adminDelete($id) {
    	// берем имя и роль удаляемого
    	$adm_old = User::where('id', $id)->first(['name', 'role']);

    	// удаляем
        $adm = User::where('id', $id)->delete();

        // готовим ответ
	    if($adm_old->role == 'admin') $res_role = 'Администратора';
    	if($adm_old->role == 'redactor') $res_role = 'Редактора';
    	if($adm_old->role == 'price_redactor') $res_role = 'Прайс-Редактора';
        $resp = "Данные {$res_role} {$adm_old->name} удалены.";

        // берем данные для вывода админов
       	$adms = User::where('role', 'admin')->where('id', '!=', 1)->get();
    	$reds = User::where('role', 'redactor')->get();
    	$pr_reds = User::where('role', 'price_redactor')->get();

    	return view('admin.admin_list', compact('adms', 'reds', 'pr_reds', 'resp'));

    }
}
