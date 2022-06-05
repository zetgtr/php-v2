<?php

/**
 * Контроллер действий пользователя
 */
    class UserController extends Controller{
        /**
         * страница личного кабинета пользователя
         */
        public function account(){
            $this->title .= ' | Личный кабинет';

            $user = $this->user -> account();
            if($user['status']=='user'){   
                $orders = $this->user -> getUserOrders($user['id']);
                $template = $this->twig -> loadTemplate('userAccount.twig');
            } elseif($user['status']=='admin'){
                $orders = $this->user -> getUserOrders(false);
                $filters = $this->page-> filter();
                $goods = $this->page-> catalog('id', 'ASC', 24, $filters[0], $filters[1]);
                $feedbacks = $this->page-> feedbacks(false);
                $template = $this->twig -> loadTemplate('adminAccount.twig');
            }
            
            $this->content = $template -> render(array(
                'user' => $user,
                'orders' => $orders[0],
                'order_goods' => $orders[1],
                'goods' => $goods,
                'feedbacks' => $feedbacks,
            ));        
        }
        
        /**
         * Страница регистрации нового пользоватея 
         */
        public function reg() {		
            $this->title .= ' | Регистрация'; 
            
            $template = $this->twig -> loadTemplate('userReg.twig');
            
            if($this->isPost()) {
                $this->message = $this->user -> reg();
                echo 111;
                $this->content = $template -> render(array('message' => $this->message));
            } else {
                $this->content = $template -> render(array());
            }
        }

        /**
         * Страница входа на сайт 
         */
        public function login() {
            $this->title .= ' | Вход';

            $template = $this->twig -> loadTemplate('userLogin.twig');
            
            if($this->isPost()) {
                $this->message = $this->user -> login();
                $this->content = $template -> render(array('message' => $this->message));
            } else {
                $this->content = $template -> render(array());
            }
        }
        
        /**
         * функция выхода с сайта
         */
        public function logout() {
            $result = $this->user -> logout();

            header("location: index.php?class=page&method=index"); 
        }	
        
        /**
         * Админ: функция изменения статуса заказа
         */
        public function changeOrderStatus(){
            if($this->isPost()) {
                $result = $this->user -> changeOrderStatus();
            } 
        }

        /**
         * Админ: функция изменения статуса отзыва
         */
        public function changeFeedbackStatus(){
            if($this->isPost()) {
                $result = $this->user -> changeFeedbackStatus();
            } 
        }

        /**
         * Админ: функция добавления товара в каталог
         */
        public function addToCatalog(){
            if($this->isPost()) {
                $result = $this->user -> addToCatalog();
            } 
        }

        /**
         * Админ: функция получает данные товара для заполнения формы редактирования
         * @return string json в ajax
         */
        public function showEditForm(){
            if($this->isPost()) {
                $good = $this->user -> showEditForm(); 
                echo json_encode($good, JSON_UNESCAPED_UNICODE); 
            } 
        }

        /**
         * Админ: функция изменят данные товара
         */
        public function editGood(){
            if($this->isPost()) {
                $result = $this->user -> editGood();
            } 
        }

        /**
         * Добавление отзыва
         */
        public function addFeedback(){
            if($this->isPost()) {
                $result = $this->user -> addFeedback();
            } 
        }
    }