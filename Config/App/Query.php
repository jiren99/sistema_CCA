<?php
header("Access-Control-Allow-Original: *");
 class Query extends Conexion
 {
     private $pdo, $con, $sql, $datos;
     public function __construct(){
         $this->pdo = new Conexion();
         $this->con = $this->pdo->conect();    
     }
     public function select(string $sql)
     {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetch(PDO::FETCH_ASSOC);
        return $data;
     }
     public function selectAll(string $sql)
     {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
     }
     public function selectAll2(string $sql)
     {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data2 = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data2;
     }

     public function save(string $sql, array $datos)
     {
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if ($data) {
            $res = 1;
        }else{
            $res = 0;
        }
        return $res;
     }
 }
 
 ?>