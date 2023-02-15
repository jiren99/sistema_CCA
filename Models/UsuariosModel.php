<?php
class UsuariosModel extends Query{
    private $usuario, $nombre, $apellido, $clave, $telefono, $id, $estado;
    public function __construct()
    {
        parent::__construct();      
    }
    public function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave ='$clave'";
        $data = $this->select($sql);
        return $data;

    }
    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function getPermisos()
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarUsuario( string $usuario, string $nombre, string $apellido, string $clave, string $telefono )
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->clave = $clave;
        $this->telefono = $telefono;
        $verificar = "SELECT * FROM usuarios WHERE usuario ='$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO usuarios(usuario, nombre, apellido, clave, telefono) VALUES (?,?,?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->apellido, $this->clave, $this->telefono);
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
    public function modificarUsuario( string $usuario, string $nombre, string $apellido, string $telefono, int $id )
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->id = $id;
        $this->telefono = $telefono;

        $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, apellido = ?, telefono = ? WHERE id = ?";
        $datos = array($this->usuario, $this->nombre, $this->apellido, $this->telefono, $this->id);
        $data = $this->save($sql, $datos);
        if ($data = 1) {
            $res = "modificado";
        }else {
            $res = "error";
        }
        return $res;
    }
    public function editarUser(int $id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionUser(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;

    }
    public function registrarPermisos(int $id_user, int $id_permiso)
    {
        $sql = "INSERT INTO detalle_permisos(id_usuario, id_permiso) VALUES (?,?)";
        $datos = array($id_user, $id_permiso);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function eliminarPermisos(int $id_user)
    {
        $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
        $datos = array($id_user);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function getDetallePermisos(int $id_user)
    {
        $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = $id_user";
        $data = $this->selectAll($sql);
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