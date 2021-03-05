<!DOCTYPE html>
<html lang="es">

<head>
    <title>Centro de Ayuda y Soporte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet' type='text/css'>

    <script type="text/javascript">
        function mostrar(value) {
            if (value == "valor1") {
                $("#formCurso").show();
                $("#formGeneral").hide();
            }
            if (value == "valor2") {
                $("#formGeneral").show();
                $("#formCurso").hide();
            }

            if (value == "") {
                $("#formGeneral").hide();
                $("#formCurso").hide();
            }


            $("#topic11selected").val($("#topic1 option:selected").text());
            $("#topic21selected").val($("#topic2 option:selected").text());
            $("#topic12selected").val($("#topic1 option:selected").text());
            $("#topic22selected").val($("#topic2 option:selected").text());
        }

        var topic1 = [
            ["", ""],
            ["valor1", "1.1 Faltan cursos en mi perfil del campus virtual"],
            ["valor2", "1.2 Aparecen aulas virtuales de otros grupos a los que no pertenezco"],
        ];

        var topic2 = [
            ["", ""],
            ["valor1", "2.1 No aparecen los encuentros programados en el aula virtual"],
            ["valor1", "2.2 Ingreso a los encuentros por Zoom pero el docente no se conecta"],
            ["valor2", "2.3 La aplicación de Zoom no está funcionando en mis dispositivos"],
            ["valor2", "2.4 Otro tipo de problema con los encuentros sincrónicos"],
        ];

        var topic3 = [
            ["", ""],
            ["valor2", "3.1 Uso de las herramientas que ofrece la plataforma"],
            ["valor2", "3.2 Inquietud sobre la estrategia de educación mediada por tecnología"],
            ["valor2", "3.3 Otro tipo de dificultad"]
        ];

        var topic4 = [
            ["", ""],
            ["valor2", "4.1 Proponer una nueva herramienta o funcionalidad"],
            ["valor2", "4.2 Mejoras en la interfaz de usuario y estética del campus"],
            ["valor2", "4.3 Otro tipo de sugerencia"]
        ];

        var allTopic = [
            [],
            topic1,
            topic2,
            topic3,
            topic4
        ];

        function cambiar_topic() {
            $("#topic2select").hide();
            $("#formGeneral").hide();
            $("#formCurso").hide();
            var topic1
            topic1 = document.formTopic.topic1[document.formTopic.topic1.selectedIndex].value

            if (topic1 != 0) {
                topics = allTopic[topic1]
                //calculo el numero de provincias 
                numTopics = topics.length
                //marco el número de provincias en el select 
                document.formTopic.topic2.length = numTopics
                //para cada provincia del array, la introduzco en el select 
                for (i = 0; i < numTopics; i++) {
                    document.formTopic.topic2.options[i].value = topics[i][0]
                    document.formTopic.topic2.options[i].text = topics[i][1]
                }
            } else {
                //si no había provincia seleccionada, elimino las provincias del select 
                document.formTopic.topic2.length = 1
                //coloco un guión en la única opción que he dejado 
                document.formTopic.topic2.options[0].value = "----"
                document.formTopic.topic2.options[0].text = "----"
            }
            //marco como seleccionada la opción primera de provincia 
            document.formTopic.topic2.options[0].selected = true
            $("#topic2select").show();
        }

        /* Evitar el doble envío de formulario */
        enviando = false; //Obligaremos a entrar el if en el primer submit
        function checkSubmit() {
            if (!enviando) {
                enviando = true;
                return true;
            } else {
                //Si llega hasta aca significa que pulsaron 2 veces el boton submit
                alert("¡Tranquilo(a)! ya estamos recibiendo su solicitud");
                return false;
            }
        }
    </script>
</head>

<?php
// Obtengo variables enviadas desde moodle 
$courseid = $_GET['courseid']; // ID del curso

// Obtengo respuesta de API
$ticket = $_GET['result']; // Numero de ticket generado

