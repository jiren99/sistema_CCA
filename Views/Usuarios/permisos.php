<?php include "Views/Template/header.php"?>
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card">
            <div class="card-header text-center bg-warning">
                <strong style="color:rgb(203, 1, 1);">Permisos y privacidad del sistemas</strong>
            </div>
            <div class="card-body">
                <form id="formulario" onsubmit="registrarPermisos(event)">
                <h6>Active los permisos necesarios al usuario aprobado para acceder a módulos y realice acciones administrativas</h6>      
                    <div class="row">          
                        <?php foreach ($data['datos'] as $row) { ?>
                            <div class="col-md-4 text-center text-capitalize p-2">
                            <label for=""><?php echo $row['permiso'];?></label><br>
                            <input type="checkbox" name="permisos[]" value = "<?php echo $row['id'];?>" <?php echo isset($data['asignados'] [$row['id']]) ? 'checked' : '';?>>
                            </div>
                        <?php } ?>
                        <input type = "hidden" value = "<?php echo $data['id_usuario'];?>" name="id_usuario">
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-outline-warning">Asignar permisos</button>
                    <a class="btn btn-outline-danger" href="<?php echo base_url;?>Usuarios">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <div class="card-header">
    Permisos y privacidad del sistemas
    </div>
    <div class="card-body">
        <input type="checkbox">
    </div> -->
</div>
<?php include "Views/Template/footer.php"?>
