let tblUsuarios, tblJefes, tblDivision, tblCarrera, tblMotivoAcademico,t_historialSolicitud,tblAdminSolicitud;

document.addEventListener("DOMContentLoaded",function(){
    $('#buscarjefe').select2();
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'usuario'},
            {'data' : 'nombre'},
            {'data' : 'apellido'},
            {'data' : 'telefono'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        
        ]
    } );
    // fin de la tabla para los usuarios que tienen acceso al sistema
    tblJefes = $('#tblJefes').DataTable( {
        ajax: {
            url: base_url + "Jefes/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'matricula'},
            {'data' : 'rfc'},
            {'data' : 'nombre'},
            {'data' : 'apellido'},
            {'data' : 'telefono'},
            {'data' : 'correo'},
            {'data' : 'division'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        
        ]
    } );
    // fin de la tabla para los jefes
    tblDivision = $('#tblDivision').DataTable( {
        ajax: {
            url: base_url + "Divisiones/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'id'},
            {'data' : 'division'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        
        ]
    } );
    // fin de la tabla para las divisiones
    tblCarrera = $('#tblCarrera').DataTable( {
        ajax: {
            url: base_url + "Carreras/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'id'},
            {'data' : 'codigo'},
            {'data' : 'carrera'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        }
    } );
    // fin de la tabla de carreras
    tblSemestres = $('#tblSemestres').DataTable( {
        ajax: {
            url: base_url + "Semestres/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'id'},
            {'data' : 'semestres'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        
        ]
    } );
    //fin de la tabbla de semestres 
    tblMotivoAcademico = $('#tblMotivoAcademico').DataTable( {
        ajax: {
            url: base_url + "MotivosAcademicos/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'id'},
            {'data' : 'motivo'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        
        ]
    } );
    //fin de la tabbla de motivos academicos 
    t_historialSolicitud = $('#t_historialSolicitud').DataTable( {
        ajax: {
            url: base_url + "Peticiones/listar_historial",
            dataSrc: ''
        },
        columns: [
            {'data' : 'numero_control'},            
            {'data' : 'peticion'},
            {'data' : 'fecha'},
            {'data' : 'estado'},
            {'data' : 'aprobacion'},
            {'data' : 'acciones'}
        ]
    } );
    //fin de la tabbla historial

    tblAdminSolicitud = $('#tblAdminSolicitud').DataTable( {
        ajax: {
            url: base_url + "SolicitudAlumnos/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'fecha'},
            {'data' : 'peticion'},
            {'data' : 'nombre_alumno'},
            {'data' : 'numero_control'},
            {'data' : 'carrera'},
            {'data' : 'aprobacion'},
            {'data' : 'acciones'}
        ]
    } );



})


function frmUsuario() {
    document.getElementById("title").innerHTML ="Nuevo usuario";
    document.getElementById("btnAccion").innerHTML ="Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const telefono = document.getElementById("telefono");
    if (usuario.value == "" || nombre.value == "" ||apellido.value == ""  ||telefono.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
          })
    }else{
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                 if (res =="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario registrado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      frm.reset();
                      $("#nuevo_usuario").modal("hide");
                      tblUsuarios.ajax.reload();
                 }else if (res == "modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario modificado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $("#nuevo_usuario").modal("hide");
                      tblUsuarios.ajax.reload();
                 } else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                 }
            }
        }
    }
}
function btnEditarUser(id) {
    document.getElementById("title").innerHTML ="Actualizar usuario";
    document.getElementById("btnAccion").innerHTML ="Modificar";
    const url = base_url + "Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status ==200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
             document.getElementById("usuario").value = res.usuario;
             document.getElementById("nombre").value = res.nombre;
             document.getElementById("apellido").value = res.apellido;
             document.getElementById("telefono").value = res.telefono;
             document.getElementById("claves").classList.add("d-none");
             $("#nuevo_usuario").modal("show");
        }
    }
}
function btnEliminarUser(id) {
    Swal.fire({
        title: 'Estas seguro de eliminar?',
        text: "El usuario no se eliminará de forma permanente, solamente cambiará de estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Eliminado!',
                            'El usuario ha sido eliminado, cambio de estado a inactivo.',
                            'success'
                          )
                          tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function btnReingresarUser(id) {
    Swal.fire({
        title: 'Estas seguro de reingresar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'El usuario ha sido reingresado con éxito',
                            'success'
                          )
                          tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
//FIN PARA EL REGISTRO DE USUARIOS------------------------------------------------------------------------

// registro de usuarios desde login

function frmRegistrodeUsuariodesdeLogin() {
    $("#nuevo_usuario_login").modal("show");
}
function registrarUserLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const clave = document.getElementById("clave");
    const telefono = document.getElementById("telefono");
    if (usuario.value =="" || nombre.value ==""|| apellido==""|| clave.value=="", telefono.value=="") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
          })   
    } else{
        const url = base_url + "Usuarios/registrarLoginn";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                 if (res =="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario registrado con éxito, ya puedes iniciar sesión',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      frm.reset();
                      $("#nuevo_usuario_login").modal("hide");
                 }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'El usuario ya existe, pruebe con otro usuario nuevo',
                        showConfirmButton: false,
                        timer: 1500
                      })
                 }
            }
    }
    }

}
//FIN PARA EL REGISTRO DE USUARIOS DESDE EL LOGIN---------------------------------------------------------

