<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PANEL ADMINISTRATIVO</title>
        <link href="<?php echo base_url;?>Assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url;?>Assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="<?php echo base_url;?>Assets/css/select2.min.css" rel="stylesheet" crossorigin="anonymous" />
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url;?>Assets/dn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/> -->
        <link href="<?php echo base_url;?>Assets/css/estilo.css" rel="stylesheet"/>
        <script src="<?php echo base_url;?>Assets/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="../Assets/img/LOGO.png">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand" style="background-color:rgb(255, 200, 0);">
            <a class="navbar-brand"  href="<?php echo base_url;?>Administracion/home"><h3 style="color:rgb(203, 1, 1);">SISTEMAS CCA</h3> </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav ml-auto">
                <strong><h4 style="color:rgb(203, 1, 1);" class=" mt-2"><?php echo date("d/m/Y") ?></h4></strong>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                        <a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion" id="sidenavAccordion" style="background-color:rgb(36, 36, 36);">
                    <div class="sb-sidenav-menu" >
                        <div class="nav" >
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                                 Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fas fa-user mr-2"></i>Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Semestres"><i class="fas fa-book mr-2"></i>Semestres</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>SolicitudAlumnos"><i class="fas fa-book mr-2"></i>Solicitudes de estudiantes</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>MotivosAcademicos"><i class="fas fa-book mr-2"></i>Motivos Academicos</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Administracion"><i class="fas fa-hotel mr-2"></i>Institución</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="<?php echo base_url; ?>Jefes">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                 Jefes de división
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Divisiones" >
                                <div class="sb-nav-link-icon"><i class="fas fa-door-closed"></i></div>
                                 Divisiones
                            </a>
                            <a class="nav-link" href="<?php echo base_url; ?>Carreras">
                                <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                                 Carreras
                            </a>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSolicitudes" aria-expanded="false" aria-controls="collapseSolicitudes">
                                <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text"></i></div>
                                 Solicitudes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSolicitudes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Peticiones"><i class="fas fa-envelope-open-text"></i>Nueva solicitud</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Peticiones/historial"><i class="fas fa-list mr-2"></i>Historial solicitudes</a>
                                </nav>
                            </div>

                            
                             
                            
                        </div>
						
                    </div>
					
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-2">
                        
                   
