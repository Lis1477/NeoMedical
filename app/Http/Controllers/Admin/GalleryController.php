<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Gallery;

class GalleryController extends Controller
{
    function viewGallery() {
    	$pictures = Gallery::orderby('order')->get();

    	return view('admin.gallery_view', compact('pictures'));
    }

    function addGallery(Request $request) {

    	// валидация изображения
        $this->validate($request, [
            'image'  => 'required|image|mimes:jpg,jpeg,png,gif|max:10000'
           ]);
        
        // путь к папке
        $destinationPath = public_path('/img/');
        // имя файла изображения
        $imageNameBig = "gallery_big_".time().".jpg";
        $imageNameSmall = "gallery_sm_".time().".jpg";
        // создаем изображение, копируем в папку
        $image = $request->file('image');
        $image = Image::make($image)
        	->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
        	->save($destinationPath.$imageNameBig);
        $image = Image::make($image)
            ->resize(300, 194)
            ->save($destinationPath.$imageNameSmall);
        // назначаем номер сортировки
    	$ord = Gallery::orderby('order', 'desc')->first(['order']);
    	if($ord != null) $order = ($ord->order + 1);
    		else $order = 1;
    	// добавляем данные в базу
        $add = DB::table('galleries')
            ->insert([
                'big_pic' => $imageNameBig,
                'sm_pic' => $imageNameSmall,
                'order' => $order
            ]);
       
        return redirect()->back()->with('success', 'Изображение загружено!');
    }

    public function editGallery(Request $request, $id) {
        // проверяем переменные
        $title = htmlspecialchars(trim($request->title), ENT_QUOTES);
        $alt = htmlspecialchars(trim($request->alt), ENT_QUOTES);
        $display = intval($request->display);
        $order = intval($request->order);

        // обновляем запись        
        $upd = DB::table('galleries')
            ->where('id', $id)
            ->update([
                'title' => $title,
                'alt' => $alt,
                'order' => $order,
                'display' => $display,
            ]);

        // выбираем записи с индексом сортировки равное и болше редактируемого
        $choice = Gallery::
            where('order', '>=', $order)
            ->where('id', '!=', $id)
            ->get(['id', 'order'])->toArray();

        if ($choice) {
            // увеличиваем значение сортировки на 1
            foreach ($choice as $value) {
                DB::table('galleries')
                    ->where('id', $value['id'])
                    ->update([
                        'order' => ($value['order'] + 1)
                    ]);
            }
        }

        // делаем пересортировку элементов
        $call = Gallery::
            orderby('order')
            ->get();
        $count = 1;
        foreach ($call as $value) {
            DB::table('galleries')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        $res = "Успешно!";

        return redirect()->back()->with(['res' => $res, 'picture_id' => $id]);
    }

    function deleteGalleryElement($id) {

        $picName = Gallery::where('id', $id)->first(['big_pic', 'sm_pic']);

        $del = DB::table('galleries')->where('id', $id)->delete();
        if($del != 0) {
            @unlink(public_path('img/'.$picName->big_pic));
            @unlink(public_path('img/'.$picName->sm_pic));
        }

        $resp = "Изображение удалено!";

        // делаем пересортировку элементов
        $call = Gallery::
            orderby('order')
            ->get();
        $count = 1;
        foreach ($call as $value) {
            DB::table('galleries')
                ->where('id', $value->id)
                ->update([
                    'order' => $count
                ]);
            $count++;
        }

        return redirect()->back()->with(['resp' => $resp]);
    }
}

