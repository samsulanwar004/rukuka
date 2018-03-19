<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\DesignerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PageRepository;
use App\Repositories\LookbookRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


class PageController extends BaseApiController
{

    CONST MENU_CACHE = 'menu.cache';
    
    public function menu($parent = null)
    {
    	try {
    		if ($parent == 'designers') {
	    		$designers = (new DesignerRepository)->getDesigners();

	    		return $this->success($designers,200, true);
	    	} else {
	    		if ($parent == null) {

                    if (Cache::has(self::MENU_CACHE)) {
                        $categories = Cache::get(self::MENU_CACHE);
                    } else {
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

                        $expiresAt = Carbon::now()->addMinutes(60);

                        Cache::put(self::MENU_CACHE, $categories, $expiresAt);
                    }
	    		    

                    return $this->success($categories, 200, true);
                } else {
                    $categories = (new CategoryRepository)->getCategories();

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
            $home = 0;

            foreach ($product as $prod) {
                if ($prod['category'] == 'Mens') {
                    $mens++;
                } else if ($prod['category'] == 'Womens') {
                    $womens++;
                } else if ($prod['category'] == 'Home') {
                    $home++;
                } else {
                    $kids++;
                }
            }

            $categories['mens'] = $mens;
            $categories['womens'] = $womens;
            $categories['home'] = $home;
            $categories['kids'] = $kids;

            return $this->success($categories, 200, true);

        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function popular($group)
    {
        try {
            $popular = (new ProductRepository)->getMostProduct($group);

            $ids = [];
            foreach ($popular as $value) {
                $ids[] = $value->id;
            }

            $image = (new ProductRepository)->getProductImage($ids);

            $popular = $popular->map(function ($entry) use ($image) {

                foreach ($image as $value) {
                    if ($entry->id == $value->products_id) {
                        $entry->photo = $value->photo;
                    }
                }

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->slug,
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
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

            $ids = [];
            foreach ($related as $value) {
                $ids[] = $value->id;
            }

            $image = (new ProductRepository)->getProductImage($ids);

            $related = $related->map(function ($entry) use ($image) {

                foreach ($image as $value) {
                    if ($entry->id == $value->products_id) {
                        $entry->photo = $value->photo;
                    }
                }

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->slug,
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
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
            $product = (new ProductRepository)->getProductById($id);

            $product->images_medium = $product->images->map(function($entry) {
                return [
                    'name' => $entry->name,
                    'photo' => str_replace('original', 'medium', $entry->photo)
                ];
            });

            $product->stocks->toArray();

            $color = $product->palette;

            $product->color = $color->name;
            $product->color_palette = $color->palette;

            $product = collect($product)->all();

            return $this->success($product, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function popularSearch(){
        try {
            $popularSearch = (new ProductRepository)->getPopularSearch()->toArray();
            return $this->success($popularSearch, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function recently(Request $request)
    {
        try {

            $product = $request->input('product');

            $recently = (new ProductRepository)->getRecentlyViewedProduct($product);

            $ids = [];
            foreach ($recently as $value) {
                $ids[] = $value->id;
            }

            $image = (new ProductRepository)->getProductImage($ids);

            $recently = $recently->map(function ($entry) use ($image) {

                foreach ($image as $value) {
                    if ($entry->id == $value->products_id) {
                        $entry->photo = $value->photo;
                    }
                }

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->slug,
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
                ];
            })->toArray();

            return $this->success($recently, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function colorPalette()
    {
        try {
            $color = (new ProductRepository)->getColorPalette();

            $color = $color->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'palette' => uploadCDN($entry->palette)
                ];
            })->toArray();

            return $this->success($color, 200, true);

        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function lookbook(Request $request)
    {
        try {

            $product = $request->input('product');

            $recently = (new ProductRepository)->getLookbookProduct($product);

            $ids = [];
            foreach ($recently as $value) {
                $ids[] = $value->id;
            }

            $image = (new ProductRepository)->getProductImage($ids);

            $recently = $recently->map(function ($entry) use ($image) {

                foreach ($image as $value) {
                    if ($entry->id == $value->products_id) {
                        $entry->photo = $value->photo;
                    }
                }

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->slug,
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'currency' => $entry->currency,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
                ];
            })->toArray();

            return $this->success($recently, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function typeahead($keyword = null)
    {
        try {
            $designer = (new DesignerRepository())->getDesignersByKeyword($keyword);

            $designerName = array();
            foreach($designer as $value)
            {
                $designerName[] = $value['name'];
            }

            $datas = [
                'status' => true,
                'urlPattern' => "/designer/#id#/#display#/",
                'data' => $designerName,
            ];
            echo  json_encode($datas);


        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }
}
