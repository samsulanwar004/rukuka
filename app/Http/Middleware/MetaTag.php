<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Services\CurrencyService;
use Symfony\Component\HttpFoundation\Session\Session;

class MetaTag
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // load meta tag for SEO and tag Media Social
        $this->getMetaTag();

        return $next($request);
    }

    private function getMetaTag(){

        $session = new Session;

        $metaTag = $this->processGetMetaTag(\URL::current());
        $session->set('meta_tag', $metaTag['meta_tag']);

    }

    private function processGetMetaTag($currentURL){

        $defaultDesc  = 'rukuka is the original shopping center of indonesian goods made by expert craftsmen in their fields, visit rukuka.com you will be amazed';
        $defaultTitle = 'ruKuKa | how indonesian made really beautiful';

        $currentUrl = explode('/', $currentURL);

        if (count($currentUrl) >= 4) {

            if ($currentUrl[3] == 'product') {

                $product = DB::table('products')->where('slug','=', $currentUrl[4])->get()->last();

                if (count($product) > 0 ) {

                    $currency = (new CurrencyService)->getCurrentCurrency();

                    $specialDesc = $product->name . ' ' . strip_tags($product->content) . ', price: ' . $currency->symbol . number_format(($product->sell_price / $currency->value), 2) . ', specification: ' .  $product->technical_specification . ', categories: ' . $product->tags;

                    return $this->getStructurMetaTag($specialDesc, $product->name);

                }else{

                    return $this->getStructurMetaTag($defaultDesc, $defaultTitle);

                }

            }else if($currentUrl[3] == 'blog'){

                if (array_key_exists('4', $currentUrl) == false) {

                    return $this->getStructurMetaTag($defaultDesc, $defaultTitle);

                }else{

                    $articles = DB::table('blogs')->where('slug','=', $currentUrl[4])->get()->last();

                    if (count($articles) > 0 ) {

                        $specialDesc = strip_tags($articles->content);

                        return $this->getStructurMetaTag($specialDesc, $articles->title);

                    }else{

                        return $this->getStructurMetaTag($defaultDesc, $defaultTitle);

                    }

                }

            }else{

                return $this->getStructurMetaTag($defaultDesc, $defaultTitle);

            }

        }else{

            return $this->getStructurMetaTag($defaultDesc, $defaultTitle);

        }

    }

    private function getStructurMetaTag($desc, $title){

        $metaTag['meta_tag']['web_meta_tag']['description']          = $desc;

        $metaTag['meta_tag']['sosial_media_meta_tag']['title']       = $title;
        $metaTag['meta_tag']['sosial_media_meta_tag']['description'] = $desc;

        return $metaTag;

    }
}
