<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
	public function getCategoryByName($name)
	{
		return Category::where('name', $name)
	    	->first();
	}

	public function getCategoryByParent($parent)
	{
		$categories = Category::nested()->get();
		$parent = collect($categories)->filter(function ($entry) use ($parent) {
			return strtolower($entry['name']) == strtolower($parent);
		})->first();

		return $parent['child'];
	}
}