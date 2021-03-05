<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];
?>
    <div class="form-row lista-sesiones">
        <div class="form-group col-md-3">
            <label for="fechaEvento1">Sesión N° <?php echo $id ?> </label>
            <input type="date" data-format="dd/mmmm/yyyy" min="" class=" form-control" id="fechaEvento<?php echo $id ?>" name="fechaEvento<?php echo $id ?>" required>
        </div>
        <div class="form-group col-md-3">
            <label for="horaInicio1">Hora Inicio </label>
            <input type="time" class="form-control" id="horaInicio<?php echo $id ?>" name="horaInicio<?php echo $id ?>" onblur="calcularDuracion(this.id)" placeholder="" required>
        </div>
        <div class="form-group col-md-3">
            <label for="horaFin1">Hora Fin</label>
            <input type="time" class="form-control" id="horaFin<?php echo $id ?>" name="horaFin<?php echo $id ?>" onblur="calcularDuracion(this.id)" required>
        </div>
        <div class="form-group col-md-2">
            <label for="horaFin1">Duracion</label>
            <input type="text" class="form-control" id="duracion<?php echo $id ?>" name="duracion<?php echo $id ?>" disabled>
        </div>
        <div class="" style="margin: 30px 20px 0px 15px;  float: left;">
            <input type="checkbox" name="item_index" id="item_index" />
        </div>
    </div>
<?php
} else {
    echo "Se ha presentado un problema cargando los campos";
}

?>