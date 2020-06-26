<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Service;
use App\PriceCategory;
use App\Price;

class PriceController extends Controller
{

//***** Выводим направления *****************************

    public function choiceService() {

		$srv = Service::orderby('order')->get();

        return view('admin.price_choice', compact('srv'));
    }

//***** Выводим выбранные прайсы *************************

    public function viewPrices($id) {

		$srvs = Service::where('id', $id)->first();

		$cats = PriceCategory::orderby('order')->get();

		$prices = Price::orderby('order')->get();

		$srvn = Service::orderby('order')->get(['id', 'name']);

        return view('admin.price_view', compact('srvs', 'cats', 'prices', 'srvn'));
    }

//***** Редактируем элемент прайса ***********************

    public function editPrice(Request $request, $id) {
        // проверяем переменные
        $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        $remark_before = htmlspecialchars(trim($request->remark_before), ENT_QUOTES);
        $remark_after = htmlspecialchars(trim($request->remark_after), ENT_QUOTES);
        $price = floatval(str_replace(',', '.', $request->price));
        $display = intval($request->display);
        $category_id = intval($request->category_id);
        $order = intval($request->order);

        // обновляем запись        
        $upd = DB::table('prices')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'remark_before' => $remark_before,
                'remark_after' => $remark_after,
                'price' => $price,
                'order' => $order,
                'display' => $display,
                'category_id' => $category_id
            ]);

        // выбираем записи с индексом сортировки равное и болше редактируемого
        $choice = Price::
            where('category_id', $category_id)
            ->where('order', '>=', $order)
            ->where('id', '!=', $id)
            ->get(['id', 'order'])->toArray();

        if ($choice) {
            // увеличиваем значение сортировки на 1
            foreach ($choice as $value) {
                DB::table('prices')
                    ->where('id', $value['id'])
                    ->update([
                        'order' => ($value['order'] + 1)
                    ]);
            }
        }

        // делаем пересортировку элементов
        $call = Price::
            where('category_id', $category_id)
            ->orderby('order')
            ->get();
        $count = 1;
        foreach ($call as $value) {
            DB::table('prices')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        $res = "Успешно!";

        return redirect()->back()->with(['res' => $res, 'price_id' => $id]);
    }

//***** Выводим форму для добавления элемента прайса **********

    public function priceAddForm() {

        $srvn = Service::orderby('order')->get(['id', 'name']);
        $cats = PriceCategory::orderby('order')->get();

        return view('admin.price_add_form', compact('srvn', 'cats'));
    }

//***** Добавляем элемент прайса в бд ************************

    public function addPrice(Request $request) {
        // проверяем переменные
        $name = htmlspecialchars(trim($request->name), ENT_QUOTES);
        $remark_before = htmlspecialchars(trim($request->remark_before), ENT_QUOTES);
        $remark_after = htmlspecialchars(trim($request->remark_after), ENT_QUOTES);
        $price = floatval(str_replace(',', '.', $request->price));
        $display = intval($request->display);
        $category_id = intval($request->category_id);
        $order = intval($request->order);
        // даем по умолчанию последний номер для сортировки
        if($order == 0) {
            $pr = Price::where('category_id', $category_id)->orderby('order', 'desc')->first('order');
            if($pr != null) $order = $pr->order + 1;
                else $order = 1;
        }

        // выбираем записи с индексом сортировки равное и болше редактируемого
        $choice = Price::
            where('category_id', $category_id)
            ->where('order', '>=', $order)
            ->get(['id', 'order'])->toArray();

        if ($choice) {
            // увеличиваем значение сортировки на 1
            foreach ($choice as $value) {
                DB::table('prices')
                    ->where('id', $value['id'])
                    ->update([
                        'order' => ($value['order'] + 1)
                    ]);
            }
        }
        
        // добавляем запись
        $add = DB::table('prices')
            ->insert([
                'name' => $name,
                'remark_before' => $remark_before,
                'remark_after' => $remark_after,
                'price' => $price,
                'order' => $order,
                'display' => $display,
                'category_id' => $category_id
            ]);

        // формируем ответ
        $cat = PriceCategory::where('id', $category_id)->first('name');
        $resp = "Услуга:<br>
        <strong>{$name}</strong><br>
        добавлена в раздел: <strong>{$cat->name}</strong>!<br>
        Если Вы допустили ошибку, отредактируйте через ссылку &laquoРедактировать&raquo.";

        return redirect()->back()->with(['resp' => $resp]);
    }

//***** Удаляем элемент прайса из бд ************************

    function deletePriceElement($id) {

        $elemName = Price::where('id', $id)->first(['name', 'category_id']);

        DB::table('prices')->where('id', $id)->delete();

        $resp = "Услуга<br>
            <strong>{$elemName->name}</strong><br>
            из прайса удалена.";

        // делаем пересортировку элементов
        $call = Price::
            where('category_id', $elemName->category_id)
            ->orderby('order')
            ->get();
        $count = 1;
        foreach ($call as $value) {
            DB::table('prices')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        return redirect()->back()->with(['resp' => $resp]);
    }
}
