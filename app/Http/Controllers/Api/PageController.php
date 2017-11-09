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
	    		$desingers = (new DesignerRepository)->getDesigners();

	    		return $this->success($desingers,200, true);
	    	} else {
	    		if ($parent == null) {
                    $categories = (new CategoryRepository)->getCategories();

                    $categories = collect($categories)->mapWithKeys(function ($item) {
                        return [strtolower($item['name']) => $item['child']];
                    })->toArray();

                    $categories['designers'] = (new DesignerRepository)->getDesigners();

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
