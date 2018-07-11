<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\CategoryRepository;
use App\Designer;
use App\ProductCategory;
use App\Services\CurrencyService;
use App\Popular;
use App\Color;
use App\ProductImage;

class ProductRepository
{

	public $designer;

    const COUNT_OF_PRODUCT = 36;

	public function model()
	{
		return new Product;
	}

	public function getProductBySlugCategory($request, $slug)
	{
		$query = \DB::table('products')->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
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
            'product_categories.name as category_name'
        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.name', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        } else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate($request->has('view') ? $request->input('view') : self::COUNT_OF_PRODUCT);
	}

    public function getProductBySlugCategorySale($request, $slug)
    {
        $query = \DB::table('products')->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
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
            'product_categories.name as category_name'
        )
        ->where('products.price_before_discount','>',0)
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.name', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        } else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate($request->has('view') ? $request->input('view') : self::COUNT_OF_PRODUCT);
    }

	public function getCategoryProduct($request, $menu = null)
	{
        $gender = $request->has('menu') ? $request->input('menu') : $menu;

        $query = \DB::table('products')->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');

        })->join('product_categories', function ($join) {
            $join->on('products.product_categories_id', '=', 'product_categories.id');
        })
        ->select(
            'product_categories.name as category_name', \DB::raw('count(*) as product_total')
        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at')
        ->whereIn('products.gender', [$gender,'unisex']);

        return $query->groupBy('product_categories.name')->get();
	}

	public function getCategoryProductDesigner($request)
	{
        $gender = $request->input('menu');
        $category = null;
        $parent = null;
        $designer = $request->input('designer');

        $query = \DB::table('products')->join('product_designers', function ($join) use ($designer) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');

            if ($designer) {
                $join->where('product_designers.slug', $designer);
            }

        })->join('product_categories', function ($join) use ($parent, $category) {
            $join->on('products.product_categories_id', '=', 'product_categories.id');

            if ($parent && $parent != 'all') {
                if ($category == 'all') {
                    $parents = (new CategoryRepository)->getCategoryByParent($parent);

                    $ids = [];
                    if($parents) {
                        foreach ($parents as $value) {
                            $ids[] = $value['id'];
                        }
                    }

                    if ($parents) {
                        $join->whereIn('product_categories.id', $ids);
                    }
                } else {
                    $join->where('product_categories.slug', $category);
                }
            }
        })
        ->select(
            'product_categories.name as category_name', \DB::raw('count(*) as product_total')
        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at')
        ->whereIn('products.gender', [$gender,'unisex']);

        return $query->groupBy('product_categories.name')->get();
	}

	public function getColorByProduct($request)
	{
        $gender = $request->input('menu');
        $category = $request->input('category');
        $parent = $request->input('parent');
        $designer = $request->input('designer');

        $query = \DB::table('products')->join('product_designers', function ($join) use ($designer) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');

            if ($designer) {
                $join->where('product_designers.slug', $designer);
            }

        })->join('product_categories', function ($join) use ($parent, $category) {
            $join->on('products.product_categories_id', '=', 'product_categories.id');

            if ($parent && $parent != 'all') {
                if ($category == 'all') {
                    $parents = (new CategoryRepository)->getCategoryByParent($parent);

                    $ids = [];
                    if($parents) {
                        foreach ($parents as $value) {
                            $ids[] = $value['id'];
                        }
                    }

                    if ($parents) {
                        $join->whereIn('product_categories.id', $ids);
                    }
                } else {
                    $join->where('product_categories.slug', $category);
                }
            }
        })->join('product_colors', function ($join) {
            $join->on('products.product_colors_id', '=', 'product_colors.id');
        })
        ->select(
            'product_colors.name as color_name'
        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at')
        ->whereIn('products.gender', [$gender,'unisex']);

        return $query->distinct()->get();
	}

    public function getSizeByProduct($request)
    {
        $gender = $request->input('menu');
        $category = $request->input('category');
        $parent = $request->input('parent');
        $designer = $request->input('designer');

        $query = \DB::table('products')->join('product_designers', function ($join) use ($designer) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');

            if ($designer) {
                $join->where('product_designers.slug', $designer);
            }

        })->join('product_categories', function ($join) use ($parent, $category) {
            $join->on('products.product_categories_id', '=', 'product_categories.id');

            if ($parent && $parent != 'all') {
                if ($category == 'all') {
                    $parents = (new CategoryRepository)->getCategoryByParent($parent);

                    $ids = [];
                    if($parents) {
                        foreach ($parents as $value) {
                            $ids[] = $value['id'];
                        }
                    }

                    if ($parents) {
                        $join->whereIn('product_categories.id', $ids);
                    }
                } else {
                    $join->where('product_categories.slug', $category);
                }
            }
        })->join('product_colors', function ($join) {
            $join->on('products.product_colors_id', '=', 'product_colors.id');
        })->join('product_stocks', function ($join) {
            $join->on('products.id', '=', 'product_stocks.products_id');
        })
        ->select(
            'product_stocks.size as size'
        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at')
        ->whereIn('products.gender', [$gender,'unisex']);

        return $query->distinct()->get();
    }

	public function getProductByMenu($request)
	{
        $gender = $request->input('menu');
        $category = $request->input('category');
        $parent = $request->input('parent');
        $designer = $request->input('designer');

        $query = \DB::table('products')->join('product_designers', function ($join) use ($designer) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');

            if ($designer) {
                $join->where('product_designers.slug', $designer);
            }

        })->join('product_categories', function ($join) use ($parent, $category) {
            $join->on('products.product_categories_id', '=', 'product_categories.id');

            if ($parent && $parent != 'all') {
                if ($category == 'all') {
                    $parents = (new CategoryRepository)->getCategoryByParent($parent);

                    $ids = [];
                    if($parents) {
                        foreach ($parents as $value) {
                            $ids[] = $value['id'];
                        }
                    }

                    if ($parents) {
                        $join->whereIn('product_categories.id', $ids);
                    }
                } else {
                    $join->where('product_categories.slug', $category);
                }
            }
        })->join('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id');
        })->select(
            'products.id as id',
            'products.name as name',
            'products.slug as slug',
            'products.gender as gender',
            'products.sell_price as sell_price',
            'products.price_before_discount as price_before_discount',
            'products.created_at as created_at',
            'product_categories.name as category_name',
            'product_designers.id as designer_id',
            'product_designers.name as designer_name',
            'product_designers.slug as designer_slug',
            'product_images.photo as photo'

        )
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at')
        ->whereIn('products.gender', [$gender,'unisex'])
        ->groupBy('products.id');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.name', $colorId);
            });
        }

        if ($request->has('size')) {
            $size = $request->input('size');

            $query->join('product_stocks', function ($join) use ($size) {
                $join->on('products.id', '=', 'product_stocks.products_id')
                ->where('product_stocks.size', $size);  
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        }

        if ($request->has('popular')) {
            $query->orderBy('products.count', $request->input('price'));
        }

        if ($request->has('sort')) {
            $query->orderBy('products.id', $request->input('sort'));
        }

        if($request->has('range')){
            $range = $request->input('range');
            $rangeArr = explode('-',$range);
            $payment = new CurrencyService;
            $kurs  = $payment->getCurrentCurrency();

            $query->where('products.sell_price','>',$rangeArr[0]*$kurs->value);
            $query->where('products.sell_price','<',$rangeArr[1]*$kurs->value);
            $query->orderBy('products.sell_price', 'asc');
        }else {
            $query->orderBy('products.id', 'desc');
        }

        if ($designer) {
            $this->setDesigner($this->getDesignerBySlug($designer));
        }


        return $query->paginate($request->has('view') ? $request->input('view') : self::COUNT_OF_PRODUCT);

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

        $query = \DB::table('products')->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
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
            'product_categories.name as category_name'
        )
        ->where('products.price_before_discount','>',0)
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at');

        if ($request->has('color_id')) {
            $colorId = $request->input('color_id');

            $query->join('product_colors', function ($join) use ($colorId) {
                $join->on('products.product_colors_id', '=', 'product_colors.id')
                ->where('product_colors.name', $colorId);
            });
        }

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        } else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate($request->has('view') ? $request->input('view') : self::COUNT_OF_PRODUCT);

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
        return \DB::table('products')->join('populars', function ($join) {
            $join->on('populars.products_id', '=', 'products.id');
        })->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
        })->join('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id');
        })->select(
            'products.id as id', 
            'products.name as name', 
            'products.slug as slug', 
            'products.gender as gender',
            'products.sell_price as sell_price', 
            'products.price_before_discount as price_before_discount',
            'products.created_at as created_at',
            'products.product_categories_id as product_categories_id',
            'product_images.photo as photo',
            'product_designers.name as designer_name',
            'product_designers.slug as designer_slug'
        )
        ->where('populars.group_setting',$group)
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at')
        ->orderBy('populars.order')
        ->groupBy('products.id')
        ->get();  
    }

    public function getRelatedProduct($categoryId)
    {
        return \DB::table('products')->join('product_categories', function ($join) use ($categoryId) {
            $join->on('products.product_categories_id', '=', 'product_categories.id')
            ->where('product_categories.id', $categoryId);
        })->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
        })->join('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id');
        })->select(
            'products.id as id',
            'products.name as name',
            'products.slug as slug',
            'products.gender as gender',
            'products.sell_price as sell_price',
            'products.price_before_discount as price_before_discount',
            'products.created_at as created_at',
            'products.product_categories_id as product_categories_id',
            'product_images.photo as photo',
            'product_designers.name as designer_name',
            'product_designers.slug as designer_slug'
        )
        ->inRandomOrder()
        ->whereNull('products.deleted_at')
        ->where('products.is_active',1)
        ->groupBy('products.id')
        ->take(4)
        ->get();
    }

    public function getSearch($request )
    {
        $query = \DB::table('products')->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
        })->join('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id');
        })
        ->select(
            'products.id as id',
            'products.name as name',
            'products.slug as slug',
            'products.gender as gender',
            'products.sell_price as sell_price',
            'products.price_before_discount as price_before_discount',
            'products.created_at as created_at',
            'products.product_categories_id as product_categories_id',
            'product_images.photo as photo',
            'product_designers.name as designer_name',
            'product_designers.slug as designer_slug'
        )

        ->where('products.is_active',1)
        ->where('products.gender',$request->input('menu'))
        ->where('products.name','like','%'.$request->input('keyword').'%')
        ->orWhere('products.gender', 'unisex')
        ->where('products.name','like','%'.$request->input('keyword').'%')
        ->whereNull('products.deleted_at')
        ->groupBy('products.id');

        if ($request->has('price')) {
            $query->orderBy('products.sell_price', $request->input('price'));
        }

        if ($request->has('popular')) {
            $query->orderBy('products.count', $request->input('price'));
        }

        if ($request->has('sort')) {
            $query->orderBy('products.id', $request->input('sort'));
        }else {
            $query->orderBy('products.id', 'desc');
        }

        return $query->paginate($request->has('view') ? $request->input('view') : self::COUNT_OF_PRODUCT);
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

    public function updateCountProducts($id){
        Product::where('id', $id)->increment('count');
    }

    public function getRecentlyViewedProduct($ids)
    {
        $orders = implode(',', $ids);
        return \DB::table('products')->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
        })->join('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id');
        })
        ->select(
            'products.id as id',
            'products.name as name',
            'products.slug as slug',
            'products.gender as gender',
            'products.sell_price as sell_price',
            'products.price_before_discount as price_before_discount',
            'products.created_at as created_at',
            'products.product_categories_id as product_categories_id',
            'product_images.photo as photo',
            'product_designers.name as designer_name',
            'product_designers.slug as designer_slug'
        )

        ->where('products.is_active',1)
        ->whereIn('products.id', $ids)
        ->orderByRaw(\DB::raw("FIELD(products.id, $orders)"))
        ->whereNull('products.deleted_at')
        ->groupBy('products.id')
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

    public function getProductImage($ids)
    {
        return ProductImage::whereIn('products_id', $ids)
            ->orderBy('id', 'DESC')
            ->get();  
    }

    public function getProduct()
    {
        return $this->model()
            ->limit(100)
            ->where('gender', 'unisex')
            ->get();
    }

    public function getProductByCategoryId($id)
    {
        return $this->model()
            ->where('product_categories_id', $id)
            ->where('gender', 'unisex')
            ->first();
    }

}