function frmJefes() {
    document.getElementById("title").innerHTML ="Nuevo jefe de división";
    document.getElementById("btnAccion").innerHTML ="Registrar";
    document.getElementById("frmJefes").reset();
    $("#nuevo_jefe").modal("show");
    document.getElementById("id").value = "";
}
function registrarJefe(e) {
    e.preventDefault();
    const matricula = document.getElementById("matricula");
    const rfc = document.getElementById("rfc");
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const telefono = document.getElementById("telefono");
    const correo = document.getElementById("correo");
    const division = document.getElementById("division");
    if (matricula.value == "" || rfc.value == "" ||nombre.value == "" ||apellido.value == ""  ||telefono.value == "" ||correo.value == ""||division.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
          })
    }else{
        const url = base_url + "Jefes/registrar";
        const frm = document.getElementById("frmJefes");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                 if (res =="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Jefe de división registrado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      frm.reset();
                      $("#nuevo_jefe").modal("hide");
                       tblJefes.ajax.reload();
                 }else if (res == "modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Los datos del jefe de división fueron modificados con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $("#nuevo_jefe").modal("hide");
                       tblJefes.ajax.reload();
                 } else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                 }
            }
        }
    }
}
function btnEditarJefe(id) {

    document.getElementById("title").innerHTML = "ACTUALIZAR DATOS DEL JEFE DE DIVISIÓN"
    document.getElementById("btnAccion").innerHTML ="Modificar";
    const url = base_url + "Jefes/editar/" + id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("matricula").value = res.matricula;
                document.getElementById("rfc").value = res.rfc;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("apellido").value = res.apellido;
                document.getElementById("telefono").value = res.telefono;
                document.getElementById("correo").value = res.correo;
                document.getElementById("division").value = res.id_division;
                $("#nuevo_jefe").modal("show"); 

            }
        }

}
function btnEliminarJefe(id) {
    Swal.fire({
        title: 'Estas seguro de darle de baja a este jefe de división?',
        text: "El jefe dedivisión sera dado de baja!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Jefes/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Eliminado!',
                            'El jefe de división  ha sido dado de baja.',
                            'success'
                          )
                          tblJefes.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function btnReingresarJefe(id) {
    Swal.fire({
        title: 'Estas seguro de volver a poner vigente a este jefe de división?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Jefes/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'El jefe de divisón esta vigente nuevamente',
                            'success'
                          )
                          tblJefes.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
//FIN PARA EL REGISTRO DE JEFES DE DIVISION ---------------------------------------------------------

function frmCarreras() {
    document.getElementById("title").innerHTML ="NUEVA CARRERA";
    document.getElementById("btnAccion").innerHTML ="Registrar";
    document.getElementById("frmCarreras").reset();
    $("#nueva_carrera").modal("show");
    document.getElementById("id").value = "";
}
function registrarCarreras(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const carrera = document.getElementById("carrera");

    if (codigo.value == "" || carrera.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios, por favor agregue los datos que se le solicita',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Carreras/registrar";
        const frm = document.getElementById("frmCarreras");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                 if (res =="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'La carrera se ha registrado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      frm.reset();
                      $("#nueva_carrera").modal("hide");
                      tblCarrera.ajax.reload();
                 }else if (res == "modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Los datos de la carrera fueron modificados con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $("#nueva_carrera").modal("hide");
                      tblCarrera.ajax.reload();
                 } else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                 }
            }
        }
    }
}
function btnEditarCarreras(id) {

    document.getElementById("title").innerHTML = "ACTUALIZAR DATOS DE LA CARRERA"
    document.getElementById("btnAccion").innerHTML ="Modificar";
    const url = base_url + "Carreras/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status ==200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("carrera").value = res.carrera;
            $("#nueva_carrera").modal("show"); 
        }
    }
        

}
function btnEliminarCarreras(id) {
    Swal.fire({
        title: 'Estas seguro de darle de baja a esta carrera?',
        text: "La carrera sera dado de baja!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Carreras/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Eliminado!',
                            'La carrera  ha sido dada de baja.',
                            'success'
                          )
                          tblCarrera.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function btnReingresarCarreras(id) {
    Swal.fire({
        title: 'Estas seguro de volver a poner vigente esta carrera?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Carreras/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'La carrera esta vigente nuevamente',
                            'success'
                          )
                          tblCarrera.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
//FIN PARA EL REGISTRO DE CARRERAS ----------------------------------------------------------------

function frmSemestres() {
    document.getElementById("title").innerHTML ="Nuevo semestre";
    document.getElementById("btnAccion").innerHTML ="Registrar";
    document.getElementById("frmSemestres").reset();
    $("#nuevo_semestre").modal("show");
    document.getElementById("id").value = "";
}
function registrarSemestres(e) {
    e.preventDefault();
    const semestre = document.getElementById("semestre");
    if (semestre.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios, por favor coloque el semestre',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Semestres/registrar";
        const frm = document.getElementById("frmSemestres");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                 if (res =="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El semestre se registro con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      frm.reset();
                      $("#nuevo_semestre").modal("hide");
                      tblSemestres.ajax.reload();
                 }else if (res == "modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'el semestre se ha modificado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $("#nuevo_semestre").modal("hide");
                      tblSemestres.ajax.reload();
                 } else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                 }
            }
        }
    }
}
function btnEditarSemestres(id) {

    document.getElementById("title").innerHTML = "ACTUALIZAR EL SEMESTRE"
    document.getElementById("btnAccion").innerHTML ="Modificar";
    const url = base_url + "Semestres/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status ==200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("semestre").value = res.semestres;
            $("#nuevo_semestre").modal("show"); 
        }
    }
        

}
function btnEliminarSemestres(id) {
    Swal.fire({
        title: 'Estas seguro de darle de baja a este semestre?',
        text: "La semestre sera dado de baja!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Semestres/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Eliminado!',
                            'El semestre  ha sido dado de baja.',
                            'success'
                          )
                          tblSemestres.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function btnReingresarSemestres(id) {
    Swal.fire({
        title: 'Estas seguro de volver a poner vigente este semestre?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Semestres/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'El semestre esta vigente nuevamente',
                            'success'
                          )
                          tblSemestres.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
//FIN PARA EL REGISTRO DE SEMESTRES ----------------------------------------------------------------

function frmDivisiones() {
    document.getElementById("title").innerHTML ="Nueva división";
    document.getElementById("btnAccion").innerHTML ="Registrar";
    document.getElementById("frmDivisiones").reset();
    $("#nuevo_division").modal("show");
    document.getElementById("id").value = "";
}
function registrarDivisiones(e) {
    e.preventDefault();
    const division = document.getElementById("division");
    if (division.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios, por favor coloque el semestre',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "Divisiones/registrar";
        const frm = document.getElementById("frmDivisiones");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                 if (res =="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'La división se registro con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      frm.reset();
                      $("#nuevo_division").modal("hide");
                      tblDivision.ajax.reload();
                 }else if (res == "modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'La división se ha modificado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $("#nuevo_division").modal("hide");
                      tblDivision.ajax.reload();
                 } else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                 }
            }
        }
    }
}
function btnEditarDivisiones(id) {

    document.getElementById("title").innerHTML = "ACTUALIZAR LA DIVISIÓN"
    document.getElementById("btnAccion").innerHTML ="Modificar";
    const url = base_url + "Divisiones/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status ==200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("division").value = res.division;
            $("#nuevo_division").modal("show"); 
        }
    }
        

}
function btnEliminarDivisiones(id) {
    Swal.fire({
        title: 'Estas seguro de darle de baja a la división?',
        text: "La división sera dada de baja!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Divisiones/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Eliminado!',
                            'La división ha sido dado de baja.',
                            'success'
                          )
                          tblDivision.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function btnReingresarDivisiones(id) {
    Swal.fire({
        title: 'Estas seguro de volver a poner vigente la división?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Divisiones/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'La división esta vigente nuevamente',
                            'success'
                          )
                          tblDivision.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
//FIN PARA EL REGISTRO DE DIVISIONES ----------------------------------------------------------------

function frmMotivoACA() {
    document.getElementById("title").innerHTML ="Nuevo motivo académico";
    document.getElementById("btnAccion").innerHTML ="Registrar";
    document.getElementById("frmMotivoACA").reset();
    $("#nuevo_motivoacademico").modal("show");
    document.getElementById("id").value = "";
}
function registrarMotivoAcademico(e) {
    e.preventDefault();
    const motivo = document.getElementById("motivo");
    if (motivo.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'El campo es obligatorio, por favor coloque el motivo',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url + "MotivosAcademicos/registrar";
        const frm = document.getElementById("frmMotivoACA");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                 if (res =="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El motivo academico se ha registrado con exito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      frm.reset();
                      $("#nuevo_motivoacademico").modal("hide");
                      tblMotivoAcademico.ajax.reload();
                 }else if (res == "modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El motivo academico se ha modificado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $("#nuevo_motivoacademico").modal("hide");
                      tblMotivoAcademico.ajax.reload();
                 } else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                 }
            }
        }
    }
}
function btnEditarMotivoAcademico(id) {

    document.getElementById("title").innerHTML = "ACTUALIZAR El motivo académico";
    document.getElementById("btnAccion").innerHTML ="Modificar";
    const url = base_url + "MotivosAcademicos/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status ==200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("motivo").value = res.motivo;
            $("#nuevo_motivoacademico").modal("show"); 
        }
    }
        

}
function btnEliminarMotivoAcademico(id) {
    Swal.fire({
        title: 'Estas seguro de darle de baja a este motivo académico?',
        text: "El motivo académico sera dado de baja!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "MotivosAcademicos/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Eliminado!',
                            'El motivo académico ha sido dado de baja.',
                            'success'
                          )
                          tblMotivoAcademico.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function btnReingresarMotivoAcademico(id) {
    Swal.fire({
        title: 'Estas seguro de volver a poner vigente este motivo académico?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "MotivosAcademicos/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'El motivo académico esta vigente nuevamente',
                            'success'
                          )
                          tblMotivoAcademico.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
//FIN PARA EL REGISTRO DE motivos academicos ----------------------------------------------------------------


function buscarJefe(e) {
    e.preventDefault();
    if (e.which == 13) {
        const matricula = document.getElementById("matricula").value;
        const url = base_url + "Peticiones/buscarJefe/" + matricula;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    document.getElementById("id_jefe").value = res.nombre +" "+ res.apellido;
                    document.getElementById("id_division").value = res.division;
                    document.getElementById("id").value = res.id; 
                    document.getElementById("nombre_alumno").focus();  
                } else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Lo siento pero no existe un jefe con esa matricula, vuelva a intentarlo',
                        showConfirmButton: false,
                        timer: 3000
                      })
                      document.getElementById("matricula").value='';
                      document.getElementById("matricula").focus();

                }

            }

        } 
    } 
}
function ingresarDatos() {
    const nombre_alumno = document.getElementById("nombre_alumno");
    const numero_control = document.getElementById("numero_control");
    const solicitud = document.getElementById("solicitud");
    const matricula = document.getElementById("matricula");
    if (nombre_alumno.value == "" || numero_control.value == "" ||solicitud.value == "" ||matricula.value == "" ) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
          })
    }else{
        const url = base_url + "Peticiones/ingresar";
        const frm = document.getElementById("frmPeticiones");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==200) {
                const res = JSON.parse(this.responseText);
                if (res=='ok') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Petición ingresada para su revisión',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    frm.reset();
                    cargarDetalle();
                }
            }
    
        }
    }

 
}
if (document.getElementById('tblDetalle')) {
    cargarDetalle();
}
function cargarDetalle() { 
    const url = base_url + "Peticiones/listar";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status ==200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle_temporal.forEach(row => {
                html += `<tr>
                <td>${row['fecha']}</td>
                <td>${row['nombre']+row['apellido']}</td>
                <td>${row['division']}</td>
                <td>${row['nombre_alumno']}</td>
                <td>${row['semestres']}</td>
                <td>${row['carrera']}</td>
                <td>${row['numero_control']}</td>
                <td>${row['solicitud']}</td>
                <td>${row['motivo']}</td>
                <td>
                <button class = "btn btn-danger" type = "button" onclick="deleteDetalle(${row['iddetalle']})">
                <i class ="fas fa-trash-alt"></i></button>
                </td>
                </tr>`;
            });
            document.getElementById("tblDetalle").innerHTML = html;
        }

    }
}
function deleteDetalle(id) {
    const url = base_url + "Peticiones/delete/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function (){
    if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == 'ok') {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Peticion liminada',
                showConfirmButton: false,
                timer: 2000
              })
              cargarDetalle();
        }else{
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Error al intentar eliminar la peticion',
                showConfirmButton: false,
                timer: 2000
              })
        }
    }
    }
}
function generarPeticion() {
    Swal.fire({
        title: 'Estas seguro de realizar la petición?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(36, 36, 36)',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Peticiones/registrarPeticion";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res.msg == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'La petición se ha generado con éxito',
                            'success'
                          )
                          const ruta =  base_url + 'Peticiones/generarpdf/'+ res.id_peticion;
                          window.open(ruta);
                          setTimeout(() => {
                              window.location.reload();
                          }, 300);
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'error'
                          )
                    }
                }
            }

        }
      })
}
function modificarEmpresa() {
    const frm = document.getElementById('frmEmpresa');
    const url = base_url + "Administracion/modificar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status ==200) {
            const res = JSON.parse(this.responseText);
            if (res == 'ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Los datos se han actualizado correctamente',
                    showConfirmButton: false,
                    timer: 2000
                }) 
            }
        }
    }
}
function alertas(mensaje, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 2500
      })
}
function btnAnularPeticion(id) {
    Swal.fire({
        title: 'Estas seguro de cancelar la solicitud?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
          if (result.isConfirmed) {
            const url = base_url + "Peticiones/anularPeticion/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status==200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    t_historialSolicitud.ajax.reload();
                } 
            }

        }
    })
}
//para para control de solicitudes de administrador
function btnAprobarSolicitud(id) {
    Swal.fire({
        title: 'Estas apunto de aprobar la solicitud, deseas continuar?',
        text: "Al aprobar la solicitud debes continuar con el proceso para responder esta solicitud!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(36, 36, 36)',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "SolicitudAlumnos/aprobar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'Aprobada!',
                            'Solicitud aprobada correctamente.',
                            'success'
                          )
                          tblAdminSolicitud.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function btnEliminarSolicitud(id) {
    Swal.fire({
        title: 'Estas seguro de no aprobar la solicitud?',
        text: "La solicitud no sera aprobada!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(36, 36, 36)',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText:'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "SolicitudAlumnos/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status ==200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'No aprobado!',
                            'La solicitud no se ha aprobado.',
                            'success'
                          )
                          tblAdminSolicitud.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje',
                            res,
                            'Error'
                          )
                    }
                }
            }

        }
      })
}
function registrarPermisos(e) {
    e.preventDefault();
    const url = base_url + "Usuarios/registrarPermiso";
    const frm = document.getElementById('formulario')
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res != '') {
                alertas(res.msg, res.icono);
            }else {
                alertas('Error no identificado', 'error');
            }
        }
        
    }
}

