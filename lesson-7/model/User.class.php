<?php

/**
 * Модель пользователя
 */
    class User { 
        
        /**
         * Функция создает пароль
         * @var string $login логин пользователя
         * @var string $password пароль пользователя
         * @return string 
         */
        public function setPass($login, $password) {
            return strrev(md5($login)) . md5($password);
        }
        
        /**
         * Функция получения данных о пользователе
         * @return array
         */
        public function account() {
            $id = $_SESSION['user_id'];
            $res = Db::Instance() -> Select("SELECT * FROM users WHERE id=" . $id);
            foreach ($res as $key => $val) {
                return $val;
            }
        }

        /**
         * Функция получения данных о заказах пользователя
         * @var int $id ID пользователя или false для всех пользователей
         * @return array
         */
        public function getUserOrders($id) {
            if($id){
                $userOrders = Db::Instance() -> Select("SELECT id_order, date_order, status_order FROM orders WHERE id_user=" . $id . " ORDER BY id_order DESC"); //заказы одного пользователя
            } else {
                $userOrders = Db::Instance() -> Select("SELECT id_order, date_order, status_order FROM orders ORDER BY id_order DESC"); //заказы всех пользователей
            }

            $userGoods = []; //массив товаров в заказах пользователя
            if (!empty($userOrders)){
                foreach ($userOrders as $key => $val){ //находим сумму и список товаров в каждом заказе
                    $orderId = $val['id_order'];
                    $query = "SELECT og.id_order, og.id_good, og.good_count, og.good_size, c.category, b.brand, g.model, g.price, g.img, co.color
                    FROM order_goods AS og 
                    JOIN goods AS g ON og.id_good = g.id 
                    JOIN category AS c ON g.category = c.id_category 
                    JOIN brand AS b ON g.brand = b.id_brand 
                    JOIN color AS co ON g.color = co.id_color
                    WHERE id_order=" . $orderId;

                    $res = Db::Instance() -> Select($query);

                    $orderSum = 0; //сумма каждого заказа
                    foreach ($res as $key => $val){
                        $userGoods[] = $val;
                        $orderSum += $val['good_count'] * $val['price'];
                    }
                    foreach ($userOrders as $key => $val){
                        if ($val['id_order'] === $orderId){
                            $userOrders[$key]['sum'] = $orderSum;                       
                        }
                    }
                }
            }
            return array($userOrders, $userGoods);
        }
        
        /**
         * Функция регистрации нового пользователя
         * @return string сообщение на странице регистрации
         */
        public function reg() {
            $name = trim( strip_tags ($_POST['name']));
            $login =  trim( strip_tags ($_POST['login']));
            $password = trim( strip_tags ($_POST['password']));
            $email = trim( strip_tags ($_POST['email']));

            $query = "SELECT * FROM users WHERE login = '" . $login . "'";
            $res = Db::Instance() -> Select($query);

            if (!$res) {
                $query = "SELECT * FROM users WHERE email = '" . $email . "'";
                $res = Db::Instance() -> Select($query);

                if(!$res){
                    $password = $this -> setPass($login, $password);
                    $object = [
                        'name' => $name,
                        'login' => $login,
                        'password' => $password,
                        'email' => $email,
                        'status' => 'user'
                    ];
                    $res = Db::Instance() -> Insert('users', $object);
    
                    if (is_numeric($res)) {
                        return 'Регистрация прошла успешно. Войдите в <a href="index.php?class=user&method=login">личный кабинет</a>';
                    } else {
                        return "Регистрация прервалась ошибкой!";
                    }
                } else {
                    return "Такой E-mail уже зарегистрирован!";
                }               
            } else {
                return "Такой логин уже зарегистрирован!";
            }
        }
        
        /**
         * Функция авторизации пользователя
         * @return string сообщение на странице авторизации
         */
        public function login() {
            $login = trim( strip_tags ($_POST['login']));
            $password = trim( strip_tags ($_POST['password']));
            
            $query = "SELECT * FROM users WHERE login='" . $login . "'";
            $res = Db::Instance() -> Select($query);
            if($res){
                foreach ($res as $key => $val) {
                    if ($val['password'] == $this -> setPass($login, $password)) {
                        $_SESSION['user_id'] = $val['id'];
                        header('Location: index.php?class=user&method=account');
                    } else {
                        return 'Пароль не верный!';
                    }
                } 
            } else {
                return 'Пользователь с таким логином не зарегистрирован!';
            }             
        }
        
        /**
         * Функция выхода из личного кабинета
         */
        public function logout() {
            unset($_SESSION["user_id"]); 
        }    
        
        /**
         * Админ: функция изменения статуса заказа
         * данные приходят через ajax
         */
        public function changeOrderStatus(){
            $id = $_POST['id'];
            $action = $_POST['action'];
            $res = Db::Instance() -> Update('orders', ['status_order'=>$action], '`orders`.`id_order` = '.$id);
        }

         /**
         * Админ: функция изменения статуса отзыва
         * данные приходят через ajax
         */
        public function changeFeedbackStatus(){
            $id = $_POST['id'];
            $action = $_POST['action'];
            $res = Db::Instance() -> Update('feedbacks', ['status'=>$action], '`feedbacks`.`id` = '.$id);
        }

        /**
         * Админ: функция добавления товара в каталог
         * данные приходят через ajax
         */
        public function addToCatalog(){
            $path = "assets/img/catalog/";
            
            $endName = explode(".",$_FILES["img"]["name"]); 
            $newImgName = 'new_img'.'.'.end($endName);
            move_uploaded_file($_FILES["img"]["tmp_name"], $path.$newImgName); // Перемещаем изображение, меняя имя на "new_img"
            $res = Db::Instance() -> Insert('goods', [
                'category'=>$_POST['category'],
                'brand'=> $_POST['brand'],
                'model'=>$_POST['model'],
                'color'=>$_POST['color'],
                'season'=>$_POST['season'],
                'material'=>$_POST['material'],
                'description'=>$_POST['description'],
                'price'=>$_POST['price'],
                'img'=>$newImgName,
                'order_count'=>0,
            ]);
           
            if($res){                
                $goodId = Db::Instance() -> lastIndex(); // Получаем id нового товара
                $idImgName = $goodId.'.'.end($endName); // Делаем имя картинки в карточке товара такое же как и id товара
                $res = Db::Instance() -> Update('goods', ['img'=>$idImgName], '`goods`.`id` = '.$goodId);
                if($res){
                    rename($path.$newImgName, $path.$idImgName);
                }
                else {
                    echo "Ошибка добавления файла";
                }
            } else {
                echo "Ошибка добавления файла";
            }
        }

        /**
         * Админ: функция получения данных о товаре
         * данные приходят через ajax
         * @return array $good возвращается в ajax
         */
        public function showEditForm(){
            $query = "SELECT * FROM goods WHERE id=" . $_POST['id'];
            $res = Db::Instance() -> Select($query);
            foreach($res as $key => $val){
                $good = $val;
            }
            return $good;  
        }

        /**
         * Админ: функция обрабатывает данные полученные с формы редактирования товара через ajax
         */
        public function editGood(){
            $path = "assets/img/catalog/";
            if (is_uploaded_file($_FILES['img']['tmp_name'])){ // Если загружено новое изображение, получаем имя файла старого изображения и удаляем его
                $getImg = Db::Instance() -> Select("SELECT img FROM goods WHERE id='".$_POST['id']."'");
                foreach($getImg as $key => $val){
                    $img = $val['img'];
                    unlink($path.$img);
                }
                
                $endName = explode(".",$_FILES["img"]["name"]);
                $newImgName = $_POST['id'].'.'.end($endName);
                move_uploaded_file($_FILES["img"]["tmp_name"], $path.$newImgName); // Загружаем и переименовываем новое изображение
                $vars = [
                    'category'=>$_POST['category'],
                    'brand'=>$_POST['brand'],
                    'model'=>$_POST['model'],
                    'img'=>$newImgName,
                    'description'=>$_POST['description'],
                    'color'=>$_POST['color'],
                    'season'=>$_POST['season'],
                    'material'=>$_POST['material'],
                    'price'=>$_POST['price'],
                ];
                $res = Db::Instance() -> Update('goods', $vars, '`goods`.`id` = '.$_POST['id']);
            } 
            else {
                $vars = [
                    'category'=>$_POST['category'],
                    'brand'=>$_POST['brand'],
                    'model'=>$_POST['model'],
                    'description'=>$_POST['description'],
                    'color'=>$_POST['color'],
                    'season'=>$_POST['season'],
                    'material'=>$_POST['material'],
                    'price'=>$_POST['price'],
                ];
                $res = Db::Instance() -> Update('goods', $vars, '`goods`.`id` = '.$_POST['id']);
            }  
        }

        /**
         * Добавление отзыва
         */
        public function addFeedback(){
            $res = Db::Instance() -> Insert('feedbacks', [
                'id_user'=>$_SESSION["user_id"],
                'date'=> date("d-m-Y"), 
                'text'=>$_POST['text'],
                'title'=>$_POST['title'],
                'rating'=>$_POST['rating'],
                'status'=>'на проверке',
            ]);
        }
    }