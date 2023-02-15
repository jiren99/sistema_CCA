<?php
class Jefes extends Controller{
    public function __construct() {
        session_start();
        
        parent::__construct();
    }
    public function index(){
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Módulo Jefes');
        if (!empty($verificar || $id_user == 1)) {
            $data['divisiones'] = $this->model->getDivisiones();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:'.base_url.'Errors/permisos');
        }



    }
    public function listar()
    {
        $data = $this->model->getJefes();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Vigente</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" type="button" onclick="btnEditarJefe('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarJefe('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Baja</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarJefe('.$data[$i]['id'].');"><i class="fas fa-sync-alt"></i></button>
                <div/>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $matricula = $_POST["matricula"];
        $rfc = $_POST["rfc"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $division = $_POST["division"];
        $id = $_POST["id"];
        if (empty($matricula) || empty($rfc) ||empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($division)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id == "") {
                    $data = $this->model->registrarJefe($matricula, $rfc, $nombre,$apellido,$telefono, $correo, $division);
                    if ($data == "ok") {
                        $msg = "si";
                        
                    }elseif($data =="existe"){
                        $msg = "La matricula ya existe ya existe";
                    }else {
                        $msg = "Error al registrar el jefe de division";
                    }
                
            }else {
                $data = $this->model->modificarJefe($matricula, $rfc,$nombre,$apellido, $telefono, $correo, $division, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                    
                } else {
                    $msg = "Error al modificar el jefe de division";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarJefe($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionJefe(0,$id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el jefe de división ";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionJefe(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al volver a poner vigente el jefe de división";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function salir()
    {
        session_destroy();
        header("location:".base_url);
    }

}
?>
