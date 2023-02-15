<?php
class Peticiones extends Controller{
    public function __construct() {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['jefes'] = $this->model->getmostrardatosjefes();        
        $data['divisiones'] = $this->model->getDivision();
        $data['semestres'] = $this->model->getSemestre();
        $data['carreras'] = $this->model->getCarrera();
        $data['motivosACA'] = $this->model->getMotivoAcademico();
        $this->views->getView($this, "index", $data);
    }
    public function buscarJefe($matricula)
    {
        $data = $this->model->getJefeRFC($matricula);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresar()
    {
        $id = $_POST['id'];
        $datos = $this->model->getPeticiones($id);

        $fecha = $_POST['fecha'];
        $id_jefe = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $id_division = $datos['id_division'];
        $nombre_alumno = $_POST['nombre_alumno'];
        $id_semestre = $_POST['id_semestre'];
        $id_carrera = $_POST['id_carrera'];
        $numero_control = $_POST['numero_control'];
          $solicitud = $_POST['solicitud'];
        $id_motivo = $_POST['id_motivo'];
        $data = $this->model->registrarDetalles($fecha, $id_jefe, $id_usuario, $id_division, $nombre_alumno, $id_semestre, $id_carrera, $numero_control, $solicitud, $id_motivo);
        if ($data == "ok") {
            $msg = "ok";
        }else {
            $msg = "Error al ingresar la solicitud";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function listar()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle_temporal'] = $this->model->getDetalle($id_usuario);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function delete($id)
    {
        $data = $this->model->deleteDetalle($id);
        if ($data=='ok') {
            $msg = 'ok';
        }else {
            $msg = 'error';
        }
        echo json_encode($msg);
        die();
    }
    public function registrarPeticion()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $peticion = $this->model->getDetallesss($id_usuario);
        $data = $this->model->registrarPeticion($peticion['peticioness'], $id_usuario);
        if ($data == 'ok') {
            $detalles = $this->model->getDetalle($id_usuario);
            foreach ($detalles as $row ) {
                $id_peticion = $this->model->id_peticion();
                $fecha = $row['fecha'];
                $id_jefe = $row['id_jefe'];
                $id_usuario = $_SESSION['id_usuario'];
                $id_division = $row['id_division'];
                $nombre_alumno = $row['nombre_alumno'];
                $id_semestre = $row['id_semestre'];
                $id_carrera = $row['id_carrera'];
                $numero_control = $row['numero_control'];
                $solicitud = $row['solicitud'];
                $id_motivo = $row['id_motivo'];
                $this->model->registrarDetallesPeticiones($id_peticion['id'], $fecha, $id_jefe, $id_usuario, $id_division, $nombre_alumno, $id_semestre, $id_carrera, $numero_control, $solicitud, $id_motivo);
            }
            $vaciar = $this->model->vaciardetallesdetabla($id_usuario);
            if ($vaciar== 'ok') {
                $msg =array('msg' => 'ok', 'id_peticion' => $id_peticion['id']);
            }

        }else {
            $msg = 'Error al realizar la peticion';
        }
        echo json_encode($msg);
        die();   
    }
    public function generarpdf($id_peticion)
    {
        $instituto = $this->model->getInstituto();
        $peticioness = $this->model->getDatosPeticiones($id_peticion);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P','mm',  array(210,280));
        $pdf->AliasNbPages();        
        $pdf->AddPage();
        $pdf->SetTitle(utf8_decode('Solicitud de comités académicos'));
        $pdf->SetFont('Arial','B',16);
        $pdf->Image(base_url . 'Assets/img/03.jpg', 15, 5, 70);
        $pdf->Image(base_url . 'Assets/img/01.png', 120, 10, 60);
        $pdf->Image(base_url . 'Assets/img/04.png', 180, 8, 15);

        $pdf->SetFont('Arial','B',8);
        $pdf->Ln(15);
        $pdf->SetX(131);
        $pdf->Cell(70, 10, utf8_decode('Instituto Tecnológico Superior de Macuspana'), 0, 1,'C',0);

        //titulo del documentos
        
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0, 10, utf8_decode($instituto['nombredocumento']), 0, 1,'C',0);
        $pdf->Ln(10);
        
        //folio del documento
        
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(27);
        $pdf->Cell(35, 10, utf8_decode('Folio de solicitud:'), 0, 0,'C',0);
        $pdf->Cell(15, 10,$id_peticion, 0, 1,'C',0);



        foreach ($peticioness as $row) {
        //fecha del documento
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(26);
        $pdf->Cell(47, 10, utf8_decode('Macuspana, Tabasco a:'), 0, 0,'C',0);
        $pdf->Ln(0);
        $pdf->SetX(73);
        $pdf->Cell(25,10, $row['fecha'], 0, 1,'C',0);
        $pdf->Ln(5);

        //datos de los jefes
        $pdf->SetMargins(5,0,0);
        $pdf->SetFont('Arial','B',11);
        $pdf->SetX(27);
        $pdf->Cell(33, 7, utf8_decode('JEFE DE DIVISIÓN:  '), 0, 0,'C',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Write(7,utf8_decode($row['nombre']));
        $pdf->Write(7,utf8_decode(' '));
        $pdf->Cell(40,7, $row['apellido'], 0, 1,'',0);
        
        $pdf->SetX(24);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(19, 7, utf8_decode('DIVISIÓN:'), 0, 0,'',0);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(70 ,7, $row['division'], 0, 1,0);

        $pdf->Ln(5);
        $pdf->SetX(27);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(21, 10, utf8_decode('PRESENTE'), 0, 0,'C',0);


        $pdf->SetMargins(25,0,25);
        $pdf->Ln(11);
        $pdf->SetFont('Arial','',12);
        $pdf->Write(7,utf8_decode('Por medio de la presente informo a usted, que yo'));
        $pdf->SetFont('Arial','B',11);
        $pdf->SetX(119);
        $pdf->Write(7,utf8_decode($row['nombre_alumno']));
        // $pdf->SetX(48);
        $pdf->SetFont('Arial','',11);
        $pdf->Write(7,utf8_decode(' con número de control '));
        $pdf->SetFont('Arial','B',11);
        $pdf->Write(7,utf8_decode($row['numero_control']));
        $pdf->SetFont('Arial','',11);
        $pdf->Write(7,utf8_decode(' estudiante de la carrera de '));
        $pdf->SetFont('Arial','B',11);
        $pdf->Write(7,utf8_decode($row['carrera']));
        $pdf->SetFont('Arial','',12);
        $pdf->Write(7,utf8_decode(' en el instituto tecnlógico superior de macuspana, solicito de la manera mas atenta y amable '));
        $pdf->SetFont('Arial','B',11);
        $pdf->Write(7,utf8_decode($row['solicitud']));
        $pdf->SetFont('Arial','',12);
        $pdf->Write(7,utf8_decode(' debido a los siguientes motivos '));
        $pdf->SetFont('Arial','B',11);
        $pdf->Write(7,utf8_decode($row['motivo']));
        $pdf->SetFont('Arial','',12);
        $pdf->Write(7,utf8_decode('. Ya que por el momento considero que es lo mejor para no perjudicar mi estatus como alumno de la institucion, asi como tambien mi avance curricular. '));

        $pdf->Ln(8);
        $pdf->SetX(25);
        $pdf->Write(7,utf8_decode('Sin mas por el momento me despido de usted, enviandole un cordial saludo.'));

        $pdf->SetFont('Arial','B',12);
        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(12);
        $pdf->Cell(0, 7, utf8_decode('ATENTAMENTE'), 0, 1,'C',0);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(12);
        $pdf->Cell(0 ,7, $row['nombre_alumno'], 0, 1,'C',0);

        }
        
        //pie de pagina
        $pdf->Image(base_url . 'Assets/img/03.png', 12, 250, 35);
        $pdf->SetFont('Arial','',7);
        $pdf->Ln(49);
        $pdf->SetX(55);
        $pdf->Cell(76, 3, utf8_decode($instituto['direccion']), 0, 0,'C',0);
        $pdf->Cell(1, 3, utf8_decode(','), 0, 0,'C',0);
        $pdf->Cell(5, 3, utf8_decode('CP.'), 0, 0,'C',0);
        $pdf->Cell(8, 3, utf8_decode($instituto['codigopostal']), 0, 1,'C',0);
        $pdf->SetX(59);
        $pdf->Cell(5, 3, utf8_decode('Tels.'), 0, 0,'C',0);
        $pdf->Cell(8, 3, utf8_decode($instituto['lada']), 0, 0,'C',0);
        $pdf->SetX(72);
        $pdf->Cell(9, 3, utf8_decode($instituto['numero1']), 0, 0,'C',0);
        $pdf->Cell(3, 3, utf8_decode('y'), 0, 0,'C',0);
        $pdf->Cell(9, 3, utf8_decode($instituto['numero2']), 0, 0,'C',0);
        $pdf->Cell(9, 3, utf8_decode(', e-mail:'), 0, 0,'C',0);
        $pdf->SetX(100);
        $pdf->Cell(40, 3, utf8_decode($instituto['correo']), 0, 1,'C',0);
        $pdf->SetFont('Arial','B',7);
        $pdf->SetX(80);
        $pdf->Cell(40, 3, utf8_decode($instituto['pagina']), 0, 1,'C',0);

        

        $pdf->Output();

    }
    public function historial()
    {
        $this->views->getView($this, "historial");
    }
    public function listar_historial()
    {
        // <button class="btn btn-warning" onclick="btnAnularPeticion('.$data[$i]['id'].')"><i class = "fas fa-ban"></i></button>
        $data = $this->model->getHistorialSolicitudesAlumnos();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1 && $data[$i]['aprobacion'] == 0) {
                $data[$i]['estado'] = '<span class="badge badge-success">Enviado</span>';
                $data[$i]['aprobacion'] = '<span class="badge badge-primary">En espera..</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
            }else if ($data[$i]['estado'] == 1 && $data[$i]['aprobacion'] == 10) {
                $data[$i]['estado'] = '<span class="badge badge-success">Aprobado</span>';
                $data[$i]['aprobacion'] = '<span class="badge badge-success">Tu solicitud fue aprobado <i class=" far fa-thumbs-up"></span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <div/>';
            }
            else if ($data[$i]['estado'] == 1 && $data[$i]['aprobacion'] == 1) {
            $data[$i]['estado'] = '<span class="badge badge-warning">No aprobado</span>';
            $data[$i]['aprobacion'] = '<span class="badge badge-warning">Tu solicitud no fue probada <i class="far fa-thumbs-down"></i></span>';
            $data[$i]['acciones'] = '<div>
            <a class="btn btn-danger" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
            <div/>';
            }
            // else {
            //     $data[$i]['estado'] = '<span class="badge badge-danger">Cancelado</span>';
            //     $data[$i]['aprobacion'] = '<span class="badge badge-danger">Cancelaste la solicitud <i class=" fas fa-frown"></span>';
            //     $data[$i]['acciones'] = '<div>
            //     <a class="btn btn-danger" href = "'.base_url."Peticiones/generarpdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
            //     <div/>';
            // }

            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function anularPeticion($id_peticion)
    {
        $data = $this->model->getAnularPeticion($id_peticion);
        $anular = $this->model->getAnular($id_peticion);
        if ($anular == 'ok') {
            $msg = array('msg' => 'La solicitud se ha cancelado', 'icono'=>'success');
        }else {
            $msg = array('msg' => 'Error al cancelar la solicitud', 'icono'=>'error');
        }
        echo json_encode($msg);
        die();
        
    }

    
}