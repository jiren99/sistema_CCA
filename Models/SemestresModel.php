<?php
class SemestresModel extends Query{
    private $id, $semestre, $estado;
    public function __construct()
    {
        parent::__construct();      
    }

    public function getSemestre()
    {
        $sql = "SELECT * FROM semestres";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarSeme(string $semestre)
    {
        $this->semestre = $semestre;

        $verificar = "SELECT * FROM semestres WHERE semestres ='$this->semestre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO semestres(semestres) VALUES (?)";
            $datos = array($this->semestre);
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
    public function editarSeme(int $id)
    {
        $sql = "SELECT * FROM semestres WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function modificarSemes(string $semestre, int $id)
    {
        $this->id = $id;
        $this->semestre = $semestre;
        
        $sql = "UPDATE semestres SET semestres = ? WHERE id =?";
        $datos = array($this->semestre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data = 1) {
            $res = "modificado";
        }else {
            $res = "error";
            }
        return $res;
    }

    public function accionSemestre(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE semestres SET estado = ? WHERE id = ?";
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