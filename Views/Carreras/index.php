<?php include "Views/Template/header.php"?>

<div class="card">
    <div class="card-header">
    <h4 style="color:rgb(203, 1, 1);">CARRERAS DEL INSTITUTO TECNOLÓGICO SUPERIOR DE MACUSPANA</h4>

    </div>
    <div class="card-body">
    <h6>Registro de las carreras de la institución</h6>
    <button class="btn btn-danger mb-3" type="button" onclick="frmCarreras();">Nueva carrera <i class="fas fa-user-plus"></i></button>
<table class="table table-bordered table-hover table-sm" id="tblCarrera">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Materia</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
    </div>
</div>

<!-- modal para registrar carreras -->
<div id="nueva_carrera" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-danger" id="title" >Nueva carrera</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" id="frmCarreras">
                    
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Escriba el código de la carrera">
                    </div>
                    <div class="form-group">
                        <label for="carrera">Carrera</label>
                        <input id="carrera" class="form-control" type="text" name="carrera" placeholder="Escriba el nombre de la carrera">
                    </div>
                    
                    <button class="btn btn-warning" type="button" onclick="registrarCarreras(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Template/footer.php"?>