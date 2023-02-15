<?php
 class Administracion extends Controller{
     public function __construct()
     {
         session_start();
         if (empty($_SESSION['activo'])) {
             header("location: " . base_url);
         }
         parent::__construct();
     }
     public function index()
     {
         $id_user = $_SESSION['id_usuario'];
         $verificar = $this->model->verificarPermiso($id_user, 'Módulo Institucion');
         if (!empty($verificar) || $id_user == 1) {
            $data=$this->model->getEmpresa();
            $this->views->getView($this, "index", $data);
         } else {
             header('Location:'.base_url.'Errors/permisos');
         }

     }
     public function home()
     {
        $data['usuarios']=$this->model->getDatos('usuarios');
        $data['jefes']=$this->model->getDatos('jefes');
        $data['divisiones']=$this->model->getDatos('divisiones');
        $data['peticiones']=$this->model->getDatos('peticiones');
        $this->views->getView($this, "home", $data);
     }
     public function modificar()
     {
        $rfc = $_POST['rfc'];
        $nombredocumento = $_POST['nombredocumento'];
        $direccion = $_POST['direccion'];
        $codigopostal = $_POST['codigopostal'];
        $lada = $_POST['lada'];
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $correo = $_POST['correo'];
        $pagina = $_POST['pagina'];
        $id = $_POST['id'];
        $data = $this->model->modificar( $rfc, $nombredocumento, $direccion, $codigopostal, $lada, $numero1,  $numero2,  $correo, $pagina, $id);
        if ($data == 'ok') {
            $msg = 'ok';
        }else {
            $msg = 'error';
        }
        echo json_encode($msg);
        die();
     }


 }
