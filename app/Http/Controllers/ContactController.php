<?php

namespace App\Http\Controllers;

use App\Category;

class ContactController extends Controller
{
	public function getIndex() {
		$con = $ur_1 = Category::find(4);

		if (empty($con->title)) {
			$title = $con->name." - Медицинский центр «НеоМедикал»";
		} else {
			$title = $con->title;
		}

		$description = $con->description;

		return view('contact', compact('ur_1', 'con', 'title', 'description'));
    }
}
