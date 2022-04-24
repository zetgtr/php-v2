<?php
include_once "Product.php";
class Clothes extends Product
{
    public function __construct($title, $price, $size, $color)
    {
        parent::__construct($title, $price);
        $this->size = $size;
        $this->color = $color;
    }

    public function getInfo(){
        return parent::getInfo()." размер: {$this->size}, цвет: {$this->color}";
    }
}