<?php

if(isset($_GET['compra_id'])){
    if(file_exists('stock.xml')){
        $stock = simplexml_load_file("stock.xml");
        $pos =  intval(preg_split('/_/',$_GET['compra_id'])[1]);
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>YourOUTfit: Comprar <?php echo $stock->item[$pos]->nombre;?></title>
            <meta charset="UTF-8">
            <script type="text/javascript" src="compra.js"></script>
            <link rel="stylesheet" type="text/css" href="compra.css">
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <?php include_once "header.php";?>
            <div class="item">
                    <div class ="item_img"><img src=<?php echo $stock->item[$pos]->imagen;?>></div>
                    <div class ="item_name"><?php echo $stock->item[$pos]->nombre;?></div><?php

                    if($stock->item[$pos]->descuento == 0){
                    ?><div class ="item_price"><?php echo $stock->item[$pos]->precio.'€';?></div><?php
                    }
                    else{
                        ?>
                        <div class ="item_price_d"><?php echo $stock->item[$pos]->precio.'€';?></div><div class ="item_disc"><?php echo round($stock->item[$pos]->precio*(1-($stock->item[$pos]->descuento/100)),2);?>€</div>
                        <div class ="item_disc_tag">Descuento del <?php echo $stock->item[$pos]->descuento;?>%</div>
                        <?php
                    }
                    ?>

                    <div class ="item_desc"><?php echo $stock->item[$pos]->descripcion;?></div>

            </div>

            <div class="formulario_compra">
                <form action=#>
                    Elige la talla:
                    <select name=”talla”>
                        <?php
                        foreach ($stock->item[$pos]->tallas as $tallas){
                            echo '<option value="'.$tallas->talla.'">'.$tallas->talla.'</option>';
                        }
                        ?>
                    </select>
                    <br><br>
                    Elige la cantidad:
                    <br><br>
                    <input type="number" id="cuantos" min="1" max="100" name="cantidad" placeholder="1" onchange="funcionprecio(<?php echo round($stock->item[$pos]->precio*(1-($stock->item[$pos]->descuento/100)), 2); ?>);">
                    <input type="button" name="boton" value="Comprar ya!" onclick="comprarAJAX(this.form, <?php echo $pos;?>);">
                </form>
                <div id="precio_actual">Total: <?php echo round($stock->item[$pos]->precio*(1-($stock->item[$pos]->descuento/100)), 2); ?>€</div>
                <div id="compra_resultado"></div>
            </div>



            <div class="resenyas" >
                <div class="titulo_reseñas">Reseñas de los usuarios:</div>
            <?php

            foreach ($stock->item[$pos]->resenyas as $resenyas){
                $toecho = '<div class="resenya"><div class="userfecha"><span class="username">'.$resenyas->username.'</span><span class="fecha">'.$resenyas->fecha.'</span></div>';
                $toecho = $toecho.'<div class="valoracion">'.$resenyas->valoracion.'/100</div><div class="titulo">'.$resenyas->titulo.'</div><div class="comentario">'.$resenyas->resenya.'</div></div>';
                    echo $toecho;
                  }

            ?>
            </div>
        </body>
        <?php include_once "footer.php";?>
        </html>
        <?php
    }
}?>