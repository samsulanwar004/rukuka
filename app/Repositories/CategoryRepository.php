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

    public function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)
            ->first();
    }

	public function getCategoryByParent($parent)
	{
		$categories = $this->getCategories();

		$parent = collect($categories)->filter(function ($entry) use ($parent) {
			return strtolower($entry['name']) == strtolower($parent);
		})->first();

		return $parent['child'];
	}

	public function getCategories()
	{
		return Category::nested()->orderBy('slug', 'asc')->get();
	}

}