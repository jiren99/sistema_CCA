<?php
class Usuarios extends Controller{
    public function __construct() {
        session_start();
        
        parent::__construct();
    }
    public function index(){
        
        if (empty($_SESSION['activo'])) {
            header("location:".base_url);
        }
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Módulo Usuarios');
        if (!empty($verificar || $id_user == 1)) {
            $this->views->getView($this, "index");
        } else {
            header('Location:'.base_url.'Errors/permisos');
        }

    }
    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                if ($data[$i]['id']==1) {
                    $data[$i]['acciones'] = '<div>
                    <span class="badge badge-primary">Administrador</span>
                    <div/>';
                }else {
                    $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <a class="btn btn-dark" href="'.base_url.'Usuarios/permisos/'.$data[$i]['id'].'"><i class="fas fa-key"></i></a>
                    <button class="btn btn-warning" type="button" onclick="btnEditarUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarUser('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                    <div/>';
                }
            }else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarUser('.$data[$i]['id'].');"><i class="fas fa-sync-alt"></i></button>
                <div/>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function validar()
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos estan vacios";
        }else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            }
            else {
                $msg = "USUARIO O CLAVE DE ACCESO INCORRECTO";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $usuario = $_POST["usuario"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $clave = $_POST["clave"];
        $confirmar = $_POST["confirmar"];
        $telefono = $_POST["telefono"];
        $id = $_POST["id"];
        $hash = hash("SHA256", $clave);
        if (empty($usuario) || empty($nombre) || empty($apellido) || empty($telefono)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = "Las contraseñas no coinciden";
                }else {
                    $data = $this->model->registrarUsuario($usuario,$nombre,$apellido,$hash, $telefono);
                    if ($data == "ok") {
                        $msg = "si";
                        
                    }elseif($data =="existe"){
                        $msg = "El usuario ya existe";
                    }else {
                        $msg = "Error al registrar el usuario";
                    }
                }
            }else {
                $data = $this->model->modificarUsuario($usuario,$nombre,$apellido, $telefono, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                    
                } else {
                    $msg = "Error al modificar el usuario";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrarLoginn()
    {
        $usuario = $_POST["usuario"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $clave = $_POST["clave"];
        $telefono = $_POST["telefono"];
        $hash = hash("SHA256", $clave);
        if (empty($usuario) || empty($nombre) || empty($apellido)|| empty($clave)|| empty($telefono) ) {
            $msg = "Todos los campos son obligatorios";
        }
        else {
            $data = $this->model->registrarUsuario($usuario,$nombre,$apellido,$hash, $telefono);
            if ($data == "ok") {
                $msg = "si";
                
            }else if($data =="existe"){
                $msg = "El usuario ya existe";
            }else {
                $msg = "El usuario ya existe, pruebe con otro usuario nuevo ";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionUser(0,$id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el usuario ";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al reingresar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function permisos($id){
        if (empty($_SESSION['activo'])) {
            header("location:".base_url);
        }
        $data['datos'] = $this->model->getPermisos();
        $permisos = $this->model->getDetallePermisos($id);
        $data['asignados'] = array();
        foreach ($permisos as $permiso) {
            $data['asignados'][$permiso['id_permiso']] = true;
        }
        $data['id_usuario'] = $id;
        $this->views->getView($this, "permisos", $data,);
    }
    public function registrarPermiso()
    {
        $msg = '';
        $id_user = $_POST['id_usuario'];
        $eliminar = $this->model->eliminarPermisos($id_user);
        if ($eliminar == 'ok') {
            foreach ($_POST['permisos'] as $id_permiso) {
                $msg = $this->model->registrarPermisos($id_user, $id_permiso);
            }
            if ($msg == 'ok') {
                $msg = array('msg' => 'Permisos asignados', 'icono'=>'success');
            } else {
                $msg = array('msg' => 'Error al asignar los permisos anteriores', 'icono'=>'error');
            }
            
        } else {
            $msg = array('msg' => 'Error al eliminar los permisos anteriores', 'icono'=>'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    }

    public function salir()
    {
        session_destroy();
        header("location:".base_url);
    }


}
?>
