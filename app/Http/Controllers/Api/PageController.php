<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Exception;
use App\Repositories\DesignerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class PageController extends BaseApiController
{
    
    public function menu($parent, $child)
    {
    	try {
    		if ($parent == 'designers') {
	    		$desingers = (new DesignerRepository)->getDesigners();

	    		return $this->success($desingers,200, true);
	    	} else {
	    		$categories = (new CategoryRepository)->getCategoryByParent($parent, $child);

	    		return $this->success($categories,200, true);
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
}
