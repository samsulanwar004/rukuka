<?php

use Illuminate\Database\Seeder;

class LandingContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //HOMPAGE SEEDER
            [
                "name" => "homepage_main_banner",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => 'Height: 600px, Width: 2000px',
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Main Banner",
            ],
            [
                "name" => "homepage_main_title",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Main Title",
            ],
            [
                "name" => "homepage_main_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Main URL",
            ],
            [
                "name" => "homepage_banner_1",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 1",
            ],
            [
                "name" => "homepage_text_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 1",
            ],
            [
                "name" => "homepage_url_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 1",
            ],
            [
                "name" => "homepage_banner_2",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 2",
            ],
            [
                "name" => "homepage_text_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 2",
            ],
            [
                "name" => "homepage_url_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 2",
            ],
            [
                "name" => "homepage_banner_3",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 3",
            ],
            [
                "name" => "homepage_text_3",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 3",
            ],
            [
                "name" => "homepage_url_3",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 3",
            ],
            [
                "name" => "homepage_banner_4",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 4",
            ],
            [
                "name" => "homepage_text_4",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 4",
            ],
            [
                "name" => "homepage_url_4",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 4",
            ],
            [
                "name" => "homepage_banner_5",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 5",
            ],
            [
                "name" => "homepage_text_5",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 5",
            ],
            [
                "name" => "homepage_url_5",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 5",
            ],
            [
                "name" => "homepage_banner_6",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 6",
            ],
            [
                "name" => "homepage_text_6",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 6",
            ],
            [
                "name" => "homepage_url_6",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 6",
            ],
            [
                "name" => "homepage_banner_7",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 7",
            ],
            [
                "name" => "homepage_text_7",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 7",
            ],
            [
                "name" => "homepage_url_7",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 7",
            ],
            [
                "name" => "homepage_banner_8",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 8",
            ],
            [
                "name" => "homepage_text_8",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 8",
            ],
            [
                "name" => "homepage_url_8",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 8",
            ],
            [
                "name" => "homepage_banner_9",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Banner 9",
            ],
            [
                "name" => "homepage_text_9",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text 9",
            ],
            [
                "name" => "homepage_url_9",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL 9",
            ],
            [
                "name" => "homepage_content_url_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Content URL 1",
            ],
            [
                "name" => "homepage_content_text_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Content Text 1",
            ],
            [
                "name" => "homepage_content_url_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Content URL 2",
            ],
            [
                "name" => "homepage_content_text_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Content Text 2",
            ],
            [
                "name" => "homepage_content_url_3",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Content URL 3",
            ],
            [
                "name" => "homepage_content_text_3",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Content Text 3",
            ],
            [
                "name" => "homepage_content_url_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Content URL 2",
            ],
            [
                "name" => "homepage_url_blog",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage URL Blog",
            ],
            [
                "name" => "homepage_text_blog_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text blog 1",
            ],
            [
                "name" => "homepage_text_blog_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Home Page",
                "label" => "Homepage Text blog 2",
            ],
            //WOMEN SEEDER
            [
                "name" => "women_main_banner",
                "helper" => 'Height: 600px, Width: 2000px',
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Main Banner",
            ],
            [
                "name" => "women_main_title",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Main Title",
            ],
            [
                "name" => "women_main_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Main URL",
            ],
            [
                "name" => "women_banner_1",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Banner 1",
            ],
            [
                "name" => "women_text_1_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 1 1",
            ],
            [
                "name" => "women_text_1_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 1 2",
            ],
            [
                "name" => "women_url_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women URL 1",
            ],
            [
                "name" => "women_banner_2",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Banner 2",
            ],
            [
                "name" => "women_text_2_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 2 1",
            ],
            [
                "name" => "women_text_2_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 2 2",
            ],
            [
                "name" => "women_url_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women URL 2",
            ],
            [
                "name" => "women_banner_3",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Banner 3",
            ],
            [
                "name" => "women_text_3_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 3 1",
            ],
            [
                "name" => "women_text_3_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 3 2",
            ],
            [
                "name" => "women_url_3",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women URL 3",
            ],
            [
                "name" => "women_banner_4",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Banner 4",
            ],
            [
                "name" => "women_text_4_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 4 1",
            ],
            [
                "name" => "women_text_4_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 4 2",
            ],
            [
                "name" => "women_url_4",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women URL 4",
            ],
            [
                "name" => "women_banner_5",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Banner 5",
            ],
            [
                "name" => "women_text_5_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 5 1",
            ],
            [
                "name" => "women_text_5_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women Text 5 2",
            ],
            [
                "name" => "women_url_5",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Women Page",
                "label" => "Women URL 5",
            ],
            // MEN SEEDER
            [
                "name" => "men_main_banner",
                "helper" => 'Height: 600px, Width: 2000px',
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Main Banner",
            ],
            [
                "name" => "men_main_title",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Main Title",
            ],
            [
                "name" => "men_main_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Main URL",
            ],
            [
                "name" => "men_banner_1",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Banner 1",
            ],
            [
                "name" => "men_text_1_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 1 1",
            ],
            [
                "name" => "men_text_1_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 1 2",
            ],
            [
                "name" => "men_url_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men URL 1",
            ],
            [
                "name" => "men_banner_2",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Banner 2",
            ],
            [
                "name" => "men_text_2_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 2 1",
            ],
            [
                "name" => "men_text_2_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 2 2",
            ],
            [
                "name" => "men_url_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men URL 2",
            ],
            [
                "name" => "men_banner_3",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Banner 3",
            ],
            [
                "name" => "men_text_3_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 3 1",
            ],
            [
                "name" => "men_text_3_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 3 2",
            ],
            [
                "name" => "men_url_3",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men URL 3",
            ],
            [
                "name" => "men_banner_4",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Banner 4",
            ],
            [
                "name" => "men_text_4_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 4 1",
            ],
            [
                "name" => "men_text_4_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 4 2",
            ],
            [
                "name" => "men_url_4",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men URL 4",
            ],
            [
                "name" => "men_banner_5",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Banner 5",
            ],
            [
                "name" => "men_text_5_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 5 1",
            ],
            [
                "name" => "men_text_5_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men Text 5 2",
            ],
            [
                "name" => "men_url_5",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Men Page",
                "label" => "Men URL 5",
            ],
            // KIDS SEEDER
            [
                "name" => "kids_main_banner",
                "helper" => 'Height: 600px, Width: 2000px',
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Main Banner",
            ],
            [
                "name" => "kids_main_title",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Main Title",
            ],
            [
                "name" => "kids_main_url",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Main URL",
            ],
            [
                "name" => "kids_banner_1",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Banner 1",
            ],
            [
                "name" => "kids_text_1_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 1 1",
            ],
            [
                "name" => "kids_text_1_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 1 2",
            ],
            [
                "name" => "kids_url_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids URL 1",
            ],
            [
                "name" => "kids_banner_2",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Banner 2",
            ],
            [
                "name" => "kids_text_2_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 2 1",
            ],
            [
                "name" => "kids_text_2_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 2 2",
            ],
            [
                "name" => "kids_url_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids URL 2",
            ],
            [
                "name" => "kids_banner_3",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Banner 3",
            ],
            [
                "name" => "kids_text_3_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 3 1",
            ],
            [
                "name" => "kids_text_3_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 3 2",
            ],
            [
                "name" => "kids_url_3",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids URL 3",
            ],
            [
                "name" => "kids_banner_4",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Banner 4",
            ],
            [
                "name" => "kids_text_4_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 4 1",
            ],
            [
                "name" => "kids_text_4_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 4 2",
            ],
            [
                "name" => "kids_url_4",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids URL 4",
            ],
            [
                "name" => "kids_banner_5",
                "content_input_type" => "upload_image",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Banner 5",
            ],
            [
                "name" => "kids_text_5_1",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 5 1",
            ],
            [
                "name" => "kids_text_5_2",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids Text 5 2",
            ],
            [
                "name" => "kids_url_5",
                "content_input_type" => "text",
                "dataenum" => null,
                "helper" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "group_setting" => "Kids Page",
                "label" => "Kids URL 5",
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
