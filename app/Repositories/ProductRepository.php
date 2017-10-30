<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\CategoryRepository;

class ProductRepository
{

	public $designer;

	public function getProductBySlugCategory($request, $slug)
	{
		$query = Product::whereHas('category', function ($query) use ($slug) {
            $query->where('slug', '=', $slug);
        });

        if ($request->has('price')) {
        	$query->orderBy('sell_price', $request->input('price'));
        } else {
        	$query->orderBy('id', 'desc');
        }

        return $query->paginate(30);
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

	public function getProductByCategory($request, $category)
	{
		$parents = (new CategoryRepository)->getCategoryByParent($category);

		$ids = [];
		if($parents) {
			foreach ($parents as $value) {
				foreach ($value['child'] as $value) {
					$ids[] = $value['id'];
				}
			}
		}

		$query = Product::whereHas('category', function ($query) use ($ids) {
            $query->whereIn('id', $ids);
        });

        if ($request->has('price')) {
        	$query->orderBy('sell_price', $request->input('price'));
        } else {
        	$query->orderBy('id', 'desc');
        }

        return $query->paginate(30);

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

	public function getProductByDesigner($request, $category)
	{

		$query = Product::whereHas('designer', function ($query) use ($category) {
            if ($category != 'all') {
            	$query->where('slug', $category);
            }
        });

        if ($request->has('price')) {
        	$query->orderBy('sell_price', $request->input('price'));
        } else {
        	$query->orderBy('id', 'desc');
        }
				$this->setDesigner($query->first()->designer);

        return $query->paginate(30);
	}

	public function setDesigner($value)
	{
		$this->designer = $value;

		return $this;
	}

	public function getDesigner()
	{
		return $this->designer;
	}
}
