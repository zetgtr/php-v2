<?php
include_once 'AbstractProduct.php';

class PriceGood extends AbstractProduct{

    private $count;

    public function __construct(string $name,float $price,int $count)
    {
        parent::__construct($name,$price,$count);
        $this->count = $count;
    }

    
    protected function showCost(){
        return $this->getPrice() * $this->count;
    }
    public function getCheck(){
        return parent::getCheck() .
        "Количество: {$this->count}<br>
        Стоимость:  {$this->getCost()}";
    }
}