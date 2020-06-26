<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Service;
use App\PriceCategory;
use App\Price;

class PriceController extends Controller
{
	public function getIndex(Request $request) {
		$cat = $ur_1 = Category::find(3);

		if (empty($cat->title)) {
			$title = $cat->name." - Медицинский центр «НеоМедикал»";
		} else {
			$title = $cat->title;
		}

		$description = $cat->description;

		$name = $cat->name;

		$ser = Service::where('display', 1)->orderby('order')->get();

		$price_cat = PriceCategory::where('display', 1)->orderby('order')->get();

		$price = Price::where('display', 1)->orderby('order')->get();

		($request->p) ? $open_pr = $request->p : $open_pr = "";

 		return view('price', compact('ur_1', 'price', 'price_cat', 'ser', 'title', 'description', 'name', 'open_pr'));
    }
}
