<?php

namespace core\base\controllers;

use  core\base\settings\Settings;
use  core\base\settings\ShopSettings;

class RouteController
{
    // singleton pattern start
    private function __construct()
    {
        $temp = Settings::get('templateArr');
        $tempWithClue = ShopSettings::get('templateArr');
    }
    private function __clone()
    {
    }
    static private $_instance;
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
    // singleton pattern end
}