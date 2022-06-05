<?php
class DeliveryController extends Controller
{
    /**
     * Страница доставки '/delivery.php'
     */
    public function index() {
        $this->title .= ' | Доставка';
        $template = $this->twig -> loadTemplate('delivery.twig');
        $this->content = $template -> render(array());
    }
}