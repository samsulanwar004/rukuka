<?php

namespace App\Repositories;

use App\Blog;
use App\BlogCategory;
use App\Setting;

class BlogRepository
{
    public function getPostsIndex()
    {
        return Blog::where('is_publish', 1)->orderBy('created_at', 'desc')->take(9)->get();

    }

    public function getPostsIndexCategory($slug)
    {
        $category = BlogCategory::where('slug',$slug)->orderBy('created_at', 'desc')->first();

        $return['posts'] = Blog::where('is_publish', 1)->where('blog_categories_id',$category->id)->orderBy('created_at', 'desc')->take(9)->get();
        $return['title'] = $category->name;

        return $return ;

    }

    public function getPostsRead($slug)
    {
        return Blog::where('is_publish', 1)->where('slug', $slug)->orderBy('created_at', 'desc')->first();
    }


    public function getSearch($keyword)
    {
        return Blog::where('is_publish', 1)->where('title','like','%'.$keyword['keyword'].'%')->orderBy('created_at', 'desc')->take(26)->get();

    }

    public function getHeader()
    {
        return Setting::where('name','header_image' )->get();
    }

    public function getPostRandom()
    {
        $result = Blog::where('is_publish', 1)->take(3) ->inRandomOrder()->get();

        return $result;
    }

    public function getCategory()
    {
        return BlogCategory::orderBy('created_at', 'asc')->get();
    }
}