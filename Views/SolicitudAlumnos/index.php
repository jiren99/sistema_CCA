<?php include "Views/Template/header.php"?>

<div class="card">
    <div class="card">
        <div class="card-header">
        <h5 style="color:rgb(203, 1, 1);">CONTROL DE SOLICITUDES DE ALUMNOS DEL INSTITUTO TECNOLÓGICO SUPERIOR DE MACUSPANA</h5>
        </div>
        <div class="card-body">
            <form id="frmPetcionAdmin">
                <table  class="table table-bordered table-hover table-sm" id="tblAdminSolicitud">
                <thead class="thead-light">
                    <tr>
                    <th>Fecha</th>
                    <th>Solicitud</th>
                    <th>Alumno que solicito</th>
                    <th>Matrícula</th>
                    <th>Carrera</th>
                    <th>Aprobación</th>
                    <th></th>
                    </tr>
                </thead>
                    <tbody>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "Views/Template/footer.php"?>