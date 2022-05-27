<?php
class Product
{
    protected $title;
    protected $price;
    /**
     * @param $title - Заголовок
     * @param $price - Цена
     */
    public function __construct($title, $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    public function getInfo(){
        return "Товар {$this->title} Стоит: {$this->price}";
    }
}