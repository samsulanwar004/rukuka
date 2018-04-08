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
            'name'=>'Stocks',
            'icon'=>'fa fa-circle-o',
            'path'=>'product-stocks',
            'table_name'=>'product_stocks',
            'controller'=>'AdminProductStocksController',
            'is_protected'=>0,                                
            'is_active'=>0
        ],[ 
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Colors',
            'icon'=>'fa fa-circle-o',
            'path'=>'product-colors',
            'table_name'=>'product_colors',
            'controller'=>'AdminProductColorsController',
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
            'icon'=>'fa fa-circle-o',
            'path'=>'pages',
            'table_name'=>'pages',
            'controller'=>'AdminPagesController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Helps',
            'icon'=>'fa fa-circle-o',
            'path'=>'helps',
            'table_name'=>'helps',
            'controller'=>'AdminHelpsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Popup Links',
            'icon'=>'fa fa-circle-o',
            'path'=>'popups',
            'table_name'=>'popups',
            'controller'=>'AdminPopupsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Orders',
            'icon'=>'fa fa-database',
            'path'=>'orders',
            'table_name'=>'orders',
            'controller'=>'AdminOrdersController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Reviews',
            'icon'=>'fa fa-star',
            'path'=>'reviews',
            'table_name'=>'reviews',
            'controller'=>'AdminReviewsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'User Accounts',
            'icon'=>'fa fa-user',
            'path'=>'user_accounts',
            'table_name'=>'users',
            'controller'=>'AdminUserAccountsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Subscribers',
            'icon'=>'fa fa-circle-o',
            'path'=>'subcribers',
            'table_name'=>'subcribers',
            'controller'=>'AdminSubcribersController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Exchange Rates',
            'icon'=>'fa fa-circle-o',
            'path'=>'exchange-rates',
            'table_name'=>'exchange_rates',
            'controller'=>'AdminExchangeRatesController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Main Sliders',
            'icon'=>'fa fa-circle-o',
            'path'=>'main_sliders',
            'table_name'=>'main_sliders',
            'controller'=>'AdminMainSlidersController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Popular Products',
            'icon'=>'fa fa-circle-o',
            'path'=>'populars',
            'table_name'=>'populars',
            'controller'=>'AdminPopularsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Contacts',
            'icon'=>'fa fa-circle-o',
            'path'=>'contacts',
            'table_name'=>'contacts',
            'controller'=>'AdminContactsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Lookbooks',
            'icon'=>'fa fa-th',
            'path'=>'lookbooks',
            'table_name'=>'lookbooks',
            'controller'=>'AdminLookbooksController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Lookbook Collections',
            'icon'=>'fa fa-circle-o',
            'path'=>'lookbook-collections',
            'table_name'=>'lookbook-collections',
            'controller'=>'AdminLookbookCollectionsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Lookbook Products',
            'icon'=>'fa fa-circle-o',
            'path'=>'lookbook-products',
            'table_name'=>'lookbook_products',
            'controller'=>'AdminLookbookProductsController',
            'is_protected'=>0,
            'is_active'=>0
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Confirm Payment',
            'icon'=>'fa fa-check',
            'path'=>'confirm-payments',
            'table_name'=>'confirm_payments',
            'controller'=>'AdminConfirmPaymentsController',
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
            'color' => 'normal',
            'icon'=>'fa fa-th-large',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Products',
            'type'=>'Route',
            'path'=>'AdminProductsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Designers',
            'type'=>'Route',
            'path'=>'AdminProductDesignersControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Categories',
            'type'=>'Route',
            'path'=>'AdminProductCategoriesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 3
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Stocks',
            'type'=>'Route',
            'path'=>'AdminProductStocksControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 4
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Colors',
            'type'=>'Route',
            'path'=>'AdminProductColorsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>1,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 5
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Product Images',
            'type'=>'Route',
            'path'=>'AdminProductImagesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>0,
            'is_active'=>0,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Eco Toursim',
            'type'=>'Route',
            'path'=>'ecotoursim',
            'color' => 'normal',
            'icon'=>'fa fa-home',
            'parent_id'=>0,
            'is_active'=>0,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Owners',
            'type'=>'Route',
            'path'=>'AdminHomestayOwnersControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>0,
            'is_active'=>0,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Amenities',
            'type'=>'Route',
            'path'=>'AdminAmenitiesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>0,
            'is_active'=>0,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestays',
            'type'=>'Route',
            'path'=>'AdminHomestaysControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>0,
            'is_active'=>0,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 3
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Images',
            'type'=>'Route',
            'path'=>'AdminHomestayImagesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>0,
            'is_active'=>0,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 4
        ],[
            
            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Homestay Amenities',
            'type'=>'Route',
            'path'=>'AdminHomestayAmenitiesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>0,
            'is_active'=>0,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 5
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Blogs',
            'type'=>'Route',
            'path'=>'blogs',
            'color' => 'normal',
            'icon'=>'fa fa-edit',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Blogs',
            'type'=>'Route',
            'path'=>'AdminBlogsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>14,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Categories',
            'type'=>'Route',
            'path'=>'AdminBlogCategoriesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>14,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Pages',
            'type'=>'Route',
            'path'=>'AdminPagesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>21,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 3
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Helps',
            'type'=>'Route',
            'path'=>'AdminHelpsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>21,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 4
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Popup Link',
            'type'=>'Route',
            'path'=>'AdminPopupsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>26,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Orders',
            'type'=>'Route',
            'path'=>'AdminOrdersControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-database',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 4
        ]
        ,[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Web Content',
            'type'=>'Route',
            'path'=>'webcontent',
            'color' => 'normal',
            'icon'=>'fa fa-file-text-o',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 8
        ]
        ,[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Reviews',
            'type'=>'Route',
            'path'=>'AdminReviewsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-star',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 6
        ]
        ,[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'User Accounts',
            'type'=>'Route',
            'path'=>'AdminUserAccountsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-user',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 7
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Subscribers',
            'type'=>'Route',
            'path'=>'AdminSubcribersControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>21,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 6
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Exchange Rates',
            'type'=>'Route',
            'path'=>'AdminExchangeRatesControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>26,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Web Setting',
            'type'=>'Route',
            'path'=>'websetting',
            'color' => 'normal',
            'icon'=>'fa fa-cogs',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 9
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Main Slider',
            'type'=>'Route',
            'path'=>'AdminMainSlidersControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>21,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 1
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Popular Products',
            'type'=>'Route',
            'path'=>'AdminPopularsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>21,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 2
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Contacts',
            'type'=>'Route',
            'path'=>'AdminContactsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-circle-o',
            'parent_id'=>21,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 5
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Lookbooks',
            'type'=>'Route',
            'path'=>'AdminLookbooksControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-th',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 3
        ],[

            'created_at'=>date('Y-m-d H:i:s'),
            'name'=>'Confirm Payment',
            'type'=>'Route',
            'path'=>'AdminConfirmPaymentsControllerGetIndex',
            'color' => 'normal',
            'icon'=>'fa fa-check',
            'parent_id'=>0,
            'is_active'=>1,
            'is_dashboard'=>0,
            'id_cms_privileges' => 1,
            'sorting' => 5
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

