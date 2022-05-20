<?php
session_start();
//
// Базовый контроллер сайта.
//
class C_Base extends C_Controller
{
    protected $title;		// заголовок страницы
    protected $content;		// содержание страницы
    protected $pdo;         // база данных PDO
    protected $auth;        // пользователь
    protected $sessionId;   // id сессиии
    protected $loading;     // v загрузки
    protected $admin;       // проверка на админку для скрытия чата


    protected function before(){
        $this->pdo = new M_DB();
        $this->loading = $this->Template('v/v_loading.php');
        $this->sessionId = session_id();
        $this->auth = $this->pdo->query("SELECT * FROM `users` WHERE `users`.`session` = '$this->sessionId'")->fetch();
    }

    public function render()
    {
        $menuText = ["Главная", "Отзывы"];
        $admin = "Админка";
        $link = ["Главная"=>"/index.php","Отзывы"=>"/index.php?act=reviews","Админка"=>"/index.php?act=admin"];
        $vars = array('menu'=>$menuText,'admin'=>$admin,'link'=>$link,'auth'=>$this->auth);
        $menu = $this->Template('v/v_menu.php',$vars);
        $chat = $this->Template('v/v_reviews-chat.php');
        if($this->admin){
            $vars = array('title' => $this->title, 'content' => $this->content, 'auth'=>$this->auth, 'menu'=>$menu, 'chat'=>$chat, 'adminButton'=>$this->admin);
            $page = $this->Template('v/v_main.php', $vars);
            echo $page;
        }else{

            $vars = array('title' => $this->title, 'content' => $this->content, 'auth'=>$this->auth, 'menu'=>$menu, 'chat'=>$chat);
            $page = $this->Template('v/v_main.php', $vars);
            echo $page;
        }
    }
}
