<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\CategoryRepository;
use App\Designer;
use App\ProductCategory;
use App\Popular;
use App\Color;

class ProductRepository
{

	public $designer;

    const COUNT_OF_PRODUCT = 60;

	public function model()
	{
		return new Product;
	}

	public function getProductBySlugCategory($request, $slug)
	{
		$query = \DB::table('products')
            ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id')
            ->take(1);
        })->join('product_categories', function ($join) use ($slug) {
            $join->on('products.product_categories_id', '=', 'product_categories.id')
            ->where('product_categories.slug', $slug);
        })
        ->select(
            'products.id as id', 
            'products.name as name', 
            'products.slug as slug', 
            'products.sell_price as sell_price', 
            'products.price_before_discount as price_before_discount', 
            'products.created_at as created_at',
            'product_images.photo as photo',
            'product_categories.name as category_name'
        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.id', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        } else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate(self::COUNT_OF_PRODUCT);
	}

    public function getProductBySlugCategorySale($request, $slug)
    {
        $query = \DB::table('products')
            ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id')
            ->take(1);
        })->join('product_categories', function ($join) use ($slug) {
            $join->on('products.product_categories_id', '=', 'product_categories.id')
            ->where('product_categories.slug', $slug);
        })
        ->select(
            'products.id as id', 
            'products.name as name', 
            'products.slug as slug', 
            'products.sell_price as sell_price', 
            'products.price_before_discount as price_before_discount', 
            'products.created_at as created_at',
            'product_images.photo as photo',
            'product_categories.name as category_name'
        )
        ->where('products.price_before_discount','>',0)
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.id', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        } else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate(self::COUNT_OF_PRODUCT);
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

        $query = \DB::table('products')
            ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id')
            ->take(1);
        })->join('product_categories', function ($join) use ($ids) {
            $join->on('products.product_categories_id', '=', 'product_categories.id')
            ->whereIn('product_categories.id', $ids);
        })
        ->select(
            'products.id as id', 
            'products.name as name', 
            'products.slug as slug', 
            'products.sell_price as sell_price', 
            'products.price_before_discount as price_before_discount', 
            'products.created_at as created_at',
            'product_images.photo as photo',
            'product_categories.name as category_name'
        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.id', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        } else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate(self::COUNT_OF_PRODUCT);

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

        $query = \DB::table('products')
            ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id')
            ->take(1);
        })->join('product_categories', function ($join) use ($ids) {
            $join->on('products.product_categories_id', '=', 'product_categories.id')
            ->whereIn('product_categories.id', $ids);
        })
        ->select(
            'products.id as id', 
            'products.name as name', 
            'products.slug as slug', 
            'products.sell_price as sell_price', 
            'products.price_before_discount as price_before_discount', 
            'products.created_at as created_at',
            'product_images.photo as photo',
            'product_categories.name as category_name'
        )
        ->where('products.price_before_discount','>',0)
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.id', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        } else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate(self::COUNT_OF_PRODUCT);

	}

	public function getProductByDesigner($request, $category)
	{

        $query = \DB::table('products')->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id')
            ->take(1);
        })->join('product_designers', function ($join) use ($category) {
            $join->on('products.product_designers_id', '=', 'product_designers.id');
            if ($category != 'all') {
                $join->where('product_designers.slug', $category);
            }
        })->select(
            'products.id as id', 
            'products.name as name', 
            'products.slug as slug', 
            'products.sell_price as sell_price', 
            'products.price_before_discount as price_before_discount', 
            'products.created_at as created_at',
            'product_images.photo as photo', 
            'product_designers.id as designer_id'
        )->whereNull('products.deleted_at');   

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.id', $colorId);
            });
        }

        if ($request->has('price')) {
        	$query->orderBy('products.sell_price', $request->input('price'));
        } else {
        	$query->orderBy('products.id', 'desc');
        }

        if ($category != 'all') {
            $this->setDesigner($this->getDesignerBySlug($category));
        }

        return $query->paginate(self::COUNT_OF_PRODUCT);
	}

    public function getProductBySlug($slug)
    {
        return $this->model()
            ->where('slug', $slug)
            ->first();
    }

    public function getProductById($id)
    {
        return $this->model()
            ->where('id', $id)
            ->first();
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

	public function getDesignerBySlug($slug)
    {
        return Designer::where('slug',$slug)->first();
    }

    public function getDesignerById($id)
    {
        return Designer::where('id',$id)->first();
    }

    public function getMostProduct($group)
    {
        return Popular::where('group_setting',$group)
            ->orderBy('order','asc')
            ->get();
    }

    public function getRelatedProduct($categoryId)
    {
        return $this->model()
            ->whereHas('category', function ($query) use ($categoryId) {
                $query->where('product_categories_id', '=', $categoryId);
            })
            ->inRandomOrder()
            ->where('is_active',1)
            ->whereNull('deleted_at')
            ->take(4)
            ->get();
    }

    public function getSearchCategory($request )
    {
        if($request->has('category'))
        {
            {
                $categories = (new CategoryRepository)->getCategoryByParent($request->input('category'));
                $categoryArr=[];
                foreach($categories as $category){
                    foreach($category['child'] as $cat){
                        $categoryArr[] =  $cat['id'];
                    }
                }
            }

            $query = $this->model()
                ->where('name','like','%'.$request->input('keyword').'%')
                ->whereIn('product_categories_id',$categoryArr)
                ->where('is_active',1)
                ->whereNull('deleted_at');
        }
        else
        {
            $query = $this->model()
                ->select('product_categories_id')
                ->where('name','like','%'.$request->input('keyword').'%')
                ->where('is_active',1)
                ->whereNull('deleted_at');
        }

        if ($request->has('price')) {
            $query->orderBy('sell_price', $request->input('price'));
        } else {
            $query->orderBy('id', 'desc');
        }

        return $query->get()->unique('product_categories_id');
    }

    public function getSearch($request )
    {
        if($request->has('category'))
        {

            if( $request->has('subcategory'))
            {
                $categories = (new CategoryRepository)->getCategoryBySlug($request->input('subcategory'));
                $categoryArr=[];
                $categoryArr[]=[$categories->id];
            }
            else{
                $categories = (new CategoryRepository)->getCategoryByParent($request->input('category'));
                $categoryArr=[];
                foreach($categories as $category){
                    foreach($category['child'] as $cat){
                        $categoryArr[] =  $cat['id'];
                    }
                }
            }
            $query = $this->model()
                ->where('name','like','%'.$request->input('keyword').'%')
                ->whereIn('product_categories_id',$categoryArr)
                ->where('is_active',1)
                ->whereNull('deleted_at');
        }
        else
        {
            $query = $this->model()
                ->where('name','like','%'.$request->input('keyword').'%')
                ->where('is_active',1)
                ->whereNull('deleted_at');
        }

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');
            $query->whereHas('palette', function ($query) use ($colorId) {
                $query->where('id', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('sell_price', $request->input('price'));
        } else {
            $query->orderBy('id', 'desc');
        }

        return $query->paginate(self::COUNT_OF_PRODUCT);
    }

    public function getProductByKeyword($keyword)
    {
        return $this->model($keyword)
            ->where('name','LIKE','%'.$keyword.'%')
            ->where('is_active',1)
            ->whereNull('deleted_at')
            ->get();
    }

    public function updateCountProductCategory($id){
        ProductCategory::where('id', $id)->increment('count');
    }

    public function getPopularSearch(){

        return ProductCategory::orderBy('count','desc')->take(5)->get();

    }

    public function getRecentlyViewedProduct($ids)
    {
        $orders = implode(',', $ids);
        return $this->model()
            ->whereIn('id', $ids)
            ->orderByRaw(\DB::raw("FIELD(id, $orders)"))
            ->take(4)
            ->get();
    }

    public function getLookbookProduct($ids)
    {
        $orders = implode(',', $ids);
        return $this->model()
            ->whereIn('id', $ids)
            ->orderByRaw(\DB::raw("FIELD(id, $orders)"))
            ->get();
    }

    public function getColorPalette()
    {
        return Color::get();
    }

}
