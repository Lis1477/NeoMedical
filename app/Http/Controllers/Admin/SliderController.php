<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Slider;

class SliderController extends Controller
{
    function viewSlides() {
    	$slides = Slider::orderby('order')->get();

    	return view('admin.slides_view', compact('slides'));
    }

    function addSlide(Request $request) {

    	// валидация изображения
        $this->validate($request, [
            'image'  => 'required|image|mimes:jpg,jpeg,png,gif|max:10000'
           ]);
        
        // путь к папке
        $destinationPath = public_path('/img/');
        // имя файла изображения
        $imageName = "slide_".time().".jpg";
        // создаем изображение, копируем в папку
        $image = $request->file('image');
        $image = Image::make($image)
        	->resize(2000, 695)
        	->save($destinationPath.$imageName);
        // назначаем номер сортировки
    	$ord = Slider::orderby('order', 'desc')->first(['order']);
    	if($ord != null) $order = ($ord->order + 1);
    		else $order = 1;
    	// добавляем данные в базу
        $add = DB::table('sliders')
            ->insert([
                'img' => $imageName,
                'order' => $order
            ]);
       
        return redirect()->back()->with('success', 'Изображение загружено!');
    }

    public function editSlide(Request $request, $id) {
        // проверяем переменные
        $display = intval($request->display);
        $order = intval($request->order);

        // обновляем запись        
        $upd = DB::table('sliders')
            ->where('id', $id)
            ->update([
                'order' => $order,
                'display' => $display,
            ]);

        // выбираем записи с индексом сортировки равное и болше редактируемого
        $choice = Slider::
            where('order', '>=', $order)
            ->where('id', '!=', $id)
            ->get(['id', 'order'])->toArray();

        if ($choice) {
            // увеличиваем значение сортировки на 1
            foreach ($choice as $value) {
                DB::table('sliders')
                    ->where('id', $value['id'])
                    ->update([
                        'order' => ($value['order'] + 1)
                    ]);
            }
        }

        // делаем пересортировку элементов
        $call = Slider::
            orderby('order')
            ->get();
        $count = 1;
        foreach ($call as $value) {
            DB::table('sliders')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        $res = "Успешно!";

        return redirect()->back()->with(['res' => $res, 'slider_id' => $id]);
    }

    function deleteSlideElement($id) {

        $elemName = Slider::where('id', $id)->first('img');

        $del = DB::table('sliders')->where('id', $id)->delete();
        if($del != 0) @unlink(public_path('img/'.$elemName->img));

        $resp = "Слайд удален!";

        // делаем пересортировку элементов
        $call = Slider::
            orderby('order')
            ->get();
        $count = 1;
        foreach ($call as $value) {
            DB::table('sliders')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        return redirect()->back()->with(['resp' => $resp]);
    }
}

