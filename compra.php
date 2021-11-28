<?php

if(isset($_GET['compra_id'])){
    if(file_exists('stock.xml')){
        $stock = simplexml_load_file("stock.xml");
        $pos =  intval(preg_split('/_/',$_GET['compra_id'])[1]);
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>PG3: Comprar <?php echo $stock->item[$pos]->nombre;?></title>
            <meta charset="UTF-8">
            <script type="text/javascript" src="compra.js"></script>
            <link rel="stylesheet" type="text/css" href="compra.css">
        </head>
        <body><?php
        $tobuy = $stock->item[$pos];
        $toecho = '<h1>'.$tobuy->nombre.'</h1><h3>'.$tobuy->descripcion.'</h3>';
        $toecho = $toecho.'<div class="item_img"><img src="'.$tobuy->imagen.'"></div>'.'<div class="price">'.$tobuy->precio.'€</div>';
        echo $toecho;
        ?>
        <div class="formulario_compra">
            <form action=#>
                Elige la talla:
                <select name=”talla”>
                    <?php
                    foreach ($tobuy->tallas as $tallas){
                        echo '<option value="'.$tallas->talla.'">'.$tallas->talla.'</option>';
                    }
                    ?>
                </select>
                Elige la cantidad:
                <input type="number" id="cuantos" min="1" max="100" name="cantidad" placeholder="1" onchange="funcionprecio(<?php echo $tobuy->precio; ?>);">
                <input type="button" name="boton" value="comprar ya!" onclick="submit();">
            </form>
            <div id="precio_actual"><?php echo $tobuy->precio; ?>€</div>
        </div>
        <php?

        ?>
        <p class="resenyas" >
            Reseñas de los Ususarios:
        </p>
        <?php

        foreach ($tobuy->resenyas as $resenyas){
            $toecho = '<div class="resenya"><div class="userfecha"><span class="username">'.$resenyas->username.'</span><span class="fecha">'.$resenyas->fecha.'</span></div>';
            $toecho = $toecho.'<div class="valoracion">'.$resenyas->valoracion.'/100</div><div class="titulo">'.$resenyas->titulo.'</div><div class="cometario">'.$resenyas->resenya.'</div></div>';
                echo $toecho;
              }

        ?>
        <a href="index.php">
            <button>volver a la tienda</button>
        </a>
        </body>
        </html>
        <?php
    }
}?>