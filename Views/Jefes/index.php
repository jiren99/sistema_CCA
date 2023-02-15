<?php include "Views/Template/header.php"?>

<div class="card">
    <div class="card-header">
    <h4 style="color:rgb(203, 1, 1);">MÓDULO JEFES DE DIVISIONES</h4>
    </div>
    <div class="card-body">
    <button class="btn btn-danger mb-3" type="button" onclick="frmJefes();">Nuevo jefe de división <i class="fas fa-user-plus"></i></button>
<div class="table-responsive">
<table class="table table-bordered table-hover table-sm" id="tblJefes">
    <thead class="thead-light">
        <tr>
            <th>Matrícula</th>
            <th>RFC</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>División</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
</div>
    </div>
</div>

<!-- modal para registrar jefes -->
<div id="nuevo_jefe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-danger" id="title" >Nuevo jefe de división</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" id="frmJefes">
                    
                    <div class="form-group">
                        <label for="matricula">Matrícula</label>
                        <input id="matricula" class="form-control" type="text" name="matricula" placeholder="Escriba su matricula">
                    </div>

                    <div class="form-group">
                        <label for="rfc">RFC</label>
                        <input type="hidden" id="id" name="id">
                        <input id="rfc" class="form-control" type="text" name="rfc" placeholder="Escriba su rfc">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Escriba su nombre(s)">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" class="form-control" type="text" name="apellido" placeholder="Escriba sus apellidos">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono">teléfono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Escriba su telefono">
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input id="correo" class="form-control" type="text" name="correo" placeholder="Escriba su correo">
                    </div>

                    <div class="form-floating mb-3">
                        <label for="division">Seleccione su división</label>
                        <select id="division" class="form-control" name="division">
                            <?php foreach ($data['divisiones'] as $row) { ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['division'];?></option>
                                <?php }?>
                        </select>
                    </div>

                    <button class="btn btn-warning" type="button" onclick="registrarJefe(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Template/footer.php"?>