if ($courseid == 2) {
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
                                    <b>¿En qué podemos ayudarte el dia de hoy?</b>
                                </label>
                                <select class="custom-select browser-default col-xl-5" id="topic1" name="topic1" onChange="cambiar_topic()" required>
                                    <option value="" selected="true" disabled> --- Seleccione un elemento de la lista --- </option>
                                    <option value='1'>1. Tengo problemas para acceder a mis aulas virtuales</option>
                                    <option value='2'>2. Tengo problemas para acceder a mis encuentros sincrónicos por Zoom </option>
                                    <option value='3'>3. Tengo una inquietud general sobre el campus virtual </option>
                                    <option value='4'>4. Quiero hacer una sugerencia para la mejora del campus virtual </option>
                                </select>
                            </div>
                            <div class="form-group" id="topic2select" style="display: none;">
                                <label for="topic2">
                                    <b>Seleccione el tipo de problema o inquietud en la que requiere atención</b>
                                </label>
                                <select class="custom-select browser-default col-xl-5" id="topic2" name="topic2" onChange="mostrar(this.value);" required>
                                </select>
                            </div>
                        </form>
                        <!-- Inicia formulario 1 -->
                        <div id="formCurso" style="display: none;">
                            <form action="generar.php" method="post" enctype="multipart/form-data" class="was-validated" id="fomulario1" name="formulario2" onsubmit="return checkSubmit();">
                                <hr />
                                <div class="form-group">
                                    <label for="nombreCurso">Escriba el nombre del curso(si son varios puedes indicarlos en los detalles de la solicitud)</label>
                                    <input type="text" style="text-transform: uppercase" class="form-control" id="nombreCurso" name="nombreCurso" placeholder="" required></input>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="codigoCurso">Codigo curso</label>
                                        <input type="text" class="form-control" id="codigoCurso" name="codigoCurso" placeholder="" style="text-transform: uppercase" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="grupoCurso">N° de grupo</label>
                                        <input type="number" class="form-control" id="grupoCurso" min="0" step="1" name="grupoCurso" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nombreProfesor">Nombre del profesor</label>
                                        <input type="text" class="form-control" id="nombreProfesor" name="nombreProfesor" style="text-transform: uppercase" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="problema">
                                        <h6><b>Escriba los detalles de su solicitud o problema. De ser necesario, adjunta una evidencia</b></h6>
                                    </label>
                                    <textarea class="form-control" id="problema1" name="problema" rows="5" placeholder="Escribe aquí todos los detalles del problema para que nuestro equipo de soporte pueda brindarte una solución efectiva y oportuna.  Si el caso se presenta con varios cursos, debes indicar aquí el código, grupo y nombre completo de cada curso. Considere además ADJUNTAR un archivo o imagen con evidencias de su problema" required></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cedula">Número de Cédula, TI o CE</label>
                                        <input type="number" class="form-control" id="cedula" name="cedula" min="0" step="1" name="cedula" required>
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
                                        <input type="file" name="archivo" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="submit" value="Enviar mi solicitud" class="btnsubmit btn btn-danger">
                                    </div>
                                    <hr />
                                    <div class="alert alert-warning" role="alert">
                                        Recibirás en pocos minutos un mensaje a tu correo <b><?php echo $email ?></b> en el que confirmamos recepción de tu caso y el tiempo estimado que nos tomará resolverlo.
                                    </div>
                                </div>
                                <!-- campos ocultos para procesar el ticket -->
                                <input type="hidden" name="topic1selected" id="topic11selected" value="" />
                                <input type="hidden" name="topic2selected" id="topic21selected" value="" />
                                <input type="hidden" name="userfullname" id="userfullname" value="<?php echo $firstname . " " . $lastname; ?>" />
                                <input type="hidden" name="useremail" id="useremail" value="<?php echo $email; ?>" />
                                <input type="hidden" name="idnumber" id="idnumber" value="<?php echo $idnumber; ?>" /> <!-- Cédula del usuario -->
                                <input type="hidden" name="courseid" id="courseid" value="<?php echo $courseid; ?>" />
                                <input type="hidden" name="userprofile" id="userprofile" value="<?php echo "https://virtual.ucatolicaluisamigo.edu.co/campus/user/view.php?id=" . $userid ?>" />
                            </form>
                        </div>
                        <!-- inicia formulario 2 -->
                        <div id="formGeneral" style="display: none;">
                            <form action="generar.php" method="post" enctype="multipart/form-data" class="was-validated" id="fomulario1" name="formulario2" onsubmit="return checkSubmit();">
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
                                        <input type="file" name="archivo" class="form-control-file" id="exampleFormControlFile1">
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

    <script>
        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button"; //esta linea es necesaria para chrome
        window.onhashchange = function() {
            window.location.hash = "no-back-button";
        }
    </script>

<?php
    } else {
        echo "No hemos recibido los parámetros necesarios para procesar esta solicitud. Contacte al Departamento de Educación Virtual para reportar el problema.";
    }
}
?>