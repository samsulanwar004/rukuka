<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\BlogCategory;
use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    public function index()
    {
        $BlogRepository = new BlogRepository();

        $result= $BlogRepository->getPostsIndex();
        $posts = $result['post'];
        $status= $result['status'];
        $header= $BlogRepository->getHeader();
        $category = $this->getCategory();
        $title = 'Top Stories';

        return view('blogs.home', compact('posts','category','title','header','status'));
    }

    public function getBlogAjax(Request $request)
    {
        $blog = '';
        $loader = '';
        $id = $request->id;
        $slug = $request->slug;
        $blogCategory = BlogCategory::where('slug',$slug)->orderBy('created_at', 'desc')->get()->toArray();
        if($blogCategory[0]['id']){
            $posts = Blog::where('is_publish', 1)->where('blog_categories_id',$blogCategory[0]['id'])->where('id','<',$id)->orderBy('created_at', 'desc')->take(9)->get();
        }
        else{
            $posts = Blog::where('is_publish', 1)->where('id','<',$id)->orderBy('created_at', 'desc')->take(9)->get();
        }

        if(!$posts->isEmpty())
        {
            foreach($posts as $post)
            {
                $url = url('blog/'.$post->slug);

                if(count($post->photo_1)){
                    $image = '<img src="/'.$post->photo_1.'" alt="'.$post->title.'">';
                }
                else{
                    $image = '<img src="/images/blog-default.jpg" alt="kuka">';
                }

                $blog .= '<div class="uk-width-1-3@m uk-width-1-2@s uk-inline">
                                <div class="uk-inline">
                                    <div class="uk-inline-clip uk-transition-toggle uk-light">
                                        <a href="'.$url.'" class="uk-link-reset">
                                            <div style="background: rgba(0,0,0,.2);" class="uk-position-cover"></div>
                                            '.$image.'
                                            <div class="uk-card uk-position-bottom-left uk-card-small">
                                                <div class="uk-card-body">
                                                    <div class="uk-transition-slide-left-small">
                                                        <h1 class="uk-margin-remove uk-text-bold blog-subtitle">'.$post->title.'</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>';
            }
            $loader .= '

                            <div id="remove-row" class="uk-align-center">
                                <h2>
                                    <a onclick="myFunction('. $post->id .')" id="btn-more" class="uk-button uk-button-default" > Load More </a>
                                </h2>
                            </div>
                        ';

            $response = array('blog' => $blog, 'loader' => $loader);
            echo json_encode($response);
        }
    }

    public function blogRead($slug)
    {
        $BlogRepository = new BlogRepository();

        $result= $BlogRepository->getPostsRead($slug);
        $posts = $result['post'];
        $status= $result['status'];
        $category = $this->getCategory();
        return view('blogs.read', compact('posts','category','status'));
    }

    public function category($slug)
    {
        $BlogRepository = new BlogRepository();

        $result= $BlogRepository->getPostsIndexCategory($slug);
        $posts = $result['post'];
        $status= $result['status'];
        $category = $this->getCategory();
        $header= $BlogRepository->getHeader();
        $title = $result['title'];
        return view('blogs.home', compact('posts','category','title','header','status'));
    }

    public function search(Request $request)
    {
        $BlogRepository = new BlogRepository();

        $result = $BlogRepository->getSearch($request->all());
        $posts = $result['post'];
        $status= $result['status'];
        $category = $this->getCategory();
        $header= $BlogRepository->getHeader();
        $keyword = $request->input('search');

        return view('blogs.search', compact('posts','category','keyword','header','status'));


    }

    public function getCategory()
    {
        return BlogCategory::orderBy('created_at', 'asc')->get();
    }
}
