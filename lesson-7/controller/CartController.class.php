<?php

class CartController extends Controller
{ 
         /**
     * страница корзины пользователя '/cart.php'
     */
    public function cart() {
        $this->title .= ' | Корзина';
      
        if (isset($_SESSION['user_id'])) {
            $user = $this->user -> account();
            echo 123;
        } else {
            $user = false;
        }
        $goods = $this->cart -> cart(); 
        $cartCount = $this->cart -> cartTotal($goods)[0]; 
        $cartSum = $this->cart -> cartTotal($goods)[1];       
        $template = $this->twig -> loadTemplate('cart.twig');
        $this->content = $template -> render(array(
            'goods' => $goods, 
            'user' => $user,
            'cartCount' => $cartCount,
            'cartSum' => $cartSum,
        ));
    }
    /**
     * добавление товара в корзину
     */
    public function add() {
        $this->cart -> add();
    }
    /**
     * удаление товара из корзины
     */
    public function delete() {
        $this->cart -> delete();
    }
    /**
     * очистка корзины
     */
    public function clear() {
        $this->cart->clear();
        header("location: index.php?class=cart&method=cart"); 
    }
    /**
     * оформление заказа
     */
    public function buy() {
        $this->cart -> buy();
    }

}
