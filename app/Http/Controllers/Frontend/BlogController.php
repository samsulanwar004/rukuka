<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::where('is_publish', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('blogs.home', compact('posts'));
    }

    public function indexAjax(Request $request)
    {

        $output = '';
        $id = $request->id;

        $posts = Blog::where('is_publish', 1)->where('id','<',$id)->orderBy('created_at', 'desc')->take(3)->get();

        if(!$posts->isEmpty())
        {
            $output .= '<div id="load-data" class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>';
            foreach($posts as $post)
            {
//                $url = url('blog/'.$post->slug);

                $output .= '<div class="uk-width-1-3@m uk-width-1-2@s uk-inline">
                                <div class="uk-inline">
                                    <div class="uk-inline-clip uk-transition-toggle uk-light">
                                        <a href="#" class="uk-link-reset">
                                            <img src="/'.$post->photo_1.'" alt="'.$post->title.'">
                                            <div class="uk-card uk-position-bottom-left uk-card-small">
                                                <div class="uk-card-body">
                                                    <div class="uk-transition-slide-left-small">
                                                        <h1 class="uk-margin-remove uk-text-bold uk-text-justify blog-heading">'.$post->title.'</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>';
            }
            $output .= '</div>
                        <div id="remove-row" class="uk-align-center">
                            <button onclick="myFunction('. $post->id .')" id="btn-more" class="uk-button uk-button-default" > Load More </button>
                        </div>';

            echo $output;
        }
    }
}
