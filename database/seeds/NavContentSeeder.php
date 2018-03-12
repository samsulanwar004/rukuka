<?php

use Illuminate\Database\Seeder;

class NavContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "designer_shop_image",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Designer Navigation",
                "label" => "Designer - Shop Image",
            ],
            [
                "name" => "designer_shop_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Designer Navigation",
                "label" => "Designer - Shop URL",
            ],
            [
                "name" => "designer_shop_text",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Designer Navigation",
                "label" => "Designer - Shop Text",
            ],
            [
                "name" => "women_shop_image",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Navigation",
                "label" => "Women - Shop Image",
            ],
            [
                "name" => "women_shop_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Navigation",
                "label" => "Women - Shop URL",
            ],
            [
                "name" => "women_shop_text",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Navigation",
                "label" => "Women - Shop Text",
            ],
            [
                "name" => "men_shop_image",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Navigation",
                "label" => "Men - Shop Image",
            ],
            [
                "name" => "men_shop_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Navigation",
                "label" => "Men - Shop URL",
            ],
            [
                "name" => "men_shop_text",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Navigation",
                "label" => "Men - Shop Text",
            ],
            [
                "name" => "sale_image",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Sale Navigation",
                "label" => "Sale - Image",
            ],
            [
                "name" => "sale_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Sale Navigation",
                "label" => "Sale - URL",
            ],
            [
                "name" => "sale_text",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Sale Navigation",
                "label" => "Sale - Text",
            ],
            [
                "name" => "meta_description",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Meta Tag",
                "label" => "Description",
            ],
            [
                "name" => "meta_title",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Meta Tag",
                "label" => "Title",
            ],
        ];

        foreach($data as $k=>$d) {
            if(DB::table('cms_settings')->where('name',$d['name'])->count()) {
                unset($data[$k]);
            }
        }

        DB::table('cms_settings')->insert($data);
    }
}
