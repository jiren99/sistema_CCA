<?php
header("Access-Control-Allow-Original: *");
require_once "Config/Config.php";
  $ruta = !empty($_GET['url']) ? $_GET['url'] : "Home/index";
  $array = explode("/", $ruta);
  $controller = $array[0];
  $metodo = "index";
  $parametro = "";
  if (!empty($array[1])) {
      if (!empty($array[1] != "")) { #si es diferente de vacio
          $metodo = $array[1];
      }
  }
  if (!empty($array[2])) {
    if (!empty($array[2] != "")) { #si es diferente de vacio
        for ($i=2; $i < count($array); $i++) { 
            $parametro .= $array[$i]. ",";
        }
        $parametro = trim($parametro, ",");
    }
  }
  require_once "Config/App/autoload.php";
  $dirController = "Controllers/".$controller.".php";
  if (file_exists($dirController)) {
      require_once $dirController;
      $controller = new $controller();
      if (method_exists($controller, $metodo)) {
          $controller->$metodo($parametro);
      }else {
          header('Location: '.base_url.'Errors');
      }
  }else {
      
    header('Location: '.base_url.'Errors');
  }



?>
	