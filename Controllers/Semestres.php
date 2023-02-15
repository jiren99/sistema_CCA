<?php
class Semestres extends Controller{
    public function __construct() {
        session_start();
        
        parent::__construct();
    }
    public function index(){
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Módulo Semestres');
        if (!empty($verificar || $id_user == 1)) {
            $this->views->getView($this, "index");
        } else {
            header('Location:'.base_url.'Errors/permisos');
        }


    }
    public function listar()
    {
        $data = $this->model->getSemestre();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Vigente</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" type="button" onclick="btnEditarSemestres('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarSemestres('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Baja</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarSemestres('.$data[$i]['id'].');"><i class="fas fa-sync-alt"></i></button>
                <div/>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $semestre = $_POST["semestre"];
        $id = $_POST["id"];

        if (empty($semestre)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id == "") {
                    $data = $this->model->registrarSeme($semestre);
                    if ($data == "ok") {
                        $msg = "si";
                        
                    }elseif($data =="existe"){
                        $msg = "La semestre ya existe";
                    }else {
                        $msg = "Error al registrar el nuevo semestre";
                    }
                
            }else {
                $data = $this->model->modificarSemes($semestre,$id);
                if ($data == "modificado") {
                    $msg = "modificado";
                    
                } else {
                    $msg = "Error al modificar la division";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarSeme($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionSemestre(0,$id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el semestre, intentelo de nuevo ";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionSemestre(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al trata de poner vigente el semestre";
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
