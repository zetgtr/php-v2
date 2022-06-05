<?php
class RefundController extends Controller
{
    /**
    * Страница каталога '/refund.php'
    */
    public function index() {
        $this->title .= ' | Оплата'; 
        $template = $this->twig -> loadTemplate('refund.twig');
        $this->content = $template -> render(array());
    }
}