<?php
abstract class AbstractProduct{
    private $name;
    private $price;
    abstract protected function showCost();
    public function getCost(){
        return $this->showCost();
    }
    public function __construct(string $name,float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
    public function getName(){
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getCheck(){
        return "Наименование: {$this->name}<br>
                Цена: {$this->price}<br>";
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setPrice($price){
        $this->price = $price;
    }
}