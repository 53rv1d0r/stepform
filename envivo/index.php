<!DOCTYPE html>
<html lang="es">

<head>
    <title>Centro de Ayuda y Soportess</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet' type='text/css'>
</head>

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
?>

    <body>
        <div class="container">
            <!-- Contenedor Pestañas Navegacion -->
            <ul class="nav nav-tabs" role="tablist">
                <!-- Pestañas Navegacion -->
                <li class="nav-item">
                    <a class="nav-link active " data-toggle="tab" href="#soporte1">¡Bienvenido <?php echo $firstname ?>!</a>
                </li>
                <!-- Pestañas Navegacion -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#soporte2">Términos y condiciones del servicio</a>
                </li>
            </ul>
            <!-- Contenedor pestaña 1 -->
            <div class="tab-content contpestañas">
                <div id="soporte1" class="container contprincipal tab-pane active"><br>
                    <div class="form-group contenedor1">
                        <form class="was-validated" name="formTopic" id="formTopic">
                            <div class="form-group">
                                <label for="topic1">
                                    Indique el servicio que desea solicitar
                                </label>
                                <select class="custom-select browser-default col-xl-5" id="topic1" name="topic1" onChange="cambiar_topic()" required>
                                    <option value="" selected="true" disabled> --- Seleccione un elemento de la lista --- </option>
                                    <option value='1'>Seminario Web de Zoom (hasta 500 participantes)</option>
                                    <option value='1'>Transmisión en vivo a través de YouTube (streaming)</option>
                                    <option value='1'>Videoconferencia de Zoom (hasta 300 participantes) </option>
                                    <option value='2'>Solicitud de información y reportes de eventos pasados</option>
                                </select>
                            </div>
                            <div class="form-group" id="topic2select" style="display: none;">
                                <label for="topic2">
                                    <b>¿Cuál es el tipo de evento para el que solicita el servicio?</b>
                                </label>
                                <select class="custom-select browser-default col-xl-5" id="topic2" name="topic2" onChange="mostrar(this.value);" required>
                                </select>
                            </div>
                        </form>
                        <!-- Inicia formulario para eventos académicos -->
                        <?php include('formEventoAcademico.php') ?>
                        <!-- inicia formulario 2 -->
                        <div id="formGeneral" style="display: none;">
                            <form action="generar.php" method="post" enctype="multipart/form-data" class="was-validated" id="fomulario1" name="formulario2">
                                <hr />
                                <div class="form-group">
                                    <label for="problema2"><b>Describa su caso y de ser necesario, adjunte una evidencia.</b></label>
                                    <textarea class="form-control" id="problema2" name="problema" rows="5" placeholder="Escribe aquí todos los detalles del problema para que nuestro equipo de soporte pueda brindarte solución efectiva y oportuna. Considera además ADJUNTAR un archivo o imagen con evidencias de su problema." required></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cedula">Número de Cédula, TI o CE</label>
                                        <input type="number" class="form-control" id="cedula" name="cedula" min="0" step="1" name="cedula" onChange="validarCedula(this.value);" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="perfil">Perfil de usuario</b></label>
                                        <select class="custom-select browser-default col-xl-5" id="perfil" name="perfil" required>
                                            <option value="" selected="true" disabled> --- Seleccione --- </option>
                                            <option value='ESTUDIANTE'>ESTUDIANTE</option>
                                            <option value='DOCENTE'>DOCENTE</option>
                                            <option value='ADMINISTRATIVO'>ADMINISTRATIVO</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sede">Centro regional o sede</b></label>
                                        <select class="custom-select browser-default col-xl-5" id="sede" name="sede" required>
                                            <option value="" selected="true" disabled> --- Seleccione --- </option>
                                            <option value='MEDELLIN'>MEDELLIN</option>
                                            <option value='MANIZALES'>MANIZALES</option>
                                            <option value='APARTADÓ'>APARTADÓ</option>
                                            <option value='MONTERÍA'>MONTERÍA</option>
                                            <option value='BOGOTÁ'>BOGOTÁ</option>
                                        </select>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <input type="file" name="archivo" class="form-control-file" id="exampleFormControlFile1" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="submit" value="Enviar mi solicitud" class="btnsubmit btn btn-danger">
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        Recibirás en pocos minutos un mensaje a tu correo <b><?php echo $email ?></b> en el que confirmamos recepción de tu caso y el tiempo estimado que nos tomará resolverlo.
                                    </div>
                                </div>
                                <!-- campos ocultos para procesar el ticket -->
                                <input type="hidden" name="topic1selected" id="topic12selected" value="" />
                                <input type="hidden" name="topic2selected" id="topic22selected" value="" />
                                <input type="hidden" name="userfullname" id="userfullname" value="<?php echo $firstname . " " . $lastname; ?>" />
                                <input type="hidden" name="useremail" id="useremail" value="<?php echo $email; ?>" />
                                <input type="hidden" name="idnumber" id="idnumber" value="<?php echo $idnumber; ?>" /> <!-- Cédula del usuario -->
                                <input type="hidden" name="courseid" id="courseid" value="<?php echo $courseid; ?>" />
                                <input type="hidden" name="userprofile" id="userprofile" value="<?php echo "https://virtual.ucatolicaluisamigo.edu.co/campus/user/view.php?id=" . $userid ?>" />
                            </form>

                        </div>
                        <!-- Finaliza formulario 2-->
                    </div>
                </div>
                <!-- Contenedor pestaña 2 -->
                <div id="soporte2" class="container contprincipal tab-pane"><br>
                    <div class="form-group contenedor2">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Este es un servicio de soporte técnico. Cuestiones de orden académico o administrativo deben ser tratadas con su docente, tutor o director del programa.</li>
                            <li class="list-group-item">Nuestros tiempos de respuesta son en promedio de 6 horas hábiles, contadas dentro del horario laboral (Lunes a jueves 07:00 - 17:00, viernes 07:00 - 16:30).</li>
                            <li class="list-group-item">Si la respuesta que recibe no soluciona su problema, puede replicar haciendo clic en la opción correspondiente que aparece en el correo.</li>
                            <li class="list-group-item">Todos las solicitudes que se generan desde el Campus Virtual registran los datos del solicitante para brindar una respuesta personalizada.</li>
                            <li class="list-group-item">Todos los casos son atendidos por el Departamento de Educación Virtual, excepto en los cursos de AFI, que tienen su propio equipo de soporte.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>

<?php
} else {
    if ($ticket != "") {
?>

    <div class="card text-center" style="display: block !important;">
        <img class="card-img" style="width: inherit" src="css/check.gif" alt="">
        <div class="card-body">
            <div class="alert alert-light" role="alert">
                <h4>Fue asignado el <b>ticket #<?php echo $ticket ?> </b> para esta solicitud</h4>
                <h6>Te responderemos oportunamente a tu correo institucional. </h6>
            </div>
            <div class="alert alert-warning" role="alert">
                <p class="card-text">Para mejorar nuestros tiempos de respuesta, <b>evita generar varias solicitudes para el mismo caso.</b></p>
            </div>
        </div>
    </div>

    <>
        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button"; //esta linea es necesaria para chrome
        window.onhashchange = function() {
        window.location.hash = "no-back-button";
        }
    </>
<?php
    } else {
        echo "No hemos recibido los parámetros necesarios para procesar esta solicitud. Contacte al Departamento de Educación Virtual para reportar el problema.";
    }
}
?>