<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\PriceCategory;


class PriceCategoryController extends Controller
{
//***** Выводим форму добавления категории ************
    public function priceCategoryAddForm() {

        $services = Service::orderby('order')->get(['id', 'name']);

        $pr_cats = PriceCategory::
        orderby('order')
        ->where('parent_id', 0)
        ->get(['id', 'name', 'service_id']);

        return view('admin.price_category_add_form', compact('services', 'pr_cats'));
    }

//***** Добавляем категорию ****************************
    public function priceCategoryAdd(Request $request) {
        // проверяем переменные
        $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        $parent = htmlspecialchars(trim($request->parent), ENT_QUOTES);
        $display = intval($request->display);
        $order = intval($request->order);

        // выделяем параметры для родителя
        $parent_arr = explode("-", $parent);
        $service_id = $parent_arr[0];
        $parent_id = $parent_arr[1];

        // даем по умолчанию последний номер для сортировки
        if($order == 0) {
            if($parent_id == 0) {
                $srt = PriceCategory::
                    where('service_id', $service_id)
                    ->orderby('order', 'desc')
                    ->first('order');
            }
            if($service_id == 0) {
                $srt = PriceCategory::
                    where('parent_id', $parent_id)
                    ->orderby('order', 'desc')
                    ->first('order');
            }
            if($srt != null) $order = $srt->order + 1;
                else $order = 1;
        }

        // добавляем запись        
        $ins = DB::table('price_categories')
            ->insert([
                'name' => $name,
                'service_id' => $service_id,
                'parent_id' => $parent_id,
                'order' => $order,
                'display' => $display
            ]);

        // узнаем id новой категории
        $new_id = PriceCategory::orderby('id', 'desc')->first('id');
        $id = $new_id->id;
        // выбираем записи с индексом сортировки равное и болше редактируемого
        if($parent_id == 0) {
            $choice = PriceCategory::
                where('service_id', $service_id)
                ->where('order', '>=', $order)
                ->where('id', '!=', $id)
                ->get(['id', 'order'])->toArray();
        }
        if($service_id == 0) {
            $choice = PriceCategory::
                where('parent_id', $parent_id)
                ->where('order', '>=', $order)
                ->where('id', '!=', $id)
                ->get(['id', 'order'])->toArray();
        }

        if ($choice) {
            // увеличиваем значение сортировки на 1
            foreach ($choice as $value) {
                DB::table('price_categories')
                    ->where('id', $value['id'])
                    ->update([
                        'order' => ($value['order'] + 1)
                    ]);
            }
        }

        $res = "Прайс-категория &laquo;{$name}&raquo; добавлена успешно!<br>
            Для редактирования воспользуйтесь <a href='/adm/price-category/edit-form/{$id}'>ссылкой</a>";

        return redirect()->back()->with(['res' => $res]);
    }

//***** Выводим категории *****************************
    public function priceCategoryList() {

		$services = Service::orderby('order')->get();

		$pr_cats = PriceCategory::orderby('order')->get();

        return view('admin.price_category_list', compact('services', 'pr_cats'));
    }

//***** Выводим форму редактирования категории ********
    public function priceCategoryEditForm($id) {

		$services = Service::orderby('order')->get(['name', 'id']);

		$pr_cats = PriceCategory::
		orderby('order')
		->where('parent_id', 0)
		->get();

		$cat_choiced = PriceCategory::
		orderby('order')
		->where('id', $id)
		->first();


        return view('admin.price_category_edit_form', compact('services', 'pr_cats', 'cat_choiced'));
    }

//***** Редактируем категорию ****************************
    public function priceCategoryEdit(Request $request, $id) {
        // проверяем переменные
        $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        $parent = htmlspecialchars(trim($request->parent), ENT_QUOTES);
        $display = intval($request->display);
        $order = intval($request->order);

		// выделяем параметры для родителя
        $parent_arr = explode("-", $parent);
        $service_id = $parent_arr[0];
        $parent_id = $parent_arr[1];

        // обновляем запись        
        $upd = DB::table('price_categories')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'service_id' => $service_id,
                'parent_id' => $parent_id,
                'order' => $order,
                'display' => $display
            ]);

        // выбираем записи с индексом сортировки равное и болше редактируемого
        if($parent_id == 0) {
	        $choice = PriceCategory::
	            where('service_id', $service_id)
	            ->where('order', '>=', $order)
	            ->where('id', '!=', $id)
	            ->get(['id', 'order'])->toArray();
        }
        if($service_id == 0) {
	        $choice = PriceCategory::
	            where('parent_id', $parent_id)
	            ->where('order', '>=', $order)
	            ->where('id', '!=', $id)
	            ->get(['id', 'order'])->toArray();
        }

        if ($choice) {
            // увеличиваем значение сортировки на 1
            foreach ($choice as $value) {
                DB::table('price_categories')
                    ->where('id', $value['id'])
                    ->update([
                        'order' => ($value['order'] + 1)
                    ]);
            }
        }

        // делаем пересортировку элементов
        if($parent_id == 0) {
	        $call = PriceCategory::
	            where('service_id', $service_id)
	            ->orderby('order')
	            ->get(['id', 'order']);
		}
        if($service_id == 0) {
	        $call = PriceCategory::
	            where('parent_id', $parent_id)
	            ->orderby('order')
	            ->get(['id', 'order']);
		}

        $count = 1;
        foreach ($call as $value) {
            DB::table('price_categories')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        $res = "Обновлено успешно!";

        return redirect()->back()->with(['res' => $res]);
	}

//***** Удаляем Прайс-категорию из бд ************************

    function priceCategoryDelete($id) {
        // берем данные удаляемой категории
        $elemName = PriceCategory::where('id', $id)->first();

        // удаляем категорию
        DB::table('price_categories')->where('id', $id)->delete();

        // удаляем дочерние категории и элементы прайса
        $del_cats = PriceCategory::where('parent_id', $elemName->id)->get(['id'])->toArray();
        if(!empty($del_cats)) {
            foreach ($del_cats as $cat) {
                DB::table('prices')->where('category_id', $cat['id'])->delete();
            }
            DB::table('price_categories')->where('parent_id', $id)->delete();
        } else {
            DB::table('prices')->where('category_id', $id)->delete();
        }

        // делаем пересортировку оставшихся элементов
        if($elemName->parent_id == 0) {
            $call = PriceCategory::
                where('service_id', $elemName->service_id)
                ->orderby('order')
                ->get(['id', 'order']);
        }
        if($elemName->service_id == 0) {
            $call = PriceCategory::
                where('parent_id', $elemName->parent_id)
                ->orderby('order')
                ->get(['id', 'order']);
        }

        $count = 1;
        foreach ($call as $value) {
            DB::table('price_categories')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        // формируем ответ
        $resp = "Прайс-категория &laquo;{$elemName->name}&raquo; удалена.";

        // берем данные для вывода категорий
        $services = Service::orderby('order')->get();

        $pr_cats = PriceCategory::orderby('order')->get();

        return view('admin.price_category_list', compact('services', 'pr_cats', 'resp'));
    }
}
