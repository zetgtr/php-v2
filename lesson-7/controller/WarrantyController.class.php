<?php
class WarrantyController extends Controller
{
    /**
    * Страница каталога '/warranty.php'
    */
    public function index() {
        $this->title .= ' | Оплата'; 
        $template = $this->twig -> loadTemplate('warranty.twig');
        $this->content = $template -> render(array());
    }
}