<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Category;

class ServiceAreaController extends Controller
{
	public function getIndex($slug) {
		$ur_1 = Category::find(1);
		$srv_area = $ur_2 = Service::where('slug', $slug)->first();

		if (empty($srv_area->title)) {
			$title = $srv_area->name." - Медицинский центр «НеоМедикал»";
		} else {
			$title = $srv_area->title;
		}

		$description = $srv_area->description;

 		return view('service_area', compact('ur_1', 'ur_2', 'srv_area', 'title', 'description'));
    }
}
