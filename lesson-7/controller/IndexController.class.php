<?php
class IndexController extends Controller
{
    public $title;

    function __construct()
    {
        parent::__construct();
    }

	public function index() {           
		$popularGoods = $this->page->catalog('order_count', 'DESC', 20, true, true); //массив популярных товаров
		$newGoods = $this->page->catalog('id', 'DESC', 12, true, true); //массив новых товаров
		$template = $this->twig -> loadTemplate('mainContent.twig');
		$this->content = $template -> render(array('popularGoods' => $popularGoods, 'newGoods' => $newGoods));
	}
}