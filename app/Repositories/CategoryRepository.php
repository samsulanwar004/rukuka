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

	public function getCategoryByParent($parent, $child)
	{
		$categories = Category::nested()->get();
		$categories = collect($categories);
		$parent = $categories->filter(function ($entry) use ($parent) {
			return strtolower($entry['name']) == strtolower($parent);
		})->first();

		$childs = collect($parent['child']);

		$child = $childs->filter(function ($entry) use ($child) {
			return strtolower($entry['name']) == strtolower($child);
		})->first();

		return $child['child'];
	}
}