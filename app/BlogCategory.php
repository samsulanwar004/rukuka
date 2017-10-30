<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class BlogCategory extends Model
{
    use NestableTrait;

    protected $parent = 'parent_blog_categories_id';
    protected $table = 'blog_categories';
}
