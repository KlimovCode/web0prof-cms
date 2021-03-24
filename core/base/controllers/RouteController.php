<?php

namespace core\base\controllers;

use core\base\exceptions\RouteException;
use  core\base\settings\Settings;
use  core\base\settings\ShopSettings;

class RouteController
{
    /*
     * Main variables
     */
    protected $routes;

    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;
    // Main variables end

    private function __construct()
    {
        $adress_str = $_SERVER['REQUEST_URI'];
        var_dump($adress_str);

        // Processing URI, cut last '/' except root of site
        // site.ru/page/  => site.ru/page
        // and
        // site.ru/  => site.ru/
        if(strrpos($adress_str, '/') === strlen($adress_str)-1 && strrpos($adress_str, '/') !== 0) {
            //$this->redirect(rtrim($adress_str, '/', 301));
        }

        // name of run script by root directory (/index.php || /public/index.php)
        $path = $_SERVER['PHP_SELF'];

        // Processing string (/index.php => / || /public/index.php => /public/)
        $path = substr($path, 0, strpos($path, 'index.php'));

        // Check according path in url and in /config.php
        if($path === PATH) {

            // get routes from settings
            $this->routes = Settings::get('routes');

            // check init routes
            if(!$this->routes) throw new RouteException('can not get routes');



        } else {
            try {
                throw new \Exception('not correct directory of site');
            } catch (\Exception $e) {
                exit($e->getMessage());
            }
        }

    }

    /*
     * Singleton pattern start
     */
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