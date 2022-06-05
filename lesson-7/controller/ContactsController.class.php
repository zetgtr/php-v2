<?php
class ContactsController extends Controller
{
    /**
    * Страница каталога '/contacts.php'
    */
    public function index() {
        $this->title .= ' | Контакты';
        $template = $this->twig -> loadTemplate('contacts.twig');
        $this->content = $template -> render(array());
    }
}