<?php

/*
 * Constant for safety
 */
define('VG_ACCESS', true);

/*
 * For every response
 */
header('Content-type:text/html;charset=uft-8');
session_start();

/*
 * require settings
 */
require_once 'config.php';
require_once 'core/base/settings/internal_settings.php';

/*
 * Connect namespaces
 */
use core\base\exceptions\RouteException;
use core\base\controllers\RouteController;

/*
 * Main section
 */
try {
//     RouteController::getInstance()->route();
    RouteController::getInstance();
} catch (RouteException $e) {
    exit($e->getMessage());
}

