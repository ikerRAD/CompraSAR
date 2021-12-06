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
        <?php
            $filters="";
         $pos=str_contains($_GET['filters'],$_GET['ref-filtro']);
         if($pos === true){
             $filters=$_GET['filters'];
             $list=explode("0",$filters);
             $n=array_search($_GET['ref-filtro'],$list);
             unset($list[$n]);
             $list=array_values($list);
             $filters=implode("0",$list);
         }else{
             $filters=$_GET['filters']."0".$_GET['ref-filtro'];
         }
        if(isset($_GET['barra_de_busqueda'])){
            $pos=str_contains($_GET['filters'],$_GET['barra_de_busqueda']);
            if($pos === true){
                $filters=$_GET['filters'];
            }else{
                $filters=$filters."0".$_GET['barra_de_busqueda'];
            }
        }
            $filt=explode("0", $filters);
        ?>
        <ol id = "lista_filtrado">
            <li><a style="<?php if(array_search("H",$filt,true)){echo "color:grey";}?>" href=<?php echo "index.php?ref-filtro=H&filters=".$filters?> class="ref-filtro">Hombre</a></li>
            <li><a style="<?php if(array_search("M",$filt,true)){echo "color:grey";}?>" href=<?php echo "index.php?ref-filtro=M&filters=".$filters?> class="ref-filtro">Mujer</a></li>
            <li><a style="<?php if(array_search("U",$filt,true)){echo "color:grey";}?>" href=<?php echo "index.php?ref-filtro=U&filters=".$filters?> class="ref-filtro">Unisex</a></li>
            <li><a style="<?php if(array_search("A",$filt,true)){echo "color:grey";}?>" href=<?php echo "index.php?ref-filtro=A&filters=".$filters?> class="ref-filtro">Accesorios</a></li>
            <li><a style="<?php if(array_search("C",$filt,true)){echo "color:grey";}?>" href=<?php echo "index.php?ref-filtro=C&filters=".$filters?> class="ref-filtro">Calzado</a></li>
        </ol>
        <div class="busqueda">

            Busca tus artículos favoritos:
            <form action="index.php">
                <input type="hidden" name="filters" value=<?php echo $_GET['filters']?>>
                <input type="text" placeholder="Busca..." name="barra_de_busqueda">
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

                $match=0;

                $stock = simplexml_load_file("stock.xml");
                if(str_contains($_GET['filters'],$_GET['ref-filtro'])){
                    $list=explode("0",$filters);
                    $n=array_search($_GET['ref-filtro'],$list);
                    unset($list[$n]);
                    $list=array_values($list);
                    $filters=implode("0",$list);
                }
                $listFiltros=explode("0",$filters);

                foreach ($stock->item as $item){
                        $tags=$item['tags'];
                        $descrip=$item->descripcion;
                        $tags=explode("0",$tags);
                        for($i=0; $i<sizeof($tags); $i++){
                            if(array_search($tags[$i],$listFiltros,true)){
                                $match=1;
                                break;
                            }
                        }
                        for($i=0; $i<sizeof($listFiltros); $i++){
                            if(str_contains(strtolower($descrip),$listFiltros[$i])){
                                $match=1;
                                break;
                            }
                        }
                        if($match==1 || empty($listFiltros)){
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
                        $match=0;
                }
            }
            ?>
        </div>
        <?php include_once "footer.php";?>
	</body>
</html>
