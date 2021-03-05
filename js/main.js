var topic1 = [
  ["", " --- Seleccione un elemento de la lista --- "],
  ["valor1", "Evento académico (conferencia, seminario, etc)"],
  ["valor2", "Evento institucional (capacitación, inducción, etc)"],
  ["valor3", "Actividad cultural (concierto, feria, etc)"],
];

var topic2 = [
  ["", ""],
  ["valor1", "Pendiente 11"],
  ["valor1", "Pendiente 21"],
  ["valor2", "Pendiente 31"],
  ["valor2", "Pendiente 41"],
];

var allTopic = [[], topic1, topic2];

function mostrar(value) {
  if (value == "valor1") {
    $("#formEventoAcademico").show();
    $("#formGeneral").hide();
  }
  if (value == "valor2") {
    $("#formGeneral").show();
    $("#formEventoAcademico").hide();
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

function cambiar_topic() {
  $("#topic2select").hide();
  $("#formGeneral").hide();
  $("#formCurso").hide();
  var topic1;
  topic1 =
    document.formTopic.topic1[document.formTopic.topic1.selectedIndex].value;

  if (topic1 != 0) {
    topics = allTopic[topic1];
    //calculo el numero de provincias
    numTopics = topics.length;
    //marco el número de provincias en el select
    document.formTopic.topic2.length = numTopics;
    //para cada provincia del array, la introduzco en el select
    for (i = 0; i < numTopics; i++) {
      document.formTopic.topic2.options[i].value = topics[i][0];
      document.formTopic.topic2.options[i].text = topics[i][1];
    }
  } else {
    //si no había provincia seleccionada, elimino las provincias del select
    document.formTopic.topic2.length = 1;
    //coloco un guión en la única opción que he dejado
    document.formTopic.topic2.options[0].value = "----";
    document.formTopic.topic2.options[0].text = "----";
  }
  //marco como seleccionada la opción primera de provincia
  document.formTopic.topic2.options[0].selected = true;
  $("#topic2select").show();
}

contador = 1; // contador de campos agregados a las sesiones de eventos
function AgregarSesion() {
  contador = contador + 1;
  $("<div>").load("sesionesEvento.php?id=" + contador, function () {
    $("#sesiones").append($(this).html());
    $("[type='date']").attr("min", fechaLimite());
  });
}

function BorrarSesion() {
  $("div.lista-sesiones").each(function (index, item) {
    jQuery(":checkbox", this).each(function () {
      if ($(this).is(":checked")) {
        $(item).remove();
      }
    });
  });
}

contadorp = 1; // contador de campos de panelistas
function AgregarPanelista() {
  contadorp = contadorp + 1;
  $("<div>").load("panelistasEvento.php?id=" + contadorp, function () {
    $("#panelistas").append($(this).html());
  });
}

function BorrarPanelista() {
  $("div.lista-panelistas").each(function (index, item) {
    jQuery(":checkbox", this).each(function () {
      if ($(this).is(":checked")) {
        $(item).remove();
      }
    });
  });
}
