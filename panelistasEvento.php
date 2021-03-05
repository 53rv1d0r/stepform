<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];
?>
    <div class="lista-panelistas">
        <hr />
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="nombrePanelista1"><b>Nombre del panelista <?php echo $id ?></b></label>
                <input type="text" class="form-control" id="nombrePanelista<?php echo $id ?>" name="nombrePanelista<?php echo $id ?>" required>
            </div>
            <div class="form-group col-md-5">
                <label for="correoPanelista1"><b>Correo electrónico</b></label>
                <input type="text" class="form-control" id="correoPanelista<?php echo $id ?>" name="correoPanelista<?php echo $id ?>" required>
            </div>
            <div class="" style="margin: 30px 20px 0px 15px;  float: left;">
                <input type="checkbox" name="item_index" id="item_index" /><span> Borrar</span>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" id="cvPanelista<?php echo $id ?>" name="cvPanelista<?php echo $id ?>" rows="3" placeholder="Indique el cargo o curriculum del panelista" required></textarea>
        </div>
    </div>
<?php
} else {
    echo "Se ha presentado un problema cargando los campos";
}

?>