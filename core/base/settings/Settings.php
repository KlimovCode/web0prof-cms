<?php


namespace core\base\settings;


class Settings
{
    private $routes = [
        'admin' => [
            'name' => 'admin',
            'path' => 'core/admin/controllers/',
            'hrUrl' => false
        ],
        'settings' => [
            'path' => 'core/base/settings/'
        ],
        'plugins' => [
            'path' => 'core/plugins',
            'hrUrl' => false
        ],
        'user' => [
            'path' => 'core/user/controllers',
            'hrUrl' => true,
            'routes' => [

            ]
        ],
        'default' => [
            'controller' => 'IndexController',
            'inputMethod' => 'inputData',
            'outputMethod' => 'outputData'
        ]
    ];

    private $templateArr = [
        'text' => ['name']
    ];

    // singleton pattern start
    static private $_instance;
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    static public function instance() {
        if(self::$_instance instanceof self) {
            return self::$_instance;
        }
        return self::$_instance = new self;
    }
    // singleton pattern end

    // getter
    static public function get($property) {
        return self::instance()->$property;
    }

    /*
     * Iterate this settings and refactor it accordance $class setting
     * add if it not exist in this settings
     * and override if exist in this settings
     */
    public function clueProperties($class) {
        $baseProperties = [];
        foreach ($this as $key => $value) {
            $property = $class::get($key);
            $baseProperties[$key] = $property;
        }
        exit();
    }
}