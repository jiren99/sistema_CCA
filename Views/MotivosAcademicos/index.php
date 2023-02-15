<?php include "Views/Template/header.php"?>

<div class="card">
    <div class="card-header">
    <h4 style="color:rgb(203, 1, 1);">MÓDULO REGISTRO DE MOTIVOS ACADÉMICOS DEL INSTITUTO TECNOLÓGICO SUPERIOR DE MACUSPANA</h4>
    </div>
    <div class="card-body">
    <h6>Registro de motivos académicos de la institución</h6>
    <button class="btn btn-danger mb-3" type="button" onclick="frmMotivoACA();">Nuevo motivo académico <i class="fas fa-user-plus"></i></button>
<table class="table table-bordered table-hover table-sm" id="tblMotivoAcademico">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Motivos académicos</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
    </div>
</div>


<!-- modal para registrar divisiones -->
<div id="nuevo_motivoacademico" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-danger" id="title" >Nuevo motivo académico</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" id="frmMotivoACA">
                    
                    <div class="form-group">
                        <label for="motivo">Motivo académico</label>
                        <input type="hidden" id="id" name="id">
                        <input id="motivo" class="form-control" type="text" name="motivo" placeholder="Escriba el nuevo motivo academico">
                    </div>
                    
                    <button class="btn btn-warning" type="button" onclick="registrarMotivoAcademico(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Template/footer.php"?>