<?php
class DivisionesModel extends Query{
    private $id, $division, $estado;
    public function __construct()
    {
        parent::__construct();      
    }

    public function getDivision()
    {
        $sql = "SELECT * FROM divisiones";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarDivisi(string  $division)
    {
        
        $this->division = $division;

        $verificar = "SELECT * FROM divisiones WHERE division ='$this->division'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO divisiones(division) VALUES (?)";
            $datos = array($this->division);
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
    public function editarDivisi(int $id)
    {
        $sql = "SELECT * FROM divisiones WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function modificarDivisi(string $division, int $id)
    {
        $this->id = $id;
        $this->division = $division;
        
        $sql = "UPDATE divisiones SET division = ? WHERE id =?";
        $datos = array($this->division, $this->id);
        $data = $this->save($sql, $datos);
        if ($data = 1) {
            $res = "modificado";
        }else {
            $res = "error";
            }
        return $res;
    }

    public function acciondivision(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE divisiones SET estado = ? WHERE id = ?";
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