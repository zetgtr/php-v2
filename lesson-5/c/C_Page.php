<?php

class C_Page extends C_Base
{
    protected $dataCatalog;
    protected $dataProduct;
    protected $dataBasket;

    public function action_index(){
        $this->title = 'Каталог';
        $this->dataCatalog = $this->pdo->query("SELECT * FROM goods WHERE id>0 limit 9");
        $this->content = $this->Template('v/v_index.php', ['table'=>$this->dataCatalog, 'auth'=>$this->auth,'loading'=>$this->loading]);
    }

    public function action_product(){
        $id = $_GET['id'];
        $pdo = $this->pdo;
        $pdo->query("UPDATE goods SET count = count+1 WHERE id='$id'")->fetch();
        $this->dataProduct = $pdo->query("SELECT * FROM goods WHERE id='$id'")->fetch();
        $this->title = $this->dataProduct["title"];
        $this->content = $this->Template('v/v_product.php', array('product'=>$this->dataProduct, 'auth'=>$this->auth));
    }
    public function action_reviews(){
        $pdo = $this->pdo;
        $reviews = $pdo->query("SELECT * FROM `reviews`");
        $this->title = "Отзывы";
        $this->content = $this->Template('v/v_reviews.php', array('reviews'=>$reviews));
    }
    public function action_basket(){
        $this->title = "Корзина";
        foreach ($_SESSION['basket'] as $basket){
            $id = $basket['id'];
            $this->dataBasket[] =  $this->pdo->query("SELECT * FROM `goods` WHERE `goods`.`id` = $id")->fetch();
        }
        $this->content = $this->Template('v/v_basket.php', ['items'=>$this->dataBasket]);
    }
    public  function action_admin(){
        $this->title = "Админка";
        $auth = $this->auth;
        $this->admin = true;
        if($auth["admin"]==="true"){
            $this->content = $this->Template('v/v_admin.php');
        }else{
            $this->content = $this->Template('v/v_noadmin.php');
        }
    }
}