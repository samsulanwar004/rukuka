<?php

use Illuminate\Database\Seeder;

class BackendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Please wait inserting the data...'); 

        $this->call('CmsModulsSeeder');
        $this->call('CmsMenusSeeder');

        $this->command->info('Inserting the data completed !');
    }
}

class CmsModulsSeeder extends Seeder {

    public function run()
    {        

        /* 
            1 = Public
            2 = Setting        
        */

        $data = [
		[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Categories',
            'icon'=>'fa fa-circle-o',
            'path'=>'product-categories',
            'table_name'=>'product_categories',
            'controller'=>'AdminProductCategoriesController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Designers',
            'icon'=>'fa fa-circle-o',
            'path'=>'product-designers',
            'table_name'=>'product_designers',
            'controller'=>'AdminProductDesignersController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Products',
            'icon'=>'fa fa-circle-o',
            'path'=>'products',
            'table_name'=>'products',
            'controller'=>'AdminProductsController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Product Images',
            'icon'=>'fa fa-circle-o',
            'path'=>'product-images',
            'table_name'=>'product_images',
            'controller'=>'AdminProductImagesController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Product Stocks',
            'icon'=>'fa fa-circle-o',
            'path'=>'product-stocks',
            'table_name'=>'product_stocks',
            'controller'=>'AdminProductStocksController',
            'is_protected'=>0,                                
            'is_active'=>0
        ]       
            ];


        foreach($data as $k=>$d) {
            if(DB::table('cms_moduls')->where('name',$d['name'])->count()) {
                unset($data[$k]);
            }
        }

        $moduls = DB::table('cms_moduls');
        $moduls->insert($data);

        $datas = [];
        foreach ($data as $k=>$d) {
            $modul = collect(DB::table('cms_moduls')->where('name',$d['name'])->get())->first();
            $datas[] = [
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 1,
                'id_cms_moduls' => $modul->id
            ];
        }

        DB::table('cms_privileges_roles')->insert($datas);
    }

}

class CmsMenusSeeder extends Seeder {

    public function run()
    {        
        
        $data = [
        [
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Products',
            'type'=>'Route',
            'path'=>'products',
            'color' => null,
            'icon'=>'fa fa-th-large',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Products',
            'type'=>'Route',
            'path'=>'AdminProductsControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Designers',
            'type'=>'Route',
            'path'=>'AdminProductDesignersControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Categories',
            'type'=>'Route',
            'path'=>'AdminProductCategoriesControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 3
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Product Stocks',
            'type'=>'Route',
            'path'=>'AdminProductStocksControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 4
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Product Images',
            'type'=>'Route',
            'path'=>'AdminProductImagesControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 5
        ]       
            ];

        $menu = DB::table('cms_menus');  

        $menu->insert($data);

        $menus = $menu->get();

        $datas = [];
        foreach ($menus as $value) {
            $datas[] = [
                'id_cms_menus' => $value->id,
                'id_cms_privileges' => 1,
            ];
        }

        DB::table('cms_menus_privileges')->insert($datas);          

    }

}

