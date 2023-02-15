<?php include "Views/Template/header.php"?>
<div class="row">
  <div class="col-xl-3 col-md-6">
      <div class="card" style="background-color:rgb(5, 81, 238);">
          <div class="card-body d-flex text-white">
              <h5 class="card-title">Usuarios</h5>
              <i class="fas fa-user fa-2x ml-auto"></i>
          </div>
          <div class="card-footer d-flex aling-items-center justify-content-between" >
              <a href="<?php echo base_url;?>Usuarios" class="text-white">Ver detalles</a>
              <span class="text-white"><?php echo $data['usuarios']['total']?></span>
          </div>
      </div>
  </div>
  <!-- fin columna una -->
  <div class="col-xl-3 col-md-6">
      <div class="card" style="background-color:rgb(5, 81, 238);">
          <div class="card-body d-flex text-white">
              <h5 class="card-title">J. de división</h5>
              <i class="fas fa-users fa-2x ml-auto"></i>
          </div>
          <div class="card-footer d-flex aling-items-center justify-content-between">
              <a href="<?php echo base_url;?>Jefes" class="text-white">Ver detalles</a>
              <span class="text-white"><?php echo $data['jefes']['total']?></span>
          </div>
      </div>
  </div>
  <!-- fin columna 2 -->
  <div class="col-xl-3 col-md-6">
      <div class="card" style="background-color:rgb(5, 81, 238);">
          <div class="card-body d-flex text-white">
              <h5 class="card-title">Divisiones</h5>
              <i class="fas fa-door-closed fa-2x ml-auto"></i>
          </div>
          <div class="card-footer d-flex aling-items-center justify-content-between">
              <a href="<?php echo base_url;?>Divisiones" class="text-white">Ver detalles</a>
              <span class="text-white"><?php echo $data['divisiones']['total']?></span>
          </div>
      </div>
  </div>
  <!-- fin columna 3 -->
  <div class="col-xl-3 col-md-6">
      <div class="card" style="background-color:rgb(5, 81, 238);">
          <div class="card-body d-flex text-white">
              <h5 class="card-title">Solicitudes</h5>
              <i class="fas fa-envelope-open-text fa-2x ml-auto"></i>
          </div>
          <div class="card-footer d-flex aling-items-center justify-content-between">
              <a href="<?php echo base_url;?>Peticiones/index" class="text-white">Ver detalles</a>
              <span class="text-white"><?php echo $data['peticiones']['total']?></span>
          </div>
      </div>
  </div>

<!-- ------------------------------------------------------------------------------------------------ -->
<form id="principal">
        
        <div class="form-group mt-3" style="text-align: center;">
            <h4 class="text-success" id="lacarrera"><strong>SISTEMA DE CONTROL PARA LOS COMITÉS ACADÉMICOS DEL ITSM</strong></h4>
        </div>
    <div class="row">
        <div class="col-md-5">
        <div class="form-group" style="border-left: 5px solid #009DE1; text-align: justify;">
        <h4 id="etlamision" class="text-success"><strong>Misión</strong></h4>
        <h6 style="text-align: justify;" id="lamision"> Formar Profesionales de alto nivel académico, generadores de conocimientos científicos y tecnológicos, con un sentido de pertinencia y superación continua, propiciando así oportunidades de desarrollo local, regional y del país, fomentando valores éticos, culturales y de amor a la naturaleza, proporcionando confiabilidad y certeza en la calidad de nuestros egresados.</h6>
        </div>
        </div>

        <div class="col-md-5">
        <div class="form-group" style="border-left: 5px solid #089E2A;">
        <h4 id="etlamision" class="text-danger"><strong>Visión</strong></h4>
	        <h6 style="text-align: justify;" id="lamision">Ser una institución que garantice la calidad, excelencia y proyección globalizada en la formación de sus egresados, impulsores del desarrollo científico y tecnológico, promoviendo en los estudiantes el desarrollo de habilidades, destrezas, fomento de las artes y humanidades.</h6>
        </div>

        </div>

        <div class="col-md-4">
        <div class="form-group" style="border-left: 5px solid #B07D06;">
            <h4 id="etlamision" class="text-primary"><strong>Nuestros Valores</strong></h4>
            <h6><i class="fa fa-arrow-circle-right " style = "color: blue;"></i> El Ser Humano</h6>
            <h6><i class="fa fa-arrow-circle-right" style = "color: red;"></i> El Espíritu de Servicio</h6>
            <h6><i class="fa fa-arrow-circle-right" style = "color: green;"></i> El Liderazgo</h6>
            <h6><i class="fa fa-arrow-circle-right" style = "color: black;"></i> El Trabajo en Equipo</h6>
            <h6><i class="fa fa-arrow-circle-right" style = "color: blue;"></i> La Calidad</h6>
            <h6><i class="fa fa-arrow-circle-right" style = "color: red;"></i> El Alto Desempeño</h6>
        </div>
        </div>

        <div class="col-md-4 mt-2">
        <img alt="" src="../Assets/img/logo.png" width="90%" height="70%">
        </div>

        <div class="col-md-6 ">
        <ul class="sticky" >
			<li><a href="https://elibro.net/es/lc/macuspana/inicio" target="_blank">
			<div class="tooltipSigea3"><i class="fa fa-book bigger-300 mr-2 " style = "color: black;"></i><span class="tooltiptextSigea3" >Biblioteca Virtual elibro.net</span></div></a>
			</li>
			<li><a href="http://www.elibro.com/marketing/" target="_blank">
			<div class="tooltipSigea3"><i class="fa fa-question bigger-300 mr-2" style = "color: black;"></i><span class="tooltiptextSigea3">Manual de uso Biblioteca Virtual</span></div></a>
			</li>
        </ul>    
        </div>
    </div>




    








</form>









<?php include "Views/Template/footer.php"?>