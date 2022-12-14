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

        $posts= $BlogRepository->getPostsIndex();
        $header= $BlogRepository->getHeader();
        $category = $BlogRepository->getCategory();
        $title = trans('app.blog_title_home');

        if(count($posts) == 0){
            return view('blogs.blog_404', compact('category','title'));
        }
        else{
            return view('blogs.home', compact('posts','category','title','header'));
        }
    }

    public function category($slug)
    {
        $BlogRepository = new BlogRepository();

        $result = $BlogRepository->getPostsIndexCategory($slug);
        $category = $BlogRepository->getCategory();
        $header= $BlogRepository->getHeader();
        $posts = $result['posts'];
        $title = $result['title'];

        if(count($posts) == 0){
            return view('blogs.blog_404', compact('category','title'));
        }
        else{
            return view('blogs.home', compact('posts','category','title','header'));
        }
    }

    public function blogRead($slug)
    {
        $BlogRepository = new BlogRepository();

        $posts= $BlogRepository->getPostsRead($slug);
        $postsRandom = $BlogRepository->getPostRandom();
        $category = $BlogRepository->getCategory();

        if(count($posts) == 0){
            return view('blogs.blog_404', compact('category','title'));
        }
        else{
            return view('blogs.read', compact('posts','postsRandom'));
        }

    }


    public function search(Request $request)
    {
        $BlogRepository = new BlogRepository();

        $posts  = $BlogRepository->getSearch($request->all());
        $category = $BlogRepository->getCategory();
        $header= $BlogRepository->getHeader();
        $keyword = $request->input('keyword');

        if(count($posts) == 0){
            return view('blogs.search_404', compact('category','title','keyword'));
        }
        else{
            return view('blogs.search', compact('posts','category','keyword','header'));
        }

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
                $url = url('editorial/'.$post->slug);

                $image = '<img src="'. uploadCDN($post->photo_1) .'" alt="'.$post->title.'" onerror="this.src = \''.imageCDN(config('common.default.image_7')).'\'">';

                $blog .= '
                            <div class="uk-width-1-2 uk-inline">
                                <div class="uk-inline uk-visible-toggle">
                                    <div class="uk-inline-clip uk-light">
                                        <a href="'.$url.'" class="uk-link-reset">
                                            <div style="background: rgba(0,0,0,.1);" class="uk-position-cover"></div>
                                            '.$image.'
                                        </a>
                                    </div>
                                    <div class="uk-inline-clip uk-dark uk-position-cover uk-invisible-hover">
                                        <a href="'.$url.'" class="uk-link-reset">
                                            <div class="uk-position-cover uk-background-default"></div>
                                                '.$image.'
                                            <div class="uk-visible@m">
                                                <div class="uk-position-top-left">
                                                    <h1 class="uk-margin-remove blog-title">'.$post->title.'</h1>
                                                </div>
                                                <div class="uk-position-bottom-right">
                                                    <h4 class="uk-text-muted">'.date_format($post['created_at'],"F j, Y").'</h4>
                                                </div>
                                            </div>
                                            <div class="uk-hidden@m">
                                                  <div class="uk-card uk-position-bottom-left uk-card-small">
                                                      <div class="uk-card-body">
                                                          <div class="uk-hidden@m">
                                                              <div>
                                                                  <h5 class="uk-margin-remove uk-text-bold uk-text-small">'.$post->title.'</h5>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                             </div>
                                        </a>
                                    </div>
                                 </div>
                            </div>
                            ';
            }
            $loader .= '

                            <div id="remove-row" class="uk-align-center">
                                <h2>
                                    <a onclick="myFunction('. $post->id .')" id="btn-more" class="uk-button uk-button-default" > '.trans('app.load_more').' </a>
                                </h2>
                            </div>
                        ';

            $response = array('blog' => $blog, 'loader' => $loader, 'count' => count($posts));
            echo json_encode($response);
        }
    }

}
