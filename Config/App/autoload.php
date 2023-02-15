<?php
header("Access-Control-Allow-Original: *");
spl_autoload_register(function($class){
    if (file_exists("Config/App/".$class.".php")) {
        require_once "Config/App/".$class.".php";
    }
})

?>