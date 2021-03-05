<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>Centro de Ayuda y Soporte</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- <link rel="stylesheet" href="css/estilos.css"> -->
  <!-- <script src="js/main.js"></script> -->
  <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'> -->
  <script src="js/main.js"></script>
  <link rel="stylesheet" href="./style.css">
</head>
<!-- script de fechas límite y cálculo de duración -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->  
<script>
  $(document).ready(function() {

      fechaLimite();
      $("[type='date']").attr("min", fechaLimite);
      $("[type='time']").attr("min", "07:00");
      $("[type='time']").attr("max", "18:00");
  });

  function fechaLimite() {
      var f = new Date();
      var dia5 = f.getDate() + 4;
      var mes1 = f.getMonth() + 1;
      if (mes1 < 10) {
          mes1 = "0" + mes1;
      }
      var fechaLimite = f.getFullYear() + "-" + mes1 + "-" + dia5;

      return fechaLimite;
  }

  function calcularDuracion(id) {

      var inicio = $("#horaInicio" + id.slice(-1)).val();
      var fin = $("#horaFin" + id.slice(-1)).val();
      var id_duracion = "#duracion" + id.slice(-1);

      var hora1 = fin.split(":");
      var hora2 = inicio.split(":");

      t1 = new Date();
      t2 = new Date();

      t1.setHours(hora1[0], hora1[1]);
      t2.setHours(hora2[0], hora2[1]);

      t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes());

      if (isNaN(t1.getHours())) {
          $(id_duracion).val("Falta información");
      } else {
          if (t1.getHours() > 12) {
              $(id_duracion).val("Error");
              $("#horaFin" + id.slice(-1)).val("");
              alert(
                  "El evento no puede terminar sin que haya empezado. Revise Hora Inicio y Hora Fin."
              );
          } else {
              var duracion = +t1.getHours() + " horas y " + t1.getMinutes() + " min.";
              $(id_duracion).val(duracion);
          }
      }
  }
</script>
<!-- /script -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- php que captura variables -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->  
<?php
// Obtengo variables enviadas desde moodle
$courseid = $_GET['courseid']; // ID del curso

// Obtengo respuesta de API
$ticket = $_GET['result']; // Numero de ticket generado

if ($courseid == 3) {
    $coursefullname = $_GET['coursefullname']; // Nombre completo del curso
    $userid = $_GET['userid']; // ID del usuario (Moodle)
    $firstname = $_GET['firstname']; // Nombre del usuario
    $lastname = $_GET['lastname']; // Aapellidos del usuario
    $email = $_GET['email']; // e-mail del usuario
    $idnumber = $_GET['idnumber']; // Número de documento de identidad del usuario
}
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// --> 
<body>

<!-- /php que captura variables -->
<!--HEADER-->
<header class="header">
  <h1 class="header__title">Centro de Ayuda y Soporte</h1>
  
</header>
<!--CONTENT     -->
<div class="content">
  <!--content inner-->
  <div class="content__inner">
    <div class="container">
      <!--content title-->
      <h2 class="content__title content__title--m-sm">Reservas</h2>
    </div>
    <div class="container overflow-hidden">
      <!--multisteps-form-->
      <div class="multisteps-form">
        <!--progress bar-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// --> 
        <div class="row">
          <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
            <div class="multisteps-form__progress">
              <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Servicio de Streaming</button>
              <button class="multisteps-form__progress-btn" type="button" title="Address">Evento</button>
              <button class="multisteps-form__progress-btn" type="button" title="Order Info">Sesiones</button>
              <button class="multisteps-form__progress-btn" type="button" title="Order Info">Panelistas</button>
              <button class="multisteps-form__progress-btn" type="button" title="Order Info">Contacto</button>
              <button class="multisteps-form__progress-btn" type="button" title="Comments">T y C</button>
            </div>
          </div>
        </div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// --> 
        <!--form panels-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div class="row">
          <div class="col-12 col-lg-8 m-auto">
            <form class="multisteps-form__form needs-validation" novalidate name="formTopic" id="formTopic">
              <!--single form panel-->
