<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Service;


class ServiceController extends Controller
{
//***** Выводим направления *****************************

    public function choiceService() {

		$services = Service::orderby('order')->get();

        return view('admin.service_choice', compact('services'));
    }

//***** выводим форму для редактирования ****************

    public function serviceEditForm($id) {

    	$service = Service::where('id', $id)->first();

    	return view('admin.service_edit_form', compact('service'));
    }

//***** Редактируем Иконку направления ******************
    public function editIcon(Request $request, $id) {

     	// узнаем имя старой иконки
    	$service = Service::where('id', $id)->first('pic');

     	// валидация изображения
        $this->validate($request, [
            'image'  => 'required|image|mimes:png|max:1000'
           ]);
        
        // путь к папке
        $destinationPath = public_path('/img/');
        // имя файла изображения
        $imageName = "service_icon_{$id}_".time().".png";
        // создаем изображение, копируем в папку
        $image = $request->file('image');
        $image = Image::make($image)
        	->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
        	->save($destinationPath.$imageName);

        // записываем в бд новое имя иконки
        DB::table('services')
        	->where('id', $id)
        	->update([
        		'pic' => $imageName
        	]);

        // удаляем старую иконку
        unlink(public_path('img/'.$service->pic));

   	    return redirect()->back()->with(['res' => 'Новая иконка направления загружена!']);
    }

//***** Редактируем данные направления ******************
    public function editService(Request $request, $id) {
        // берем старые значения order и slug
        $old_srv = Service::where('id', $id)->first('slug', 'order');

        // готовим переменные
        $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        $slug = htmlspecialchars(trim($request->slug), ENT_QUOTES);
        $title = htmlspecialchars(trim($request->title), ENT_QUOTES);
        $description = htmlspecialchars(trim($request->description), ENT_QUOTES);
        $text = $request->text;
        $display = intval($request->display);
        $order = intval($request->order);

        // переопределяем slug при необходимости
        if($old_srv->slug != $slug) {
            if(empty($slug)) $slug = Str::slug($name, '-');
                else $slug = Str::slug($slug, '-');
        }

        // обновляем данные в бд
        $srv_upd = Service::find($id);
        if($srv_upd->name != $name) $srv_upd->name = $name;
        if($srv_upd->slug != $slug) $srv_upd->slug = $slug;
        if($srv_upd->title != $title) $srv_upd->title = $title;
        if($srv_upd->description != $description) $srv_upd->description = $description;
        if($srv_upd->text != $text) $srv_upd->text = $text;
        if($srv_upd->display != $display) $srv_upd->display = $display;
        if($srv_upd->order != $order) $srv_upd->order = $order;
        $srv_upd->save();

        // делаем пересортировку элементов
        if($old_srv->order != $order) {
            // выбираем записи с индексом сортировки равное и болше редактируемого
            $choice = Service::
                where('order', '>=', $order)
                ->where('id', '!=', $id)
                ->get(['id', 'order'])->toArray();

            if ($choice) {
                // увеличиваем значение сортировки на 1
                foreach ($choice as $value) {
                    DB::table('services')
                        ->where('id', $value['id'])
                        ->update([
                            'order' => ($value['order'] + 1)
                        ]);
                }
            }
            // пересортировываем
            $call = Service::
                orderby('order')
                ->get(['id', 'order']);
            $count = 1;
            foreach ($call as $value) {
                DB::table('services')
                    ->where('id', $value->id)
                    ->update([
                        'order' => $count
                    ]);
                $count++;
            }
        }

        return redirect()->back()->with(['res2' => 'Данные обновлены успешно!']);
    }
}
	