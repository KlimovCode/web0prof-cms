<?php

namespace core\base\controllers;

use  core\base\settings\Settings;

class RouteController
{
    static private $_instance;
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    static public function getInstance() {
        /*
         * self:: // ссылаемся на наш собственный класс
         */
        // если в свойстве $_instance нашего класа хранится объект нашего класса
        if(self::$_instance instanceof self) {
            // если да, то возвращаем это свойство
            return self::$_instance;
        }
        // иначе вернем это свойство с записанным в него объектом нашего класса
        return self::$_instance = new self;
    }
}