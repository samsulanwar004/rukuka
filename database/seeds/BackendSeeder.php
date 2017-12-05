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

        $this->command->info('Inserting the data completed :) !');
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
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Owners',
            'icon'=>'fa fa-circle-o',
            'path'=>'homestay-owners',
            'table_name'=>'homestay_owners',
            'controller'=>'AdminHomestayOwnersController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Amenities',
            'icon'=>'fa fa-circle-o',
            'path'=>'amenities',
            'table_name'=>'amenities',
            'controller'=>'AdminAmenitiesController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestays',
            'icon'=>'fa fa-circle-o',
            'path'=>'homestays',
            'table_name'=>'homestays',
            'controller'=>'AdminHomestaysController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Images',
            'icon'=>'fa fa-circle-o',
            'path'=>'homestay-images',
            'table_name'=>'homestay_images',
            'controller'=>'AdminHomestayImagesController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Amenities',
            'icon'=>'fa fa-circle-o',
            'path'=>'homestay-amenities',
            'table_name'=>'homestay_amenities',
            'controller'=>'AdminHomestayAmenitiesController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Blogs',
            'icon'=>'fa fa-circle-o',
            'path'=>'blogs',
            'table_name'=>'blogs',
            'controller'=>'AdminBlogsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Blog Categories',
            'icon'=>'fa fa-circle-o',
            'path'=>'blog-categories',
            'table_name'=>'blog_categories',
            'controller'=>'AdminBlogCategoriesController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Pages',
            'icon'=>'fa fa-file-text-o',
            'path'=>'pages',
            'table_name'=>'pages',
            'controller'=>'AdminPagesController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Helps',
            'icon'=>'fa fa-file-text',
            'path'=>'helps',
            'table_name'=>'helps',
            'controller'=>'AdminHelpsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Popup Link',
            'icon'=>'fa fa-external-link',
            'path'=>'popups',
            'table_name'=>'popups',
            'controller'=>'AdminPopupsController',
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

        $menu = DB::table('cms_menus');

        $menu->truncate();    
        
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
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Eco Toursim',
            'type'=>'Route',
            'path'=>'ecotoursim',
            'color' => null,
            'icon'=>'fa fa-home',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Owners',
            'type'=>'Route',
            'path'=>'AdminHomestayOwnersControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>7,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Amenities',
            'type'=>'Route',
            'path'=>'AdminAmenitiesControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>7,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestays',
            'type'=>'Route',
            'path'=>'AdminHomestaysControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>7,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 3
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Images',
            'type'=>'Route',
            'path'=>'AdminHomestayImagesControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>7,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 4
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Amenities',
            'type'=>'Route',
            'path'=>'AdminHomestayAmenitiesControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>7,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 5
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Blogs',
            'type'=>'Route',
            'path'=>'blogs',
            'color' => null,
            'icon'=>'fa fa-edit',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 3
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Blogs',
            'type'=>'Route',
            'path'=>'AdminBlogsControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>13,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Categories',
            'type'=>'Route',
            'path'=>'AdminBlogCategoriesControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-circle-o',
            'parent_id'=>13,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Helps',
            'type'=>'Route',
            'path'=>'AdminHelpsControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-file-text',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 5
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Pages',
            'type'=>'Route',
            'path'=>'AdminPagesControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-file-text-o',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 4
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Popup Link',
            'type'=>'Route',
            'path'=>'AdminPopupsControllerGetIndex',
            'color' => null,
            'icon'=>'fa fa-external-link',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 6
        ]
    ];


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

