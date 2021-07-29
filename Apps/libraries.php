<?php
spl_autoload_register(function ($className) {
    $exp = str_replace('_', '/', $className);
    $path = str_replace("Apps", "", dirname(__FILE__));
    // var_dump($path . $exp . '.php');
    include_once $path . $exp . '.php';
});
