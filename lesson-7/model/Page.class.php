<?php
class Page
{
        /**
         * Функция вывода списка товаров
         * @var string $sort условие сортировки
         * @var string $direction направление сортировки
         * @var int $limit количество выводимых на страницу товаров
         * @var string или bool $filter фильтр для товаров
         * @var любой тип $value значение для $filter
         * @return array $goods массив товаров
         */
        public function catalog(string $sort, string $direction, int $limit, $filter, $value) {
            if($sort && $direction && $limit && $filter && $value){
                $query = "SELECT g.id, g.model, g.material, g.img, g.price, g.description, 
                g.order_count, ca.category, b.brand, s.season, co.color
                FROM goods AS g
                JOIN brand AS b ON g.brand = b.id_brand
                JOIN season AS s ON g.season = s.id_season
                JOIN color AS co ON g.color = co.id_color
                JOIN category AS ca ON g.category = ca.id_category
                WHERE $filter = '$value'
                ORDER BY $sort $direction LIMIT $limit";
            } else {
                $query = "SELECT g.id, g.model, g.material, g.img, g.price, g.description, 
                g.order_count, ca.category, b.brand, s.season, co.color
                FROM goods AS g
                JOIN brand AS b ON g.brand = b.id_brand
                JOIN season AS s ON g.season = s.id_season
                JOIN color AS co ON g.color = co.id_color
                JOIN category AS ca ON g.category = ca.id_category";
            }
            $goods = Db::Instance() -> Select($query);
            return $goods;
        }

        /**
         * Функция вывода описания товара
         * @return array $val массив с описание товара
         */
        public function good() {
            $id = $_GET['id'];
            $query = "SELECT g.id, g.model, g.material, g.img, g.price, g.description, 
            ca.category, b.brand, s.season, co.color
            FROM goods AS g
            JOIN brand AS b ON g.brand = b.id_brand
            JOIN season AS s ON g.season = s.id_season
            JOIN color AS co ON g.color = co.id_color
            JOIN category AS ca ON g.category = ca.id_category 
            WHERE id='$id'";
            
            $res = Db::Instance() -> Select($query);
            foreach ($res as $key => $val) {
                return $val;
            }            
        } 

        /**
         * Функция для получения фильтров из url
         * @return array массив фильтров
         */
        public function filter() {
            if(isset($_GET['brand'])){
                $filter = 'b.brand';
                $value = $_GET['brand'];
            } else {
                $filter = true;
                $value = true;
            }
            return array($filter, $value);
        }

        /**
         * Функция добавляет email пользователя в БД
         */
        public function subscribe(){
            $query = "SELECT * FROM subscribe WHERE email = '" . $_POST['email'] . "'";
            $res = Db::Instance() -> Select($query);
            if(!$res){
                $res = Db::Instance() -> Insert('subscribe', ['email' => $_POST['email']]);
            } 
        }

        /**
         * Функция получает список отзывов
         * @var string $status статус отзыва или false
         * @return array $feedbacks
         */
        public function feedbacks($status){
            if($status){
                $query = "SELECT * FROM feedbacks WHERE status = '$status' ORDER BY id DESC";
            } else {
                $query = "SELECT * FROM feedbacks ORDER BY id DESC";
            }           
            $res = Db::Instance() -> Select($query);
            $feedbacks = [];
            foreach ($res as $key => $feedbackVal){
                $userId = $feedbackVal['id_user'];
                $user = Db::Instance() -> Select("SELECT * FROM users WHERE id = $userId");
                foreach ($user as $key => $userVal){
                    $userName = $userVal['name'];    
                }
                $feedbackVal['user_name'] = $userName;
                $feedbacks[] = $feedbackVal;
            }
            return $feedbacks;
        }
}