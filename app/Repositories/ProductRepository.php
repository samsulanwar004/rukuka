<?php

namespace App\Repositories;

use App\Product;

class ProductRepository 
{

	public function getProducts($category, $slug)
	{
		return Product::whereHas('category', function ($query) use ($slug) {
            $query->where('slug', '=', $slug);
        })
        ->paginate(9);
	}

	public function getProductBySlug($slug)
	{
		return Product::where('slug', $slug)
    		->first();
	}

	public function getMostProduct()
	{
		return Product::take(4)
			->get();
	}
}