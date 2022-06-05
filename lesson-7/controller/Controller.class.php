<?php
class Controller
{
	   /**
         * @var Twig_Environment $twig Модель шаблонизатора Twig
         * @var PageM $page Модель страницы
         * @var UserM $user Модель пользователя
         * @var CartM $cart Модель корзины
         * @var string $title Заголовок страницы
         * @var string $content Содержание страницы
         * @var string $message вывод сообщения на страницу
         * @var array $user Данные пользователя
         * @var int $cartCount количество товаров в корзине
         */
        protected $title; 
        protected $loader;
        protected $twig;
        protected $content; 
        protected $message;
        protected $user;
        protected $page;
        protected $cart;

    public function __construct()
    {
        $this->title = 'REDSNEAKER';
        $this->loader = new Twig_Loader_Filesystem('../view');
        $this->twig = new Twig_Environment($this->loader); 
        $this->page = new Page();
        $this->user = new User();
        $this->cart = new Cart();
    }
    /**
      * Получить контент
      */
    public function getContent()
    {
        return $this->content;
    } 
    /**
      * Получить заголовок
      */
    public function getTitle()
    {
        return $this->title;
    } 
    /**
     * Проверка на POST
     */
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}