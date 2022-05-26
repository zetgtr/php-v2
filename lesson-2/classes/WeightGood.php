<?php
include_once 'AbstractProduct.php';

class WeightGood extends AbstractProduct{
    private $weight;
    public function __construct(string $name,float $price,float $weight)
    {
        parent::__construct($name,$price,$weight);
        $this->weight = $weight;
    }

    protected function showCost(){
        return $this->getPrice() * $this->weight;
    }
    public function getCheck(){
        return parent::getCheck() .
        "Вес: {$this->weight} кг<br>
        Стоимость:  {$this->getCost()}";
    }
}