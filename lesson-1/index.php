<?php
//include_once "Clothes.php";
//$clothes = new Clothes('Кофта', 2500, 'M', 'red');
//echo $clothes->getInfo();


//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//$a1 = new A(); // зписываем в переменную а1 класс А
//$a2 = new A(); // зписываем в переменную а1 класс А
//$a1->foo();// Запускается функция foo в ней сробатывает инкримент будет 1
//$a2->foo();// Запускается функция foo в ней сробатывает инкримент будет 2 так как привязка к 1 классу результат будет один и тот же
//$a1->foo();// Запускается функция foo в ней сробатывает инкримент будет 3
//$a2->foo();// Запускается функция foo в ней сробатывает инкримент будет 4 так как привязка к 1 классу результат будет один и тот же

//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//class B extends A {
//}
//$a1 = new A(); // зписываем в переменную а1 класс А
//$b1 = new B(); // зписываем в переменную b1 наследник B и создается новый метод
//$a1->foo(); // будет 1
//$b1->foo(); // так как создан новый метод будет 1
//$a1->foo(); // будет 2
//$b1->foo(); // так как создан новый метод будет 2

//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//class B extends A {
//}
//$a1 = new A; // зписываем в переменную а1 класс А - Скобки не важны
//$b1 = new B; // зписываем в переменную b1 наследник B и создается новый метод - Скобки не важны
//$a1->foo(); // будет 1
//$b1->foo(); // так как создан новый метод будет 1
//$a1->foo(); // будет 2
//$b1->foo(); // так как создан новый метод будет 2
