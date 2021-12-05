<?php
if(isset($_GET['KEY']))
    switch ($_GET['KEY']) {
        case "resenya":
            echo '<div id="form_nuevocoment" >
                    <form  action="compra.php" >
                        Nombre: <input type="text" name="nombre">
                        Puntuación: <input type="number" onkeydown="return false;" value="0" min="0" max="5" name="puntuacion"> <br>
                        Título: <input type="text" name="titulo"> <br>
                        Comentario: <br>
                        <textarea name="comentario" rows="5" cols="100"></textarea><br>
                        <input type="submit" onclick="return ValidarForm(this.form);">
                        <input type="hidden" name="compra_id" value="'.$_GET['compra_id'].'">
                        <input type="hidden" name="subir" value="o">
                    </form>
                </div>';
            break;
    }

?>