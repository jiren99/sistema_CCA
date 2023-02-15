<?php include "Views/Template/header.php"?>
<div class="card">
    <div class="card-header">
    <h4 style="color:rgb(203, 1, 1);">DATOS GENERALES DEl INSTITUTO TECNOLÓGICO SUPERIOR DE MACUSPANA</h4>
    
    </div>
    <div class="card-body">
        <form id="frmEmpresa">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <input id="id" class="form-control" type="hidden" name="id" value = "<?php echo $data['id']?>">
                <label for="rfc">RFC</label>
                <input id="rfc" class="form-control" type="text" name="rfc" value = "<?php echo $data['rfc']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="nombredocumento">Nombre del documento</label>
                <input id="nombredocumento" class="form-control" type="text" name="nombredocumento" value = "<?php echo $data['nombredocumento']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="codigopostal">Código postal</label>
                <input id="codigopostal" class="form-control" type="text" name="codigopostal" value = "<?php echo $data['codigopostal']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="lada">Lada del teléfono</label>
                <input id="lada" class="form-control" type="text" name="lada" value = "<?php echo $data['lada']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="numero1">Com. número 1</label>
                <input id="numero1" class="form-control" type="text" name="numero1" value = "<?php echo $data['numero1']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="numero2">Com. número 2</label>
                <input id="numero2" class="form-control" type="text" name="numero2" value = "<?php echo $data['numero2']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="correo">E-mail</label>
                <input id="correo" class="form-control" type="text" name="correo" value = "<?php echo $data['correo']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-6">
                <div class="form-group">
                <label for="pagina">Página oficial</label>
                <input id="pagina" class="form-control" type="text" name="pagina" value = "<?php echo $data['pagina']?>">
            </div>
                </div>
                <!-- fin de una columna -->
                <div class="col-md-7">
                <div class="form-group">
                <label for="direccion">Dirección</label>
                <input id="direccion" class="form-control" type="text" name="direccion" value = "<?php echo $data['direccion']?>">
            </div>
                </div>



            
            </div>




            
            
            
            
            
            <button class="btn btn-danger" type="button" onclick="modificarEmpresa()">Actualizar datos</button>

        </form>
    </div>
</div>
<?php include "Views/Template/footer.php"?>