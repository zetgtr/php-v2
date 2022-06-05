<?php
class PaymentController extends Controller
{
    /**
    * Страница каталога '/payment.php'
    */
    public function index() {
        $this->title .= ' | Оплата'; 
        $template = $this->twig -> loadTemplate('payment.twig');
        $this->content = $template -> render(array());
    }
}