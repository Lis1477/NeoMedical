<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Category;


class MainCategoryController extends Controller
{
//***** Выводим категории *****************************
    public function mainCategoryList() {

		$cats = Category::orderby('order')->get();

        return view('admin.main_category_list', compact('cats'));
    }

//***** Выводим форму редактирования категории ********
    public function mainCategoryEditForm($id) {

		$cat_choiced = Category::
		orderby('order')
		->where('id', $id)
		->first();

        return view('admin.main_category_edit_form', compact('cat_choiced'));
    }

//***** Редактируем категорию ****************************
    public function mainCategoryEdit(Request $request, $id) {
        // берем значения из базы
        $cat_old = Category::where('id', $id)->first(['slug', 'order']);

        // готовим переменные
        if(isset($request->name)) $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        if(isset($request->slug)) $slug = htmlspecialchars(trim($request->slug), ENT_QUOTES);
        $title = htmlspecialchars(trim($request->title), ENT_QUOTES);
        $description = htmlspecialchars(trim($request->description), ENT_QUOTES);
        if(isset($request->text)) $text = $request->text;
        if(isset($request->order)) $order = intval($request->order);
        if(isset($request->display)) $display = intval($request->display);

        // переопределяем slug при необходимости
        if(isset($slug) && $cat_old->slug != $slug) {
            if(empty($slug)) $slug = Str::slug($name, '-');
                else $slug = Str::slug($slug, '-');
        }

        // обновляем данные в бд
        $cat_upd = Category::find($id);
        if(isset($name) && $cat_upd->name != $name) $cat_upd->name = $name;
        if(isset($slug) && $cat_upd->slug != $slug) $cat_upd->slug = $slug;
        if($cat_upd->title != $title) $cat_upd->title = $title;
        if($cat_upd->description != $description) $cat_upd->description = $description;
        if(isset($text) && $cat_upd->text != $text) $cat_upd->text = $text;
        if(isset($display) && $cat_upd->display != $display) $cat_upd->display = $display;
        if(isset($order) && $cat_upd->order != $order) $cat_upd->order = $order;
        $cat_upd->save();

        // делаем пересортировку элементов
        // if($cat_old->order != $order) {
        //     // выбираем записи с индексом сортировки равное и болше редактируемого
        //     $choice = Category::
        //         where('order', '>=', $order)
        //         ->where('id', '!=', $id)
        //         ->where('id', '!=', 5)  // отделяем главную страницу
        //         ->get(['id', 'order'])->toArray();

        //     if ($choice) {
        //         // увеличиваем значение сортировки на 1
        //         foreach ($choice as $value) {
        //             DB::table('categories')
        //                 ->where('id', $value['id'])
        //                 ->update([
        //                     'order' => ($value['order'] + 1)
        //                 ]);
        //         }
        //     }
        //     // пересортировываем
        //     $call = Category::
        //         where('id', '!=', 5)  // отделяем главную страницу
        //         ->orderby('order')
        //         ->get(['id', 'order']);
        //     $count = 1;
        //     foreach ($call as $value) {
        //         DB::table('categories')
        //             ->where('id', $value->id)
        //             ->update([
        //                 'order' => $count
        //             ]);
        //         $count++;
        //     }
        // }

        $res = "Категория обновлена успешно!";

        return redirect()->back()->with(['res' => $res]);
	}
}
