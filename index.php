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
            <img src="images/YourOutfitLogo.png"> <!--</div>-->
            <ol id = "lista_filtrado">
                <li>Hombre</li>
                <li>Mujer</li>
                <li>Unisex</li>
                <li>Accesorios</li>
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
                    <a class="buy-item" href="compra.php?compra_id=<?php echo $item['id'];?>">
                        <div class="item">
                            <div id ="item_img" name="item_img"><img src=<?php echo $item->imagen?>></div>
                            <div id="item_name" name="item_name"><?php echo $item->nombre ?> </div>
                            <?php
                            if($item->descuento == 0){
                               ?><div id="item_price" name="item_price"><?php echo $item->precio.'€'?> <?php
                            }
                            else{
                                ?>
                                <div id="item_price_d" name="item_disc"><?php echo $item->precio.'€'?></div><div id="item_disc"><?php echo round($item->precio*(1-($item->descuento/100)),2)?>€</div>
                                <div id="item_disc_tag">Descuento del <?php echo $item->descuento?>%</div>
                               <?php
                            }
                            ?>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>

	</body>
</html>
