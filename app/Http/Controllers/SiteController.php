<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenuRepository;
use Illuminate\Http\Request;
use LaravelMenu;

class SiteController extends Controller
{
    protected $p_rep;                       // portfolio repository
    protected $s_rep;                       // slider repository
    protected $a_rep;                       // articles repository
    protected $m_rep;                       // menu repository
    protected $c_rep;                       // comments repository

    protected $keywords;
    protected $meta_description;
    protected $title;

    protected $template;                    // шаблон
    protected $vars;                        // переменные передаваемые в шаблон
    protected $bar = 'no';                 // флаг наличия sidebar
    protected $contentRightBar = false;     // хранит инф-ю для правого sidebar
    protected $contentLeftBar = false;      // хранит инф-ю для левого sidebar

    public function __construct(MenuRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();

        $navigation = view(env('THEME').'.navigation')->with('menu', $menu);
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        if($this->contentRightBar) {
            $rightBar = view(env('THEME').'.rightBar')->with('content_rightBar', $this->contentRightBar);
            $this->vars = array_add($this->vars, 'rightBar', $rightBar);
        }

        $this->vars = array_add($this->vars, 'bar', $this->bar);

        $footer = view(env('THEME').'.footer');
        $this->vars = array_add($this->vars, 'footer', $footer);

        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_description', $this->meta_description);
        $this->vars = array_add($this->vars, 'title', $this->title);

        return view($this->template)->with($this->vars);
    }

    protected function getMenu()
    {
        $menu = $this->m_rep->get();
        $mBuilder = LaravelMenu::make('myNav', function($m) use ($menu) {
            foreach($menu as $item){
                if($item->parent_id == 0){
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if($m->find($item->parent_id)){
                        $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });

        return $mBuilder;
    }
}
