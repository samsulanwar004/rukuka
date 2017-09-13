<?php

namespace App\Repositories;

use App\Product;

class ProductRepository 
{

	public function getProductBySlugCategory($slug)
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

	public function getProductByCategory($category)
	{
		return Product::whereHas('category', function ($query) use ($category) {
            $query->where('name', '=', $category);
        })
        ->paginate(9);
	}

	public function getRelatedProduct($categoryId)
	{
		return Product::whereHas('category', function ($query) use ($categoryId) {
            $query->where('product_categories_id', '=', $categoryId);
        })
        ->inRandomOrder()
        ->take(4)
        ->get();
	}
}