<?php

namespace App\Repositories;

use App\Blog;
use App\BlogCategory;
use App\Setting;

class BlogRepository
{
    public function getPostsIndex()
    {
        $result['post'] =  Blog::where('is_publish', 1)->orderBy('created_at', 'desc')->take(9)->get();

        if(count($result['post']) == 0 ){
            $result['status'] = $this->status('001');
            return $result;
        }
        $result['status'] = $result['status'] = $this->status('000');
        return $result;
    }

    public function getPostsIndexCategory($slug)
    {
        $category = BlogCategory::where('slug',$slug)->orderBy('created_at', 'desc')->get()->toArray();
        $result['post'] = Blog::where('is_publish', 1)->where('blog_categories_id',$category[0]['id'])->orderBy('created_at', 'desc')->take(9)->get();

        if(count($result['post']) == 0 ){
            $result['status'] = $this->status('001');
            return $result;
        }
        $result['title']  = $category[0]['name'];
        $result['status'] = $this->status('000');
        return $result;
    }

    public function getPostsRead($slug)
    {
        $result['post'] = Blog::where('is_publish', 1)->where('slug',$slug)->orderBy('created_at', 'desc')->take(9)->get();

        if(count($result['post']) == 0 ){
            $result['status'] = $this->status('001');
            return $result;
        }
        $result['status'] = $result['status'] = $this->status('010');
        return $result;
    }

    public function status($code, $custom_msg = null)
    {
        switch ($code) {
            case '000':
                $msg = "Success";
                break;
            case '001':
                $msg = "No Result";
                break;
            case '010':
                $msg = "Success Get Read Blog";
                break;
            default:
                $msg = "Unknown";
        }

        if ($msg != null)
        {
            $msg =  $msg . " " . $custom_msg;
        }

        return $response = array(
            'code' => $code ,
            'message' =>  $msg
        );

    }

    public function getSearch($keyword)
    {
        $result['post'] = Blog::where('is_publish', 1)->where('title','like','%'.$keyword['keyword'].'%')->orderBy('created_at', 'desc')->take(25)->get();

        if(count($result['post']) == 0 ){
            $result['status'] = $this->status('001');
            return $result;
        }
        $result['status'] = $result['status'] = $this->status('000');
        return $result;

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
}