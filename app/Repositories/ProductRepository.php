<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\CategoryRepository;
use App\Designer;

class ProductRepository
{

	public $designer;

	public function model()
	{
		return new Product;
	}

	public function getProductBySlugCategory($request, $slug)
	{
		$query = $this->model()
			->whereHas('category', function ($query) use ($slug) {
	            $query->where('slug', '=', $slug);
	        })->whereNull('deleted_at');

        if ($request->has('price')) {
        	$query->orderBy('sell_price', $request->input('price'));
        } else {
        	$query->orderBy('id', 'desc');
        }

        return $query->paginate(12);
	}

    public function getProductBySlugCategorySale($request, $slug)
    {
        $query = $this->model()
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', '=', $slug);
            })->where('price_before_discount','>',0)->whereNull('deleted_at');

        if ($request->has('price')) {
            $query->orderBy('sell_price', $request->input('price'));
        } else {
            $query->orderBy('id', 'desc');
        }

        return $query->paginate(12);
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

		$query = $this->model()
			->whereHas('category', function ($query) use ($ids) {
	            $query->whereIn('id', $ids);
	        })->whereNull('deleted_at');

        if ($request->has('price')) {
        	$query->orderBy('sell_price', $request->input('price'));
        } else {
        	$query->orderBy('id', 'desc');
        }

        return $query->paginate(12);

	}

	public function getProductByCategorySale($request, $category)
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

		$query = $this->model()
			->whereHas('category', function ($query) use ($ids) {
	            $query->whereIn('id', $ids);
	        })->where('price_before_discount','>',0)->whereNull('deleted_at');

        if ($request->has('price')) {
        	$query->orderBy('sell_price', $request->input('price'));
        } else {
        	$query->orderBy('id', 'desc');
        }

        return $query->paginate(12);

	}

	public function getProductByDesigner($request, $category)
	{

		$query = $this->model()
			->whereHas('designer', function ($query) use ($category) {
	            if ($category != 'all') {
	            	$query->where('slug', $category);
	            }
	        });

        if ($request->has('price')) {
        	$query->orderBy('sell_price', $request->input('price'));
        } else {
        	$query->orderBy('id', 'desc');
        }

        if(count($query->get())){
            $this->setDesigner($query->first()->designer);
        }
        else{
            $this->setDesigner($this->getDesignerBySlug($category));
        }

        return $query->paginate(12);
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

    public function getProductBySlug($slug)
    {
        return $this->model()
            ->where('slug', $slug)
            ->first();
    }

    public function getMostProduct()
    {
        return $this->model()
            ->whereNull('deleted_at')
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

	public function getProductById($id)
	{
		return $this->model()
			->where('id', $id)
			->first();
	}

    public function getRelatedProduct($categoryId)
    {
        return $this->model()
            ->whereHas('category', function ($query) use ($categoryId) {
                $query->where('product_categories_id', '=', $categoryId);
            })
            ->inRandomOrder()
            ->whereNull('deleted_at')
            ->take(4)
            ->get();
    }

	public function getDesignerBySlug($slug)
    {
        return Designer::where('slug',$slug)->first();
    }

    public function getDesignerById($id)
    {
        return Designer::where('id',$id)->first();
    }
}
