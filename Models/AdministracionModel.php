<?php
class AdministracionModel extends Query{
    public function __construct()
    {
        parent::__construct();      
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;

    }
    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;

    }
    public function modificar(string $rfc, string $nombredocumento, string $direccion, string $codigopostal, string $lada, string $numero1, string $numero2, string $correo, string $pagina, int $id)
    {
        $sql = "UPDATE configuracion SET rfc = ?, nombredocumento = ?, direccion = ?, codigopostal = ?, lada = ?, numero1 = ?, numero2 = ?, correo = ?, pagina = ? WHERE id = ?";
        $datos = array($rfc, $nombredocumento, $direccion, $codigopostal, $lada, $numero1, $numero2, $correo, $pagina, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1 ) {
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;   
    }
    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d
        ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data= $this->selectAll($sql);
        return $data;
    }
}
