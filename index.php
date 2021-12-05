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
            <form action=#>
                <input type="text" placeholder="Busca..." name="barra_de_busqueda">
            </form>

            <div class = "orden">Ordenar por:
                <ol id = "lista_ordenado">
                    <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-orden">A-Z</a></li>
                    <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-orden">Z-A</a></li>
                    <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-orden">Precio: mayor a menor</a></li>
                    <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-orden">Precio: menor a mayor</a></li>
                    <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-orden">Descuento: mayor a menor</a></li>
                    <li><a href="https://shangay.com/wp-content/uploads/2021/08/preview-26.jpg" class="ref-orden">Descuento: menor a mayor</a></li>
                </ol>
            </div>

        </div>
        <div class="content">
            <?php
            if (file_exists('stock.xml')) {
                $e = 0;
                $stock = simplexml_load_file("stock.xml");
                foreach ($stock->item as $item){
                    ?>
                    <div class="item">
                        <a class="buy-item" href="compra.php?compra_id=<?php echo $item['id'];?>">
                            <div class ="item_img"><img src=<?php echo $item->imagen;?>></div>
                            <div class ="item_name"><?php echo $item->nombre;?></div><?php

                            if($item->descuento == 0){
                               ?><div class ="item_price"><?php echo $item->precio.'€';?></div><?php
                            }
                            else{
                                ?>
                                <div class ="item_price_d"><?php echo $item->precio.'€';?></div><div class ="item_disc"><?php echo round($item->precio*(1-($item->descuento/100)),2);?>€</div>
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
