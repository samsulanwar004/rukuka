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
}