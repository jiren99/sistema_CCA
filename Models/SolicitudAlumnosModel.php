<?php
class SolicitudAlumnosModel extends Query{
    private $id, $semestre, $estado, $aprobacion;
    public function __construct()
    {
        parent::__construct();      
    }

    public function getSolicitudAlumnos()
    {
        $sql = "SELECT pe.*,dtpe.*, dtpe.id as id_peticiones_alumnos, carr.carrera FROM peticiones pe 
        INNER JOIN detalle_peticion dtpe
        INNER JOIN carreras carr ON carr.id = dtpe.id_carrera
        WHERE pe.id = dtpe.id_peticion";
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

    public function accionAprobar(int $aprobacion, int $id)
    {
        $this->id = $id;
        $this->aprobacion = $aprobacion;
        $sql = "UPDATE peticiones SET aprobacion = ? WHERE id = ?";
        $datos = array($this->aprobacion, $this->id);
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