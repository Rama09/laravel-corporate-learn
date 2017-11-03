<?php

namespace Corp\Http\Controllers;

use Corp\Category;
use Corp\Menu;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;
use Corp\Repositories\MenuRepository;
use Corp\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

class ArticlesController extends SiteController
{
    public function __construct(PortfolioRepository $p_rep, ArticlesRepository $a_rep, CommentsRepository $c_rep)
    {
        parent::__construct(new MenuRepository(new Menu()));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;

        $this->bar = 'right';
        $this->template = env('THEME').'.article';
    }

    public function index($cat_alias = false)
    {
        $this->keywords = 'Home page';
        $this->meta_description = 'Home page';
        $this->title = 'Home page';

        $articles = $this->getArticles($cat_alias);

        $content = view(env('THEME').'/articles_content')->with('articles', $articles);
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolio = $this->getPortfolio(config('settings.recent_portfolio'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with([
            'comments' => $comments,
            'portfolio' => $portfolio,
        ]);

        return $this->renderOutput();
    }

    private function getArticles($alias = false)
    {
        $where = false;

        if($alias) {
            $id = Category::select('id')->where('alias', $alias)->first()->id;
            $where = ['category_id', $id];
        }

        $articles = $this->a_rep->get(['id', 'title', 'alias', 'created_at', 'img', 'desc', 'user_id', 'category_id'], false, true, $where);

        if($articles) {
            $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }

    private function getComments($take)
    {
        $comments = $this->c_rep->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);

        if($comments) {
            $comments->load('user', 'article');
        }

        return $comments;
    }

    private function getPortfolio($take)
    {
        $portfolio = $this->p_rep->get(['title', 'text', 'alias', 'customer', 'img', 'filter_alias'], $take);

        return $portfolio;
    }

    public function show($alias = false)
    {
        $article = $this->a_rep->one($alias, ['comments' => true]);
        if($article) {
            $article->img = json_decode($article->img);
        }
        $content = view(env('THEME').'.article_content')->with('article', $article);
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolio = $this->getPortfolio(config('settings.recent_portfolio'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with([
            'comments' => $comments,
            'portfolio' => $portfolio,
        ]);

        return $this->renderOutput();
    }

}
