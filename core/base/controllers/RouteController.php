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

        // Processing URI, cut last '/' except root of site
        // site.ru/page/  => site.ru/page
        // and
        // site.ru/  => site.ru/
        if(strrpos($adress_str, '/') === strlen($adress_str)-1 && strrpos($adress_str, '/') !== 0) {
//            $this->redirect(rtrim($adress_str, '/', 301));
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

            // check on site.ru/routes['admin']['alias'] uri
            // if it word exist in $adress_str and at start after PATH
            if(strrpos($adress_str, $this->routes['admin']['alias']) === strlen(PATH)) {
                // Routes for admin panel
            } else {
                // Processing uri
                // /pages/phone => ['pages', 'phone']
                $url = explode('/', substr($adress_str, strlen(PATH)));
                $hrUrl = $this->routes['user']['hrUrl'];
                $route = 'user';
                $this->controller = $this->routes['user']['path'];
            }

            $this->createRoute($route, $url);

        } else {
            try {
                throw new \Exception('not correct directory of site');
            } catch (\Exception $e) {
                exit($e->getMessage());
            }
        }
    }

    /*
     * Main logic in file
     */
    private function createRoute($var, $arr) {
        $route = [];

        if(!empty($arr[0])) { // if controller exist
            if($this->routes[$var]['routes'][$arr[0]]) {
                $route = explode('/', $this->routes[$var]['routes'][$arr[0]]);
                $this->controller .= ucfirst($route[0].'Controller');
            } else {
                $this->controller .= $this->routes['default']['controller'];
            }
        } else { // default route for index page => site.ru || site.ru/ || site.ru/index
            $this->controller .= $this->routes['default']['controller'];
        }
        $this->inputMethod = $route[1] ? $route[1] : $this->routes['default']['inputMethod'];
        $this->outputMethod = $route[2] ? $route[2] : $this->routes['default']['outputMethod'];

        return;
    }
    // Main logic in file end

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