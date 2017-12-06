<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\DesignerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class PageController extends BaseApiController
{
    
    public function menu($parent = null)
    {
    	try {
    		if ($parent == 'designers') {
	    		$designers = (new DesignerRepository)->getDesigners();

	    		return $this->success($designers,200, true);
	    	} else {
	    		if ($parent == null) {
	    		    //Designer List
                    $categories = (new CategoryRepository)->getCategories();
                    $categories = collect($categories)->mapWithKeys(function ($item) {
                        return [strtolower($item['name']) => $item['child']];
                    })->toArray();
                    $categories['designers'] = (new DesignerRepository)->getDesigners();

                    //Designer Navigation
                    $designersResult = (new DesignerRepository)->getDesignersNav();
                    $designersResult = collect($designersResult)->mapWithKeys(function ($item) {
                        return [strtolower($item['name']) => $item['content']];
                    })->toArray();
                    $categories['designers_nav'] = $designersResult;

                    //Women Navigation
                    $womensResult = (new DesignerRepository)->getWomensNav();
                    $womensResult = collect($womensResult)->mapWithKeys(function ($item) {
                        return [strtolower($item['name']) => $item['content']];
                    })->toArray();
                    $categories['womens_nav'] = $womensResult;

                    //Men Navigation
                    $MensResult = (new DesignerRepository)->getMensNav();
                    $MensResult = collect($MensResult)->mapWithKeys(function ($item) {
                        return [strtolower($item['name']) => $item['content']];
                    })->toArray();
                    $categories['mens_nav'] = $MensResult;

                    //Kid Navigation
                    $KidsResult = (new DesignerRepository)->getKidsNav();
                    $KidsResult = collect($KidsResult)->mapWithKeys(function ($item) {
                        return [strtolower($item['name']) => $item['content']];
                    })->toArray();
                    $categories['kids_nav'] = $KidsResult;

                    //Sale Navigation
                    $SaleResult = (new DesignerRepository)->getSalesNav();
                    $SaleResult = collect($SaleResult)->mapWithKeys(function ($item) {
                        return [strtolower($item['name']) => $item['content']];
                    })->toArray();
                    $categories['sales_nav'] = $SaleResult;

                    return $this->success($categories, 200, true);
                } else {
                    $categories = (new CategoryRepository)->getCategoryByParent($parent);

                    return $this->success($categories,200, true);
                }
	    	}
    	} catch (Exception $e) {
    		return $this->error($e, 400, true);
    	}
    }

    public function search($keyword = null)
    {
        try {
            $categories['designers'] = (new DesignerRepository)->getDesignersByKeyword($keyword);
            $products = (new ProductRepository())->getProductByKeyword($keyword);

           $product = $products->map(function ($entry) {
               return [
                   'category' => $entry->category->parent->parent->name
               ];
           });
            $mens = 0;
            $womens = 0;
            $kids = 0;

            foreach ($product as $prod) {
                if ($prod['category'] == 'Mens') {
                    $mens++;
                } else if ($prod['category'] == 'Womens') {
                    $womens++;
                } else {
                    $kids++;
                }
            }

            $categories['mens'] = $mens;
            $categories['womens'] = $womens;
            $categories['kids'] = $kids;

            return $this->success($categories, 200, true);

        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function popular()
    {
        try {
            $popular = (new ProductRepository)->getMostProduct();
            
            $popular = $popular->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->slug,
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'currency' => $entry->currency,
                    'photo' => $entry->images->first()->photo,
                ];
            })->toArray();

            return $this->success($popular, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function related($categoryId)
    {
        try {
            $related = (new ProductRepository)->getRelatedProduct($categoryId);

            $related = $related->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->slug,
                    'price' => $entry->sell_price,
                    'currency' => $entry->currency,
                    'photo' => $entry->images->first()->photo,
                ];
            })->toArray();

            return $this->success($related, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function product($id = null)
    {
        try {
            $product = (new ProductRepository)
                ->getProductById($id);

            $product->images->toArray();

            $product->stocks->toArray();

            $product = collect($product)->all();

            return $this->success($product, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }
}
