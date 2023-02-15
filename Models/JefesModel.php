<?php
class JefesModel extends Query{
    private $matricula, $rfc, $nombre, $apellido, $telefono, $correo, $id, $id_division, $estado;
    public function __construct()
    {
        parent::__construct();      
    }
    public function getDivisiones()
    {
        $sql = "SELECT * FROM divisiones WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function getJefes()
    {
        $sql = "SELECT j.*,d.id as id_divisiones, d.division FROM jefes j INNER JOIN divisiones d WHERE j.id_division = d.id";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarJefe( string $matricula, string $rfc, string $nombre, string $apellido, string $telefono, string $correo, int $id_division)
    {
        $this->matricula = $matricula;
        $this->rfc = $rfc;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->id_division = $id_division;
        $verificar = "SELECT * FROM jefes WHERE matricula ='$this->matricula'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO jefes(matricula, rfc, nombre, apellido, telefono, correo, id_division) VALUES (?,?,?,?,?,?,?)";
            $datos = array($this->matricula, $this->rfc, $this->nombre, $this->apellido, $this->telefono, $this->correo, $this->id_division);
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
    public function modificarJefe(string $matricula, string $rfc, string $nombre, string $apellido, string $telefono, string $correo, int $id_division, int $id)
    {
        $this->id = $id;
        $this->matricula = $matricula;
        $this->rfc = $rfc;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->id_division = $id_division;
        $sql = "UPDATE jefes SET matricula = ?, rfc = ?, nombre = ?, apellido = ?, telefono = ?, correo = ?, id_division = ? WHERE id =?";
        $datos = array($this->matricula, $this->rfc, $this->nombre, $this->apellido, $this->telefono, $this->correo, $this->id_division, $this->id);
        $data = $this->save($sql, $datos);
        if ($data = 1) {
            $res = "modificado";
        }else {
            $res = "error";
            }
        return $res;
    }
    public function editarJefe(int $id)
    {
        $sql = "SELECT * FROM jefes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionJefe(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE jefes SET estado = ? WHERE id = ?";
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