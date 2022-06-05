<?php
class RecommendController extends Controller
{
    /**
    * Страница каталога '/recommend.php'
    */
    public function index() {
        $this->title .= ' | Оплата'; 
        $template = $this->twig -> loadTemplate('recommend.twig');
        $this->content = $template -> render(array());
    }
}