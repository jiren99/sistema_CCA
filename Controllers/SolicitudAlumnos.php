<?php
class SolicitudAlumnos extends Controller{
    public function __construct() {
        session_start();
        
        parent::__construct();
    }
    public function index(){
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Modulo Solicitud De Alumnos');
        if (!empty($verificar || $id_user == 1)) {
            $this->views->getView($this, "index");
        } else {
            header('Location:'.base_url.'Errors/permisos');
        }

    }
    public function listar()
    {
        $data = $this->model->getSolicitudAlumnos();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1 && $data[$i]['aprobacion'] == 0 ) {
                $data[$i]['estado'] = '<span class="badge badge-primary">Recibido</span>';
                $data[$i]['aprobacion'] = '<span class="badge badge-primary">En espera..</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnAprobarSolicitud('.$data[$i]['id'].');"><i class=" far fa-thumbs-up"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarSolicitud('.$data[$i]['id'].');"><i class="far fa-thumbs-down"></i></button>
                <a class="btn btn-warning" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="far fa-file-pdf"></i></a>
                <div/>';
            } else if($data[$i]['estado'] == 1 && $data[$i]['aprobacion'] == 10){
                $data[$i]['estado'] = '<span class="badge badge-success">Aprobado</span>';
                $data[$i]['aprobacion'] = '<span class="badge badge-success">Aprobado <i class=" far fa-thumbs-up"></span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-warning" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="far fa-file-pdf"></i></a>
                <div/>';
            }
            else if($data[$i]['estado'] == 1 && $data[$i]['aprobacion'] == 1){
            $data[$i]['estado'] = '<span class="badge badge-success">No aprobado</span>';
            $data[$i]['aprobacion'] = '<span class="badge badge-danger">No probado <i class="far fa-thumbs-down"></i></span>';
            $data[$i]['acciones'] = '<div>
            <a class="btn btn-warning" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="far fa-file-pdf"></i></a>
            <div/>';
            }
            
            else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Cancelado</span>';
                $data[$i]['aprobacion'] = '<span class="badge badge-danger">Cancelado <i class="fas fa-ban"></i></span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-warning" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="far fa-file-pdf"></i></a>
                <div/>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->accionAprobar(1,$id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error, no se ha podido descartar la solicitud ";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function aprobar(int $id)
    {
        $data = $this->model->accionAprobar(10,$id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error, no se puede aprobar la solicitud, intentelo de nuevo ";
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
