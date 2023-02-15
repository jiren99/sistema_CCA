<?php
class PeticionesModel extends Query{
    private $id, $motivo, $solicitud, $estado;
    public function __construct()
    {
        parent::__construct();      
    }

    public function getJefes()
    {
        $sql = "SELECT * FROM jefes WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function getmostrardatosjefes()
    {
        $sql = "SELECT * FROM jefes WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDivision()
    {
        $sql = "SELECT * FROM divisiones WHERE estado = 1";
        $data2 = $this->selectAll2($sql);
        return $data2;

    }
    public function getSemestre()
    {
        $sql = "SELECT * FROM semestres WHERE estado = 1";
        $data3 = $this->selectAll($sql);
        return $data3;

    }
    public function getCarrera()
    {
        $sql = "SELECT * FROM carreras WHERE estado = 1";
        $data4 = $this->selectAll($sql);
        return $data4;

    }
    public function getMotivoAcademico()
    {
        $sql = "SELECT * FROM motivos_academico WHERE estado = 1";
        $data5 = $this->selectAll($sql);
        return $data5;

    }

    public function getJefeRFC(string $matricula)
    {
        $sql = "SELECT j.*, d.id as id_division2, d.division FROM jefes j
        INNER JOIN divisiones d ON j.id_division = d.id WHERE matricula = '$matricula'";
        // $sql = "SELECT * FROM jefes WHERE rfc = '$rfc'";
        $data = $this->select($sql);
        return $data;

    }
    public function getPeticiones(int $id)
    {
        $sql = "SELECT j.*, d.id as id_division2, d.division FROM jefes j
        INNER JOIN divisiones d ON j.id_division = d.id WHERE j.id = $id";
        $data = $this->select($sql);
        return $data;  
    }
    public function registrarDetalles(string $fecha, int $id_jefe, int $id_usuario, int $id_division, string $nombre_alumno, int $id_semestre, int $id_carrera, string $numero_control, string $solicitud, int $id_motivo)
    {

        $sql = "INSERT INTO detalles_temporal(fecha, id_jefe, id_usuario, id_division, nombre_alumno, id_semestre, id_carrera, numero_control,solicitud, id_motivo) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $datos = array( $fecha, $id_jefe, $id_usuario, $id_division, $nombre_alumno, $id_semestre, $id_carrera, $numero_control, $solicitud, $id_motivo);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;

    }
    public function getDetalle(int $id)
    {
        $sql = "SELECT dt.*, dt.solicitud , dt.id AS iddetalle, je.id, je.nombre, je.apellido, di.id, di.division, se.id, se.semestres, car.id, car.carrera, mo.id, mo.motivo
        FROM detalles_temporal dt 
        INNER JOIN jefes je ON dt.id_jefe = je.id
        INNER JOIN divisiones di ON dt.id_division = di.id
        INNER JOIN semestres se ON dt.id_semestre = se.id
        INNER JOIN carreras car ON dt.id_carrera = car.id
        INNER JOIN motivos_academico mo ON dt.id_motivo = mo.id
        WHERE dt.id_usuario = $id ";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function getDetallesss(int $id_usuario)
    {
        $sql = "SELECT solicitud AS peticioness FROM detalles_temporal WHERE id_usuario = $id_usuario ";
        $data = $this->select($sql);
        return $data;

    }
    public function deleteDetalle(int $id)
    {
        $sql= "DELETE FROM detalles_temporal WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1 ) {
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;
    }
    public function registrarPeticion(string $peticion, int $id_usuario)
    {
        $sql = "INSERT INTO peticiones(peticion, id_usuario) VALUES (?,?)";
        $datos = array($peticion, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;
    }
    public function id_peticion()
    {
        $sql = "SELECT MAX(id) AS id FROM peticiones";
        $data = $this->select($sql);
        return $data;
    }
    public function registrarDetallesPeticiones(int $id_peticion, string $fecha, int $id_jefe, int $id_usuario, int $id_division, string $nombre_alumno, int $id_semestre, int $id_carrera, string $numero_control, string $solicitud, int $id_motivo)
    {
        $sql = "INSERT INTO detalle_peticion(id_peticion, fecha, id_jefe, id_usuario, id_division, nombre_alumno, id_semestre, id_carrera, numero_control,solicitud, id_motivo) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $datos = array( $id_peticion, $fecha, $id_jefe, $id_usuario, $id_division, $nombre_alumno, $id_semestre, $id_carrera, $numero_control, $solicitud, $id_motivo);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;
    }
    public function getInstituto()
    {
        $sql = "SELECT * FROM configuracion ";
        $data = $this->select($sql);
        return $data;

    }
    public function getDatosPeticiones(int $id_peticion)
    {
        $sql = "SELECT pe.*, dpe.*, je.id , je.nombre, je.apellido, di.id, di.division, 
        sem.id, sem.semestres, car.id, car.carrera,  mot.id, mot.motivo 
        FROM peticiones pe
        INNER JOIN detalle_peticion dpe ON pe.id = dpe.id_peticion
        INNER JOIN jefes je ON je.id = dpe.id_jefe
        INNER JOIN divisiones di ON di.id = dpe.id_division
        INNER JOIN semestres sem ON sem.id = dpe.id_semestre
        INNER JOIN carreras car ON car.id = dpe.id_carrera
        INNER JOIN motivos_academico mot ON mot.id = dpe.id_motivo 
        WHERE pe.id = $id_peticion";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function vaciardetallesdetabla(int $id_usuario)
    {
        $sql = "DELETE FROM detalles_temporal WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;   
    }
    public function getHistorialSolicitudesAlumnos()
    {
        $sql = "SELECT pe.*,dtpe.*, dtpe.id as id_peticiones_alumnos, dtpe.numero_control, carr.carrera FROM peticiones pe 
        INNER JOIN detalle_peticion dtpe
        INNER JOIN carreras carr ON carr.id = dtpe.id_carrera
        WHERE pe.id = dtpe.id_peticion";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getHistorialSolicitudesUsuario()
    {
        $sql = "SELECT * FROM peticiones";
        $data = $this->selectAll($sql);
        return $data;
    }
    

    public function getAnularPeticion(int $id_peticion)
    {
        $sql = "SELECT pe.*, detpe.* FROM peticiones pe 
        INNER JOIN detalle_peticion detpe ON pe.id = detpe.id_peticion WHERE pe.id = $id_peticion";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getAnular(int $id_peticion)
    {
        $sql = "UPDATE peticiones SET estado = ? WHERE id = ?";
        $datos = array(0, $id_peticion);
        $data = $this->save($sql, $datos);
        if ($data == 1 ) {
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;
    }



}

?>