<!--Step 1-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Servicio de Streaming</h3>
                <div class="multisteps-form__content">
                  <!-- ////////////////////// -->
                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <label for="topic1" type="text">
                        <b>Indique el servicio que desea solicitar</b>
                      </label>
                    </div>
                  </div>
                  <!-- ////////////////////// -->
                  <div class="form-group">
                    <select class="custom-select browser-default" id="topic1" name="topic1" onChange="cambiar_topic()" required>
                                      <option value="" selected="true" disabled> --- Seleccione un elemento de la lista --- </option>
                                      <option value='1'>Seminario Web de Zoom (hasta 500 participantes)</option>
                                      <option value='1'>Transmisión en vivo a través de YouTube (streaming)</option>
                                      <option value='1'>Videoconferencia de Zoom (hasta 300 participantes) </option>
                                      <option value='2'>Solicitud de información y reportes de eventos pasados</option>
                    </select>
                    <div class="invalid-feedback">
                      Por favor seleccione un servicio
                    </div>
                  </div>
                  <!-- ////////////////////// -->
                  <div class="form-row mt-4">
                    <div class="col">
                      <label for="topic222" type="text">
                        <b>¿Cuál es el tipo de evento para el que solicita el servicio?</b> 
                      </label>
                    </div>
                  </div>
                  <!-- ////////////////////// -->
                  <div class="form-group">
                    <select class="custom-select browser-default" id="topic222" name="topic222" onChange="cambiar_topic()" required>
                                      <option value="" selected="true" disabled> --- Seleccione un elemento de la lista --- </option>
                                      <option value='1'>Evento académico (conferencia, seminario, etc)</option>
                                      <option value='1'>Evento institucional (capacitación, inducción, etc)</option>
                                      <option value='1'>Videoconferencia de Zoom (hasta 300 participantes) </option>
                                      <option value='2'>Solicitud de información y reportes de eventos pasados</option>
                    </select>
                    <div class="invalid-feedback">
                      Por favor seleccione un servicio
                    </div>
                  </div>
                  <!-- ////////////////////// Botón Siguiente 1 -->
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary ml-auto js-btn-next" id="next1" type="button" title="Next" disabled>Siguiente</button>
                  </div>
                </div>
              </div>
              <!--/Step 1-->
              <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <!--single form panel-->
              <!--Step 2-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Información básica del evento</h3>
                <p>La información recolectada permitirá almacenar este evento en el repositorio
                institucional de AcademiaEnVivo para su consulta posterior</p>
                <div class="multisteps-form__content">
                  <!-- ////////////////////// -->
                  <div class="form-row mt-4">
                    <div class="col">
                    <label for="inscripcion"><b>Nombre del evento</b></label>
                      <input type="text" class="form-control" id="tituloE" placeholder="Nombre completo del evento" required>
                      <div class="invalid-feedback">
                        Por favor escriba el nombre completo del evento
                      </div>
                    </div>
                  </div>
                  <!-- ////////////////////// -->
                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <label for="unidad" type="text">
                      <b>Unidad académica que organiza</b>
                      </label>
                    </div>
                  </div>
                  <!-- ////////////////////// -->
                  <div class="form-group">
                    <select class="custom-select browser-default" id="unidad" name="unidad" required>
                        <option value="" selected="true" disabled> --- Seleccione unidad académica --- </option>
                        <option value='Vicerrectoría de Investigaciones'>Vicerrectoría de Investigaciones</option>
                        <option value='Facultad de Psicología y Ciencias Sociales'>Facultad de Psicología y Ciencias Sociales</option>
                        <option value='Facultad de Ciencias Administrativas, Económicas y Contables'>Facultad de Ciencias Administrativas, Económicas y Contables</option>
                    </select>
                    <div class="invalid-feedback">
                      Por favor seleccione una unidad
                    </div>
                  </div>
                  <!-- ////////////////////// --> 
                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-6">
                      <label for="inscripcion"><b>Método de inscripción</b></label>
                        <select class="custom-select browser-default" id="inscripcion" name="inscripcion" required>
                          <option value="" selected="true" disabled>-- seleccione una opción --</option>
                          <option value='SISTEMA ACADÉMICO'>Sistema Académico</option>
                          <option value='WEBINAR DE ZOOM'>Webinar de Zoom</option>
                          <option value='SIN INSCRIPCIÓN PREVIA'>Sin inscripción previa</option>
                        </select>
                        <div class="invalid-feedback">
                          Por favor seleccione una inscripción
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <label for="publico"><b>Público objetivo: </b></label>
                        <select class="custom-select browser-default" id="publico" name="publico" required>
                              <option value="" selected="true" disabled> -- seleccione una opción -- </option>
                              <option value='Estudiantes'>Estudiantes</option>
                              <option value='Docentes'>Docentes</option>
                              <option value='Estudiantes y docentes'>Estudiantes y docentes</option>
                              <option value='Empleados'>Empleados</option>
                              <option value='Comunidad amigoniana'>Comunidad amigoniana</option>
                              <option value='Público general'>Público general</option>
                        </select>
                        <div class="invalid-feedback">
                          Por favor seleccione el tipo de público
                        </div>
                    </div>
                  </div>
                  <!-- ////////////////////// -->
                  <div class="form-group">
                      <label for="detalle"><b>Descripción del evento: </b></label>
                      <textarea class="form-control" id="detalle" name="detalle" rows="3" placeholder="Escriba aquí la descripción del evento y su principal objetivo. Esta información será util para el repositorio de AcademiaEnVivo" required></textarea>
                  </div>
                  <hr />
                  <!-- ////////////////////// Botón Siguiente 2 -->
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                    <button class="btn btn-primary ml-auto js-btn-next" id="next2" type="button" title="Next" disabled>Siguiente</button>
                  </div>
                </div>
              </div>
              <!--/Step 2-->
              <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <!--single form panel-->
              <!--Step 3-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <!-- ////////////////////// -->
                <h3 class="multisteps-form__title">Sesiones programadas</h3>
                <p>Si el evento tiene más de una sesión programada, usted puede agregarlas a continuación para que nuestro equipo logístico pueda agendarlas de manera separada. Tenga un cuenta que si separa varias sesiones pero una de ellas se cancela y no informa a educación virtual, entonces todas las sesiones serán canceladas automáticamente de nuestra agenda.</p>
                <div class="multisteps-form__content">
                <!-- ////////////////////// --> 
                  <div id="sesiones" class="form-row mt-4 ">
                    <div class="col-12 col-sm-3">
                      <label for="inscripcion"><b>Fecha del evento</b></label>
                      <input type="date" data-format="dd/mmmm/yyyy" min="" class=" form-control" id="fechaEvento1" name="fechaEvento1" required>
                      <div class="invalid-feedback">
                          Por favor seleccione una fecha
                      </div>
                    </div>
                    <div class="col-12 col-sm-3">
                      <label for="publico"><b>Hora inicio am/pm</b></label>
                      <input type="time" class="form-control" id="horaInicio1" name="horaInicio1" onblur="calcularDuracion(this.id)" placeholder="" required>
                      <div class="invalid-feedback">
                        Por favor seleccione una hora
                      </div>
                    </div>
                    <div class="col-12 col-sm-3">
                      <label for="publico"><b>Hora fin am/pm</b></label>
                        <input type="time" class="form-control" id="horaFin1" name="horaFin1" onblur="calcularDuracion(this.id)" required>  
                        <div class="invalid-feedback">
                        Por favor seleccione una hora
                        </div>
                    </div>
                    <div class="col-12 col-sm-2">
                      <label for="inscripcion"><b>Duración</b></label>
                      <input type="text" class="form-control" id="duracion1" name="duracion1" disabled>
                    </div>
                    <div class="" style="margin: 30px 20px 0px 15px;  float: left;">
                      <input type="checkbox" name="item_index" id="item_index" disabled />
                    </div>
                    <!-- ////////////////////// -->
                    <div class="col-12 col-sm-3">
                      <label for="inscripcion"><b>Fecha del evento</b></label>
                      <input type="date" data-format="dd/mmmm/yyyy" min="" class=" form-control" id="fechaEvento1" name="fechaEvento1" required>
                      <div class="invalid-feedback">
                          Por favor seleccione una fecha
                      </div>
                    </div>
                    <div class="col-12 col-sm-3">
                      <label for="publico"><b>Hora inicio am/pm</b></label>
                      <input type="time" class="form-control" id="horaInicio1" name="horaInicio1" onblur="calcularDuracion(this.id)" placeholder="" required>
                      <div class="invalid-feedback">
                        Por favor seleccione una hora
                      </div>
                    </div>
                    <div class="col-12 col-sm-3">
                      <label for="publico"><b>Hora fin am/pm</b></label>
                        <input type="time" class="form-control" id="horaFin1" name="horaFin1" onblur="calcularDuracion(this.id)" required>  
                        <div class="invalid-feedback">
                        Por favor seleccione una hora
                        </div>
                    </div>
                    <div class="col-12 col-sm-2">
                      <label for="inscripcion"><b>Duración</b></label>
                      <input type="text" class="form-control" id="duracion1" name="duracion1" disabled>
                    </div>
                    <div class="" style="margin: 30px 20px 0px 15px;  float: left;">
                      <input type="checkbox" name="item_index" id="item_index" disabled />
                    </div>
                    <!-- ////////////////////// -->
                    <br />
                    <!-- <div id="sesiones"></div> -->
                      <div class="btn-action float-clear">
                          <input class="btn btn-info btn-sm" type="button" name="agregar_registros" value="Nueva sesión" onClick="AgregarSesion();" />
                          <input class="btn btn-danger btn-sm" type="button" name="borrar_registros" value="Eliminar sesión" onClick="BorrarSesion();" />
                          <p>
                            <span>Seleccione las sesiones a eliminar desde la casilla de la derecha</span>
                          </p>
                      </div>
                    <hr />
                    <!-- ////////////////////// -->
                  </div>
                  
                      
                  <!-- ////////////////////// Botón Siguiente 3 -->
                  <div class="row">
                    <div class="button-row d-flex mt-4 col-12">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                      <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Siguiente</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--/Step 3-->
              <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <!--single form panel-->
              <!--Step 4-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Información de los panelistas</h3>
                <div class="multisteps-form__content">
                  <!-- ////////////////////// --> 
                  <div class="form-row mt-4">
                      <div class="col-12 col-sm-6">
                        <label for="inscripcion"><b>Nombre del panelista</b></label>
                          <input type="text" class="form-control" id="nombrePanelista1" name="nombrePanelista1" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el nombre
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="publico"><b>Correo electrónico</b></label>
                        <input type="text" class="form-control" id="correoPanelista1" name="correoPanelista1" required>
                        <div class="invalid-feedback">
                          Por favor ingrese un correo válido
                        </div>
                      </div>
                  </div>
                  <!-- ////////////////////// -->
                  <div class="form-row mt-4">
                    <label for="inscripcion"><b>Curriculum del panelista</b></label>
                    <textarea class="form-control" id="cvPanelista1" name="cvPanelista1" rows="3" placeholder="Indique el cargo o curriculum del panelista" required></textarea>
                    <div class="invalid-feedback">
                      Por favor ingrese el cargo
                    </div>
                  </div>
                  <hr />
                  <!-- ////////////////////// --> 
                  <div id="panelistas"></div>

                  <div class="btn-action float-clear">
                      <input class="btn btn-info btn-sm" type="button" name="agregar_registros" value="Nuevo panelista" onClick="AgregarPanelista();" />
                      <input class="btn btn-danger btn-sm" type="button" name="borrar_registros" value="Eliminar Panelista" onClick="BorrarPanelista();" /> <span>Seleccione las sesiones a eliminar desde la casilla de la derecha</span>
                  </div>
                  <!-- ////////////////////// Botón Siguiente 4 -->
                  <div class="row">
                    <div class="button-row d-flex mt-4 col-12">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                      <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Siguiente</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--/Step 4-->
              <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <!--single form panel-->
              <!--Step 5-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Datos de contacto</h3>
                <p>Por favor suminstre el nombre, correo, y numero celular de la persona que estará a cargo del evento. Esta información se empleará exclusivamente para la lógistica del evento.</p>
                <div class="multisteps-form__content">
                  <!-- ////////////////////// --> 
                  <div class="form-row mt-4">
                      <div class="col-12 col-sm-6">
                        <label for="inscripcion"><b>Nombre del contacto</b></label>
                          <input type="text" class="form-control" id="nombrePanelista1" name="nombrePanelista1" required>
                        <div class="invalid-feedback">
                            Por favor ingrese un nombre
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="publico"><b>Correo electrónico del contacto</b></label>
                        <input type="text" class="form-control" id="correoPanelista1" name="correoPanelista1" required>
                        <div class="invalid-feedback">
                          Por favor ingrese un correo válido
                        </div>
                      </div>
                  </div>
                  <!-- ////////////////////// --> 
                  <div class="form-row mt-4">
                      <div class="col-12 col-sm-6">
                        <label for="inscripcion"><b>Número móvil</b></label>
                        <input type="number" class="form-control" id="celular" name="celular" min="3000000000" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el nombre
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="publico"><b>Centro regional o sede</b></label>
                        <select class="custom-select browser-default" id="sede" name="sede" required>
                            <option value="" selected="true" disabled> --- Seleccione --- </option>
                            <option value='MEDELLIN'>MEDELLIN</option>
                            <option value='MANIZALES'>MANIZALES</option>
                            <option value='APARTADÓ'>APARTADÓ</option>
                            <option value='MONTERÍA'>MONTERÍA</option>
                            <option value='BOGOTÁ'>BOGOTÁ</option>
                        </select>
                        <div class="invalid-feedback">
                          Por favor ingrese un correo válido
                        </div>
                      </div>
                  </div>
                  <!-- ////////////////////// Botón Siguiente 5 -->
                  <div class="row">
                    <div class="button-row d-flex mt-4 col-12">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                      <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Siguiente</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--/Step 5-->
              <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <!--single form panel-->
              <!--Step 6-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Términos y condiciones</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                  <ul class="list-group list-group-flush">
                            <li class="list-group-item">Este es un servicio de soporte técnico. Cuestiones de orden académico o administrativo deben ser tratadas con su docente, tutor o director del programa.</li>
                            <li class="list-group-item">Nuestros tiempos de respuesta son en promedio de 6 horas hábiles, contadas dentro del horario laboral (Lunes a jueves 07:00 - 17:00, viernes 07:00 - 16:30).</li>
                            <li class="list-group-item">Si la respuesta que recibe no soluciona su problema, puede replicar haciendo clic en la opción correspondiente que aparece en el correo.</li>
                            <li class="list-group-item">Todos las solicitudes que se generan desde el Campus Virtual registran los datos del solicitante para brindar una respuesta personalizada.</li>
                            <li class="list-group-item">Todos los casos son atendidos por el Departamento de Educación Virtual, excepto en los cursos de AFI, que tienen su propio equipo de soporte.</li>
                        </ul>
                  </div>
                  <!-- ////////////////////// Botón enviar -->
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                    <button class="btn btn-success ml-auto" type="button" title="Send">Enviar</button>
                  </div>
                  <hr />
                  <div class="alert alert-warning" role="alert">
                      Recibirás en pocos minutos un mensaje a tu correo <b><?php echo $email ?></b> en el que confirmamos recepción de tu caso y el tiempo estimado que nos tomará resolverlo.
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--/Step 6-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
      <!--/form panels-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////// --> 
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script>
  <script  src="./script.js"></script>
  <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            /////////////////////////// Variables validaciones step 1
            var botonNext1 = document.getElementById("next1");
            var selectServicio = document.getElementById("topic1");
            var selectEvento = document.getElementById("topic222");
            /////////////////////////// Variables validaciones step 2
            var botonNext2 = document.getElementById("next2");
            var tituloEvento = document.getElementById("tituloE");
            var uAcademica = document.getElementById("unidad");
            var inscripcionE = document.getElementById("inscripcion");
            var tPublico = document.getElementById("publico");
            var dEvento = document.getElementById("detalle");
            ///////////////////////////
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('click', function(event) {
                /////////////////////////// Validaciones bloqueo de botón step 1 
                if (selectServicio.checkValidity() === false || selectEvento.checkValidity() === false) {
                  botonNext1.disabled = true;
                } else {
                  botonNext1.disabled = false;
                }
                /////////////////////////// Validaciones bloqueo de botón step 2 
                if (tituloEvento.checkValidity() === false || uAcademica.checkValidity() === false
                  || inscripcionE.checkValidity() === false || tPublico.checkValidity() === false ||
                  dEvento.checkValidity() === false) {
                  botonNext2.disabled = true;
                } else {
                  botonNext2.disabled = false;
                }
                ///////////////////////////
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
  </script>
</body>
</html>