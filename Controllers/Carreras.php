<?php
class Carreras extends Controller{
    public function __construct() {
        session_start();
        
        parent::__construct();
    }
    public function index(){
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Módulo Carreras');
        if (!empty($verificar || $id_user == 1)) {
            $this->views->getView($this, "index");
        } else {
            header('Location:'.base_url.'Errors/permisos');
        }


    }
    public function listar()
    {
        $data = $this->model->getCarrera();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Vigente</span>';
                $data[$i]['acciones'] = '<div>
            <button class="btn btn-warning" type="button" onclick="btnEditarCarreras('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarCarreras('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
            <div/>';

            }else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Baja</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarCarreras('.$data[$i]['id'].');"><i class="fas fa-sync-alt"></i></button>
                <div/>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $codigo = $_POST["codigo"];
        $carrera = $_POST["carrera"];
        $id = $_POST["id"];

        if (empty($codigo)||empty($carrera)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id == "") {
                    $data = $this->model->registrarCarre($codigo, $carrera);
                    if ($data == "ok") {
                        $msg = "si";
                        
                    }elseif($data =="existe"){
                        $msg = "La carrera ya se encuntra registrada";
                    }else {
                        $msg = "Error al registrar la nueva carrera";
                    }
                
            }else {
                $data = $this->model->modificarCarre($codigo, $carrera, $id);
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
        $data = $this->model->editarCarre($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionCarrera(0,$id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar la carrera, intento de nuevo ";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function reingresar(int $id)
    {
        $data = $this->model->accionCarrera(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al trata de poner vigente la carrera";
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
