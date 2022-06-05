<?php
class CatalogController extends Controller
{
    public $title;

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Главная';
    }
    /**
    * Страница каталога '/catalog.php'
    */
    public function index() {
        $this->title .= ' | Каталог';
        
        $filters = $this->page-> filter(); //массив фильтров
        $goods = $this->page-> catalog('id', 'ASC', 24, $filters[0], $filters[1]); //массив товаров каталога

        $template = $this->twig -> loadTemplate('catalog.twig');
        $this->content = $template -> render(array('goods' => $goods));
    }
}