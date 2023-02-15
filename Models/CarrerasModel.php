<?php
class CarrerasModel extends Query{
    private $id, $codigo, $carrera, $estado;
    public function __construct()
    {
        parent::__construct();      
    }

    public function getCarrera()
    {
        $sql = "SELECT * FROM carreras";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarCarre(string  $codigo, string $carrera)
    {
        
        $this->codigo = $codigo;
        $this->carrera = $carrera;

        $verificar = "SELECT * FROM carreras WHERE codigo ='$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO carreras(codigo, carrera) VALUES (?,?)";
            $datos = array($this->codigo,$this->carrera);
            $data = $this->save($sql, $datos);
            if ($data = 1) {
            $res = "ok";
            }else {
            $res = "error";
            }
        }else {
            $res = "existe";
        }
        return $res;
    }
    public function editarCarre(int $id)
    {
        $sql = "SELECT * FROM carreras WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function modificarCarre(string  $codigo, string $carrera, int $id)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->carrera = $carrera;
        
        $sql = "UPDATE carreras SET codigo = ?, carrera = ? WHERE id =?";
        $datos = array($this->codigo,$this->carrera, $this->id);
        $data = $this->save($sql, $datos);
        if ($data = 1) {
            $res = "modificado";
        }else {
            $res = "error";
            }
        return $res;
    }

    public function accionCarrera(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE carreras SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;

    }
    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d
        ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data= $this->selectAll($sql);
        return $data;
    }

}

?>