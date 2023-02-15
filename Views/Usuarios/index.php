<?php include "Views/Template/header.php"?>



<div class="card">
    <div class="card-header">
    <h4 style="color:rgb(203, 1, 1);">MÓDULO REGISTROS DE USUARIOS AL SISTEMA CCA</h4>
    </div>
    <div class="card-body">
    <h6>Administre el registro de usuarios con acceso al sistema</h6>
    <button class="btn btn-danger mb-3" type="button" onclick="frmUsuario();">Nuevo usuario <i class="fas fa-user-plus"></i></button>
    <div class="table-responsive">
<table class="table table-bordered table-hover table-sm" id="tblUsuarios" >
    <thead class="thead-light" >
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
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


<!-- modal para registrar usuarios -->
<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title text-danger" id="title" >Nuevo Usuario</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="hidden" id="id" name="id">
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Escriba un usuario">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Escriba su nombre(s)">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" class="form-control" type="text" name="apellido" placeholder="Escriba sus apellidos">
                    </div>
                    
                    <!-- contrasena -->
                    <div class="row" id="claves">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="clave">Contraseña</label>
                        <input id="clave" class="form-control" type="password" name="clave" placeholder="Escriba una contraseña">
                    </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="confirmar">Confirmar contraseña</label>
                        <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="confirmar su contraseña">
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telefono">teléfono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Escriba su telefono">
                    </div>

                    <button class="btn btn-warning" type="button" onclick="registrarUser(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Template/footer.php"?>
