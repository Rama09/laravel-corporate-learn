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

    public function one($alias, $attr = [])
    {
        $article = parent::one($alias, $attr);

        if($article && !empty($attr)) {
            $article->load('comments');
            $article->comments->load('user');
        }

        return $article;
    }
}