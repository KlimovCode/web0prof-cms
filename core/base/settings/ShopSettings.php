<?php


namespace core\base\settings;

use  core\base\settings\Settings;


class ShopSettings
{
    // getter
    static public function get($property) {
        return self::instance()->$property;
    }

    private $templateArr = [
        'text' => ['price'],
        'test' => 'string'
    ];

    // singleton pattern start - extended for clue properties with main setting class
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
        self::$_instance = new self;
        self::$_instance->baseSettings = Settings::instance();
        $baseProperties = self::$_instance->baseSettings->clueProperties(get_class());
        self::$_instance->setProterties($baseProperties);
        return self::$_instance;
    }
    // singleton pattern end

    protected function setProterties($properties) {
        if($properties) {
            foreach ($properties as $key => $value) {
                $this->$key = $value;
            }
        }
    }
}