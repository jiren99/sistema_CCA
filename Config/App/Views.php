<?php
header("Access-Control-Allow-Original: *");
class Views{
    public function getView($controlador, $vista, $data="", $data2="",$data3="",$data4="",$data5="",$data6="")
    {
        $controlador = get_class($controlador);
        if ($controlador == "Home") {
            $vista = "Views/".$vista.".php";
        }else {
            $vista = "Views/".$controlador."/".$vista.".php"; //conexión de los modelos 
        }
        require $vista;
    }
}


?>