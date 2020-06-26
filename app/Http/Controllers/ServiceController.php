<?php

namespace App\Http\Controllers;

use App\Service;
use App\Category;

class ServiceController extends Controller
{
	public function getIndex() {
		$cat = $ur_1 = Category::find(1);

		if (empty($cat->title)) {
			$title = $cat->name." - Медицинский центр «НеоМедикал»";
		} else {
			$title = $cat->title;
		}

		$description = $cat->description;

		$srv = Service::where('display', 1)->orderby('order')->get();

 		return view('service', compact('ur_1', 'srv', 'title', 'description'));
    }
}
