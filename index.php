<!DOCTYPE html>
<html>
	<head>
		<title>YourOUTfit: Tienda online</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="index.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
        <div id="header">
            <a href="index.php">
                <img src="images/YourOutfitLogo.png"> <!--</div>-->
            </a>
            <ol id = "lista_filtrado">
                <li>Hombre</li>
                <li>Mujer</li>
                <li>Unisex</li>
                <li>Accesorios</li>
                <li>Calzado</li>
            </ol>
        </div>
        <div class="busqueda">
            <form action=#>
                <input type="text" placeholder="Busca..." name="barra_de_busqueda">
            </form>
        </div>
        <div class="content">
            <?php
            if (file_exists('stock.xml')) {
                $stock = simplexml_load_file("stock.xml");
                foreach ($stock->item as $item){
                    ?>
                    <div class="item">
                        <a class="buy-item" href="compra.php?compra_id=<?php echo $item['id'];?>">
                            <div class ="item_img"><img src=<?php echo $item->imagen;?>></div>
                            <div class ="item_name"><?php echo $item->nombre;?></div><?php

                            if($item->descuento == 0){
                               ?><div class ="item_price"><?php echo $item->precio.'€';
                            }
                            else{
                                ?>
                                <div class ="item_price_d"><?php echo $item->precio.'€';?></div><div class ="item_disc"><?php echo round($item->precio*(1-($item->descuento/100)),2);?>€</div>
                                <div class ="item_disc_tag">Descuento del <?php echo $item->descuento;?>%</div>
                               <?php
                            }
                            ?>
                            </div>
                        </a>
                    </div>

                    <?php
                }
            }
            ?>
        </div>

	</body>
</html>
