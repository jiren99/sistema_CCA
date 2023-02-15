<?php include "Views/Template/header.php"?>

<div class="card">
    <div class="card-header">
        <h4 style="color:rgb(203, 1, 1);">SOLICITUDES A COMITÉS ACADÉMICOS DEL INSTITUTO TECNOLÓGICO SUPERIOR DE MACUSPANA</h4>
    </div>
    <div class="card-body">
        <form id = "frmPeticiones">

        <h6>Escriba todos los datos en mayusculas*</h6>
            <div class="row">
            <label for="buscarjefe"><i class="fas fa-search"></i> Busca al jefe de división (Observa su matrícula y escribelo en donde se te pida para continuar con la solicitud)*</label>
            <div class="col-md-5">
                    <div class="form-group">
                        <select name="buscarjefe" class="form-control" id="buscarjefe">
                            <?php foreach ($data['jefes'] as $row) { ?>
                            <option value = "<?php echo $row['id'];?>"><?php echo $row['matricula']." - ".$row['nombre']." ".$row['apellido'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                
            <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha">Macuspana, Tabasco a: </label>
                        <input id="fecha" class="form-control" type="date" name="fecha">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="matricula">Matrícula del jefe de división</label>
                        <input type="hidden" id="id" name="id">
                        <input id="matricula" class="form-control" type="text" name="matricula" placeholder="Escriba la matricula y presione enter" onkeyup="buscarJefe(event)">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_jefe">Jefe de la división</label>
                        <input id="id_jefe" class="form-control" type="text" name="id_jefe" placeholder="Informacion del jefe.." disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_division">División académica</label>
                        <input id="id_division" class="form-control" type="text" name="id_division" placeholder="Informacion de su division.." disabled>
                    </div>
                </div>

            </div>

            <br>
            <h6>Seleccione y escriba los datos solocitados para la solicitud</h6>
            <hr>

            <div class="row">
  
                                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nombre_alumno">Nombre del alumno</label>
                        <input id="nombre_alumno" class="form-control" type="text" name="nombre_alumno" placeholder="Escriba el nombre completo del alumno">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="id_semestre">Seleccione el semestre</label>
                        <select id="id_semestre" class="form-control" name="id_semestre">
                            <?php foreach ($data['semestres'] as $row) { ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['semestres'];?></option>
                                <?php }?>
                        </select>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="id_carrera">Seleccione la carrera</label>
                        <select id="id_carrera" class="form-control" name="id_carrera">
                            <?php foreach ( $data['carreras'] as $row) { ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['carrera'];?></option>
                                <?php }?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero_control">Número de control</label>
                        <input id="numero_control" class="form-control" type="text" name="numero_control" placeholder="Escriba el numero de control del alumno">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="solicitud">Escriba su solicitud</label>
                        <input id="solicitud" class="form-control" type="text" name="solicitud" placeholder="Exprese su solicitud">
                    </div>
                </div>


            </div>

            
            <br>

            <h6>Por los siguientes motivos (Elige uno de los siguientes motivos)</h6>
            <hr>

        <div class="row">
                
            <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_motivo">Seleccione el motivo de esta solicitud</label>
                        <select id="id_motivo" class="form-control" name="id_motivo">
                            <?php foreach ( $data['motivosACA'] as $row) { ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['motivo'];?></option>
                                <?php }?>
                        </select>
                    </div>
            </div>



            
            </div>


            <button class="btn btn-danger" type="button" onclick="ingresarDatos()" id="btnAccion">Ingresar petición</button>

            <hr>

            <table class="table table-bordered table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>FECHA</th>
                        <th>JEFE</th>
                        <th>DIVISIÓN</th>
                        <th>ALUMNO</th>
                        <th>SEMESTRE</th>
                        <th>CARRERA</th>
                        <th>NUM. CONTROL</th>
                        <th>SOLICITUD</th>
                        <th>MOTIVO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tblDetalle">
                </tbody>
            </table>
            <button class="btn btn-warning" type="button" onclick="generarPeticion()" id="btnAccion">Guardar solicitud</button>

        </form>
    </div>
</div>



<?php include "Views/Template/footer.php"?>