<?php


/* Obtengo los datos del formulario */
foreach ($_POST as $nombre_campo => $valor) {
    $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
    eval($asignacion);
}

if (isset($topic2selected)) {

    $config = array(
        'url' => 'https://virtual.ucatolicaluisamigo.edu.co/soporte/api/tickets.json',
        'key' => '3796998F3A0F8F860C848DBCBBD8ABD5'
    );

    /* verifico si envió datos del cursos y lo llevo a la variable context */

    if(isset($nombreCurso)){
        $context = $codigoCurso . " - " . $nombreCurso . " - " . "G" . $grupoCurso . " -> PROFESOR: " . $nombreProfesor; 
    } else {
        $context = "Solicitud general de usuario";
    }


    $data = array(
        'name' => $userfullname, //Nombre completo del usuario
        'email' => $useremail, //Email del solicitante
        'subject' => $subject = $topic1selected, //Titulo del caso
        'message' => $problema, //cuerpo del mensaje
        'ip' => $_SERVER['REMOTE_ADDR'], //IP CLIENTE
        'topicId' => '37', //Tema de ayuda de osticket

        // CAMPOS PERSONALIZADOS PARA FORMULARIO ASOCIADO A TEMA DE AYUDA

        'profile' => $perfil . " - " . $sede,
        'idnumber' => $idnumber,
        'topic1' => $topic1selected . " > " . substr($topic2selected, 4, 200),
        'context' => strtoupper($context),
        'userprofile' => $userprofile,

        'attachments' => array() //ARREGLO PARA ARCHIVOS
    );

    foreach ($_FILES as $file => $f) {
        if (isset($f) && is_uploaded_file($f['tmp_name'])) {
            $nombre = $f["name"];
            $tipo = $f["type"];
            $ruta = $f['tmp_name'];
            $data['attachments'][] = array("$nombre" => 'data: ' . $tipo . ';base64,' . base64_encode(file_get_contents($ruta)));
        }
    }

 
    function_exists('curl_version') or die('CURL support required');
    function_exists('json_encode') or die('JSON support required');
    
    set_time_limit(30);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $config['url']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_USERAGENT, 'osTicket API Client v1.8');
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:', 'X-API-Key: '.$config['key']));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    $result=curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($code != 201)
    die('Error al generar el ticket: '.$result);
    
    $ticket_id = (int) $result;
    
    header("location: index.php?result=$ticket_id");
    exit; 

    //echo "Hemos generado su solicitud con el ticket # ".$ticket_id."  Responderemos a la mayor brevedad a su correo institucional. Por favor no generar otra solicitud hasta que reciba respuesta.";
 
}
else {
 header("location: index.php");
 exit;
}
