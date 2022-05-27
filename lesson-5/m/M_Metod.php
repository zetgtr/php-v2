<?php

class M_Metod extends C_Controller
{
    protected $content;     // содержание страницы
    protected $pdo;         // база данных PDO
    protected $auth;        // пользователь
    protected $sessionId;   // id сессиии
    protected $metod;       // какой метод выполняется

    protected function before()
    {
        $pdo = $this->pdo = new M_DB();
        $this->sessionId = session_id();
        $this->auth = $pdo->query("SELECT * FROM `users` WHERE `users`.`session` = '$this->sessionId'")->fetch();
    }


    public function action_add_catalog(){
        if($_POST['idMax']){
            $this->metod = 'content';
            $id = $_POST['idMax'];
            $data = $this->pdo->query("SELECT * FROM goods WHERE id>$id limit 9");
            $this->content = $this->Template('v/v_add-catalog.php', ['table'=>$data, 'auth'=>$this->auth]);
        }

    }

    public function action_add_reviews(){
        $this->metod = 'add_reviews';
        $name = $_POST["reviews-name"];
        $text = $_POST["reviews-text"];
        $this->pdo->query("INSERT INTO reviews (name, text) VALUES ('$name', '$text')")->fetch();
    }

    public function action_add_basket(){
        $id = $_POST['id'];
        $basket = false;
        if ($_SESSION['basket']) {
            for ($i=0;$i<count($_SESSION['basket']);$i++){
                if($_SESSION['basket'][$i]['id']===$id){
                    $basket = true;
                    ++$_SESSION['basket'][$i]['count'];
                }
            }
            if(!$basket){
                $_SESSION['basket'][] = ["id" => $id, 'count' => 1];
            }
        } else {
            $_SESSION['basket'] = [0 => ["id"=>$id, 'count'=>1]];
        }
    }

    public function action_edit_count_basket(){
        $session = $this->sessionId;
        for($i=0;$i<count($session['basket']);$i++){
            if($session['basket'][$i]['id']===$_POST['id']){
                $session['basket'][$i]['count'] = $_POST['count'];
                echo "Цена: ".$_POST["price"]*$_POST['count']." руб.";
            }
        }
    }

    public function action_bay_basket(){
        if($_SESSION['basket']){
            foreach($_SESSION['basket'] as $basket){
                $user = $this->auth['id_user'];
                $id = $basket['id'];
                $count = $basket['count'];
                $this->pdo->query("INSERT INTO `purchases` (user, goods, count) VALUES ($user,$id,$count)")->fetch();
            }
        }
        $_SESSION['basket'] = [];?>
         "<div class='basket_false'>Корзина пуста</div>";<?
    }

    public function action_del_basket(){
        $_SESSION['basket'] = array_filter($_SESSION['basket'],  function ($k) {
            if ($k['id'] == $_POST['id']) {
                $_SESSION['basket'][0] = null;
            } else {
                return $k !== $_POST['id'];
            }
        });
        if(!$_SESSION['basket']){?>
            <h1 class="basket_false">Корзина пуста</h1>
        <?}
    }

    public function action_admin_user(){
        $this->metod = "content";
        $users = $this->pdo->query("SELECT * FROM users");
        $this->content = $this->Template('v/v_admin-user.php', ['users'=>$users]);
    }

    public function action_admin_user_edit(){
        $id = $_POST["id"];
        $user = $this->pdo->query("SELECT * FROM users WHERE users.id_user = $id")->fetch();
        if($user["admin"]==="true"){
            $this->pdo->prepare("UPDATE users SET admin = 'false' WHERE users.id_user = :id")->execute(['id'=>$id]);
        }elseif($user["admin"]==="false"){
            $this->pdo->prepare("UPDATE users SET admin = 'true' WHERE users.id_user = :id")->execute(['id'=>$id]);
        };
    }

    public function action_admin_goods(){
        $this->metod = "content";
        $goods = $this->pdo->query("SELECT * FROM goods");
        $loading = $this->Template('v/v_loading.php');
        $this->content = $this->Template('v/v_admin-goods.php', ['goods'=>$goods,'loading'=>$loading]);
    }

    public function action_admin_goods_save(){
        $data =['title' => $_POST['title'], 'text' => $_POST['text'], 'id' => $_GET['id']];
        $this->pdo->prepare("UPDATE goods SET title=:title, text=:text WHERE goods.id = :id")->execute($data);
    }

    public function action_admin_goods_add(){
        $this->metod = "content";
        $this->pdo->query("INSERT INTO `goods` (id) VALUES (NULL);")->fetch();
        $goods = $this->pdo->query("SELECT * FROM goods ORDER BY id DESC LIMIT 1")->fetch();
        $this->content = $this->Template('v/v_admin-add-goods.php',['product'=>$goods]);
    }

    public function action_admin_goods_remove(){
        $this->metod = "content";
        $id = $_GET['id'];
        $pdo = $this->pdo;
        $pdo->query("DELETE FROM `goods` WHERE `goods`.`id` = $id")->fetch();
        $goods = $pdo->query("SELECT * FROM goods");
        $this->content = $this->Template('v/v_remove-goods.php', ['goods'=>$goods]);
    }

    public function action_admin_goods_modal(){
        $this->metod = "content";
        $id = $_POST['id'];
        $goods = $this->pdo->query("SELECT * FROM `goods` WHERE `goods`.`id` = '$id'")->fetch();
        $this->content = $this->Template('v/v_admin-modal.php',['product'=>$goods]);
    }

    public function render()
    {
        switch ($this->metod)
        {
            case 'content':
                echo $this->content;
                break;
            case 'add_reviews':
                header("Location: index.php?act=reviews&c=reviews");
                break;
        }
    }
}