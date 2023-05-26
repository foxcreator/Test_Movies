<?php
error_reporting(E_ALL);
require_once dirname(__DIR__) . '/Config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';


try {
    $router = new \Core\Router();
    require_once BASE_DIR . '/routes/web.php';

    if (!preg_match('/assets/i', $_SERVER['REQUEST_URI'])){
        $router->dispatch($_SERVER['REQUEST_URI']);
    }

}catch (Exception $e){
    dd($e->getMessage());
}
