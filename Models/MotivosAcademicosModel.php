<?php
class MotivosAcademicosModel extends Query{
    private $id, $motivo, $estado;
    public function __construct()
    {
        parent::__construct();      
    }

    public function getMotivoAcademico()
    {
        $sql = "SELECT * FROM motivos_academico";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarMotiAcademi(string  $motivo)
    {
        
        $this->motivo = $motivo;

        $verificar = "SELECT * FROM motivos_academico WHERE motivo ='$this->motivo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO motivos_academico(motivo) VALUES (?)";
            $datos = array($this->motivo);
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
    public function editarMotiAcademi(int $id)
    {
        $sql = "SELECT * FROM motivos_academico WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function modificarMotiAcademi(string $motivo, int $id)
    {
        $this->id = $id;
        $this->motivo = $motivo;
        
        $sql = "UPDATE motivos_academico SET motivo = ? WHERE id =?";
        $datos = array($this->motivo, $this->id);
        $data = $this->save($sql, $datos);
        if ($data = 1) {
            $res = "modificado";
        }else {
            $res = "error";
            }
        return $res;
    }

    public function accionMotivoAcademico(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE motivos_academico SET estado = ? WHERE id = ?";
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