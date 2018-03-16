<?php

use Illuminate\Database\Seeder;
use App\Repositories\ProductRepository;

class ProductGender extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = (new ProductRepository)->getProduct();
        $prod = $products->map(function($entry) {
            return [
                'category_id' => $entry->product_categories_id,
                'categories' => $entry->category->parent->parent->name
            ];
        });

        foreach ($prod as $value) {
            $product = (new ProductRepository)->getProductByCategoryId($value['category_id']);
            if($product) {
                $product->gender = strtolower($value['categories']);
                $product->update();
            }
        }

        $this->command->info('Inserting the data product gender completed :) !');
    }
}
