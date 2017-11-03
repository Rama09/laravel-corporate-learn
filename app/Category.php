<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'article_categories';

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
