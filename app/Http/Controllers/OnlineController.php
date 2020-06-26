<?php

namespace App\Http\Controllers;

use App\Service;

class OnlineController extends Controller
{
	public function getIndex() {
		$ser = Service::where('display', 1)->orderby('order')->get();

		$title = "Онлайн-запись на прием - Медицинский центр «НеоМедикал»";

		$description = "Онлайн-запись на прием в Медицинский центр НеоМедикал";

		$ur_1 = array();
		$ur_1['name'] = 'Онлайн-запись';

 		return view('online', compact('ur_1', 'ser', 'title', 'description'));
    }
}
