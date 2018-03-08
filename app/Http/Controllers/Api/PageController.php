<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\DesignerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PageRepository;
use App\Repositories\LookbookRepository;
use Exception;

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
                    'photo' => $entry->photo,
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
                    'photo' => $entry->photo,
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

            $product->images->toArray();

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
                    'photo' => $entry->photo,
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
                    'photo' => $entry->photo,
                ];
            })->toArray();

            return $this->success($recently, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }
}
