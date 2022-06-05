<?php
class Cart
{
    /**
     * Функция выводит массив товаров корзины
     * @return array $goods массив товаров корзины
     */
    public function cart() {
        $goods = [];
        if (isset($_SESSION['cart_goods'])) {
            $cartSession = $_SESSION['cart_goods']; //массив данных сессии корзины
            foreach ($cartSession as $key => $val) {
                $id = $val['id'];
                $quantity = $val['quantity'];
                $size = $val['size'];
                $sessionKey = $key;
                $query = "SELECT g.id, g.model, g.img, g.price, ca.category, b.brand, co.color
                FROM goods AS g
                JOIN brand AS b ON g.brand = b.id_brand
                JOIN color AS co ON g.color = co.id_color
                JOIN category AS ca ON g.category = ca.id_category 
                WHERE id='$id'";
                $res = Db::Instance() -> Select($query);
                foreach ($res as $key => $val) {
                    $val['quantity'] = $quantity;
                    $val['size'] = $size;
                    $val['key'] = $sessionKey;
                    $val['sum'] = $quantity * $val['price'];
                    $goods[] = $val;
                }                    
            }
        }
        return $goods;
    }
    /**
     * Функция подсчета количества товаров и суммы корзины
     * @return array
     */
    public function cartTotal($goods){
        $cartCount = 0;
        $cartSum = 0;
        foreach ($goods as $key => $val) {
            $cartCount += $val['quantity'];
            $cartSum += $val['price'] * $val['quantity'];
        }  
        return array($cartCount, $cartSum);
    }
    /**
     * Функция добавления товаров в корзину. Создает сессию корзины
     * Данные получает через ajax
     * @return array $cartSession возвращается в ajax
     */
    public function add() {   
        $id = $_POST['id'];
        $size = $_POST['size'];       
        $cartSession = [];
        if (isset($_SESSION['cart_goods'])) {
            $cartSession = $_SESSION['cart_goods'];
        }
        if(!empty($cartSession)){
            $i = false;
            foreach ($cartSession as $key => $val){
                if (($val['id'] === $id) && ($val['size'] === $size)) {
                    $cartSession[$key]['quantity'] = $cartSession[$key]['quantity'] + 1;
                    $i = true;
                }                                       
            }
            if(!$i){
                $cartSession[] = ['id' => $id, 'quantity' => 1, 'size' => $size];
            } 
        } else {
            $cartSession[] = ['id' => $id, 'quantity' => 1, 'size' => $size];
        }
        $_SESSION['cart_goods'] = $cartSession;
        return $cartSession;
    }
    /**
     * Функция удаляет товары из корзины. Данные получает через ajax
     */
    public function delete() {
        unset($_SESSION['cart_goods'][$_POST['key']]);
    }
    /**
     * Функция очистки корзины
     */
    public function clear() {
        unset($_SESSION['cart_goods']);
    }
    /**
     * Функция дсохраняет заказ в БД
     */
    public function buy() {
        if (isset($_SESSION['cart_goods']) && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $res = Db::Instance() -> Insert('orders', [
                'id_user' => $userId, 
                'date_order' => date("d-m-Y"), 
                'status_order' => 'Активен']);
            $orderId = Db::Instance() -> lastIndex();
            $orderGood = $_SESSION['cart_goods'];
            foreach ($orderGood as $key => $val) {
                $goodId = $val['id'];
                $goodCount = $val['quantity'];
                $goodSize = $val['size'];
                $res = Db::Instance() -> Insert('order_goods', [
                    'id_order' => $orderId, 
                    'id_good' => $goodId, 
                    'good_count' => $goodCount, 
                    'good_size' => $goodSize]); 
                
                $orderCount = Db::Instance() -> Select("SELECT `order_count` FROM goods WHERE id=$goodId");
                foreach($orderCount as $key => $val){
                    $res = Db::Instance() -> Update('goods', ['order_count'=>$val['order_count'] + 1], 'id = '.$goodId);
                }
            }
            unset($_SESSION['cart_goods']);
        }        
    }
}