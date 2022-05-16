<?php
spl_autoload_register(function($className){
    include_once "classes/$className.php";
});


$weightGoods = new WeightGood("Сахар",1410,0.5);
$priceGood = new PriceGood("Книга",1000,5);
$digGoods = new DigitalGood("Microsoft Windows 11 Pro OEM",2649.99);

$goods = [$digGoods,$priceGood,$weightGoods];

foreach ($goods as $item){
   echo $item->getCheck()."<hr>";
}