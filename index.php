<!DOCTYPE html>
<html>
	<head>
		<title>PG3: Tienda</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="index.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1>Tienda de ropa</h1>
        <div class="busqueda">
            <form action=#>
                <input type="text" placeholder="Busca..." name="barra_de_busqueda">
            </form>
        </div>
        <div class="filtros">
            <ol id = "lista_filtrado">
                <li>filtro1</li>
                <li>filtro2</li>
                <li>filtro3</li>
                <li>filtro4</li>
                <li>filtro5</li>
            </ol>
        </div>
        <div class="content">
            <?php
            if(file_exists('stock.xml')){
                $stock = simplexml_load_file("stock.xml");

                foreach ($stock->item as $item){
                    $img_path = $item->imagen;
                    $nombre = $item->nombre;
                    $desc = $item->descripcion;
                    $precio = $item->precio;?>

                    <div class="item">
                        <?php
                        $inner = '<div class="item_img"><img src="'.$img_path.'"></div>';
                        $inner = $inner.'<div class="item_price">'.$precio.'€</div>';
                        $inner = $inner.'<div class="item_name">'.$nombre.'</div>';
                        $inner = $inner.'<div class="item_desc">'.$desc.'</div>';
                        echo $inner;
                        ?>
                    </div>

                <?php
                }
            }
            ?>
        </div>

	</body>
</html>