<?php

define('VG_ACCESS', true);

header('Content-type:text/html;charset=uft-8');
session_start();

require_once 'config.php';
require_once 'core/base/settings/internal_settings.php';

use core\base\exceptions\RouteException;
use core\base\controllers\RouteController;

try {
    $masha = RouteController::getInstance();
    $ivan = RouteController::getInstance();
    echo $masha->hair . '<br>';
    echo $ivan->hair . '<br>';

    $masha->hair = 'black';
    echo $masha->hair . '<br>';
    echo $ivan->hair . '<br>';

    // RouteController::getInstance()->route();
} catch (RouteException $e) {
    exit($e->getMessage());
}

