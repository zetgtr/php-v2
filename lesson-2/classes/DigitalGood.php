<?php
include_once 'AbstractProduct.php';

class DigitalGood extends AbstractProduct{

    public function __construct(string $name,float $price)
    {
        parent::__construct($name,$price);
    }
    protected function showCost(){
        return $this->getPrice();
    }
    public function getCheck(){
        return parent::getCheck();
    }
}