<?php


namespace core\base\settings;


class Settings
{
    private $routes = [
        'admin' => [
            'alias' => 'admin',
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
        'text' => ['name'],
        'test' => 'string by main settings'
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

    /*
     * Getter
     */
    static public function get($property) {
        return self::instance()->$property;
    }
    // Getter end

    /*
     * Iterate this settings and refactor it accordance $class setting
     * add if it not exist in this settings
     * and override if exist in this settings
     */
    public function clueProperties($class) {
        $baseProperties = [];
        foreach ($this as $key => $value) {
            $property = $class::get($key);
            if(is_array($property) && is_array($value)) {
                $baseProperties[$key] = $this->arrayMergeRecursive($this->$key, $property);
                continue;
            }
            if(!$property) $baseProperties[$key] = $this->$key;
        }
        exit();
    }

    public function arrayMergeRecursive() {
        $arrays = func_get_args();
        $base = array_shift($arrays);
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if(is_array($value) && is_array($base[$key])) {
                    $base[$key] = $this->arrayMergeRecursive($base[$key], $value);
                } else {
                    if(is_int($key)) {
                        if(!in_array($value, $base)) array_push($base, $value);
                        continue;
                    }
                    $base[$key] = $value;
                }
            }
        }
        return $base;
    }
}