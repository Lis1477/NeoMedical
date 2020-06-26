<?php

namespace App\Http\Controllers;

use App\Category;
use App\Service;
use App\Slider;

class BaseController extends Controller
{
	public function getIndex() {

		$main = Category::find(5);

		if (empty($main->title)) $title = "{$main->name} - Медицинский центр «НеоМедикал»";
			else $title = $main->title;

		if (empty($main->description)) $description = "";
			else $description = $main->description;

		$sliders = Slider::all('img');

		$sr1 = Service::where('display', 1)->orderby('order')->take(4)->get();
		$sr2 = Service::where('display', 1)->orderby('order')->offset(4)->take(4)->get();
		$sr3 = Service::where('display', 1)->orderby('order')->offset(8)->take(4)->get();

		
		return view('welcome', compact('sliders', 'sr1', 'sr2', 'sr3', 'title', 'description'));
	}
}
