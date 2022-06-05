<?php
class GoodController extends Controller
{


    public function index() {
        $good = $this->page-> good(); //массив с описанием единицы товара
        $popularGoods = $this->page-> catalog('order_count', 'DESC', 20, true, true); //массив популярных товаров

        $this->title .= ' | Каталог | ' . $good['title'];

        $template = $this->twig -> loadTemplate('good.twig');
        $this->content = $template -> render(array('good' => $good, 'popularGoods' => $popularGoods));
    }
}