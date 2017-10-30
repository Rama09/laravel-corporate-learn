<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 30.10.17
 * Time: 11:28
 */

namespace Corp\Repositories;


use Corp\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }
}