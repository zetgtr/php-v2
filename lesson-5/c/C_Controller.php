<?php

abstract class C_Controller
{
// Генерация внешнего шаблона
    protected abstract function render();

    // Функция отрабатывающая до основного метода
    protected abstract function before();

    public function Request($action)
    {
        $this->before();//метод вызывается до формирования данных для шаблон
        $this->$action();   //$this->action_index
        $this->render();
    }
    //
    // Генерация HTML шаблона в строку.
    //
    protected function Template($vName, $vars = array())
    {
        // Установка переменных для шаблона.
        foreach ($vars as $k => $v)
        {
            $$k = $v;
        }

        // Генерация HTML в строку.
        ob_start();
        include "$vName";
        return ob_get_clean();
    }

    // Если вызвали метод, которого нет - завершаем работу
    public function __call($name, $params){
        die('Не пишите фигню в url-адресе!!!');
    }
}