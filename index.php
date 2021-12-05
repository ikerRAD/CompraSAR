<!DOCTYPE html>
<html>
	<head>
		<title>YourOUTfit: Tienda online</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="index.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

        <?php include_once "header.php";?>

        <ol id = "lista_filtrado">
            <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-filtro">Hombre</a></li>
            <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-filtro">Mujer</a></li>
            <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-filtro">Unisex</a></li>
            <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-filtro">Accesorios</a></li>
            <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-filtro">Calzado</a></li>
        </ol>

        <div class="busqueda">
            Busca tus artículos favoritos:
            <form action=#>
                <input type="text" placeholder="Escribe..." name="barra_de_busqueda">
            </form>

            <div class = "orden">
                Ordenar por:
                <ol id = "lista_ordenado">
                    <li><a href="#" onclick=ordenar(1) class="ref-orden">A-Z</a></li>
                    <li><a href="#" onclick=ordenar(2) class="ref-orden">Z-A</a></li>
                    <li><a href="#" onclick=ordenar(3) class="ref-orden">Precio: mayor a menor</a></li>
                    <li><a href="#" onclick=ordenar(4) class="ref-orden">Precio: menor a mayor</a></li>
                </ol>
            </div>

        </div>
        <div id="content">
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
                               ?><div class ="item_price"><span class="actual_price"><?php echo $item->precio;?></span>€</div><?php
                            }
                            else{
                                ?>
                                <div class ="item_price_d"><?php echo $item->precio.'€';?></div><div class ="item_disc"><span class="actual_price"><?php echo round($item->precio*(1-($item->descuento/100)),2);?></span> €</div>
                                <div class ="item_disc_tag">Descuento del <?php echo $item->descuento;?>%</div>
                               <?php
                            }
                            ?>
                        </a>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
        <?php include_once "footer.php";?>
	</body>
</html>
