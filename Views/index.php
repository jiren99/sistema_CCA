<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>INICIAR SESIÓN</title>
        <link href="<?php echo base_url;?>Assets/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url;?>Assets/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="./Assets/img/LOGO.png">
    </head>
    <body class="bg-dark" style="background: url('fondo.jpg') no-repeat; background-size:cover;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                    
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header text-center" style="background-color:rgb(255, 200, 0);"> 
                                    <img src="<?php echo base_url;?>Assets/img/logo.png" class="img-fluid rounded " alt="logo" width="180">
                                    <h4 id="" class="" style="color:rgb(173, 56, 56);"><strong>INICIO DE SESIÓN</strong></h4>
                                </strong> 

                                </div>
                                    
                                    <div class="card-body">
                                        <form id="frmLogin">
                                            <div class="form-group" id="frmUsuarios">
                                                <label class="small mb-1" for="usuario">Usuario</label>
                                                <input class="form-control py-4" id="usuario" name="usuario" type="text" placeholder="Ingrese su correo" />
                                            </div>
                                            <div class="form-group" >
                                                <label class="small mb-1" for="clave">Clave de acceso</label>
                                                <input class="form-control py-4" id="clave" name="clave" type="password" placeholder="Ingrese su contraseña" />
                                            </div>
                                            <div class="alert alert-danger text-center d-none" id="alerta" role="alert">
                                                
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit" onclick="frmLogin(event)" style="background-color:rgb(255, 200, 0);"> <h6 style="color:rgb(173, 56, 56);">Continuar</h6></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                    <a href="#" onclick="frmRegistrodeUsuariodesdeLogin();">Todavia no tienes una cuenta? registrate!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        <script src="<?php echo base_url;?>Assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url;?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url;?>Assets/js/scripts.js"></script>
        <Script>
            const base_url = "<?php echo base_url; ?>";
        </Script>
        <script src="<?php echo base_url;?>Assets/js/login.js"></script>
    </body>



    <div id="nuevo_usuario_login" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-danger" id="my-modal-title" >REGISTRATE PARA INICIAR SESIÓN</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Escriba su nombre(s)">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" class="form-control" type="text" name="apellido" placeholder="Escriba sus apellidos">
                    </div>

                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Escriba un usuario">
                    </div>
                    <div class="form-group">
                        <label for="clave">Contraseña</label>
                        <input id="clave" class="form-control" type="password" name="clave" placeholder="Escriba una contraseña">
                    </div>


                    <div class="form-group">
                        <label for="telefono">telefono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Escriba su telefono">
                    </div>

                    <button class="btn btn-warning" type="button" onclick="registrarUserLogin(event);">Registrar</button>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url;?>Assets/js/funciones.js"></script>
<script src="<?php echo base_url;?>Assets/js/sweetalert2.all.min.js"></script>
</html>
