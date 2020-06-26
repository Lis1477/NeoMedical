<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gallery;

class AboutCenterController extends Controller
{
	public function getIndex() {
		$about = $ur_1 = Category::find(2);

		if (empty($about->title)) {
			$title = $about->name." - Медицинский центр «НеоМедикал»";
		} else {
			$title = $about->title;
		}
//dd($title);
		$description = $about->description;

		$gal = Gallery::where('display', 1)->orderby('order')->get();

		return view('about', compact('ur_1', 'about', 'title', 'description', 'gal'));
    }
}
