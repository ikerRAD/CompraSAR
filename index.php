
<?php
function filtrado($filtraje,$tags, $a_filtrar1, $a_filtrar2){
    $tags2 = str_split($tags);
    $len = count($filtraje);
    $nuevofiltraje = "";
    for($i=1;$i<$len;$i++){
        $nuevofiltraje=$nuevofiltraje." ".$filtraje[$i];
    }
    $nuevofiltraje = strtolower(ltrim($nuevofiltraje));

    for($i=0;$i<strlen($tags);$i++) {
        if (strpos(' ' . $filtraje[0], $tags2[$i])) {
            if($len==1) {
                return true;
            }else{
                if(preg_match('/'.$nuevofiltraje.'/', strtolower(ltrim($a_filtrar1)))){
                    return true;
                }

                if(preg_match('/'.$nuevofiltraje.'/', strtolower(ltrim($a_filtrar2)))){
                    return true;
                }
            }
        }
    }

    return false;
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>YourOUTfit: Tienda online</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="js/index.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body <?php if(isset($_GET['orden'])){
                    switch ($_GET['orden']){
                        case "AZ":
                            echo 'onload="ordenar(1);"';
                            break;
                        case "ZA":
                            echo 'onload="ordenar(2);"';
                            break;
                        case "09":
                            echo 'onload="ordenar(3);"';
                            break;
                        case "90":
                            echo 'onload="ordenar(4);"';
                            break;
                    }
                } ?>>

        <?php include_once "header.php";?>
        <?php
            $filters="";
            $H="";
            $M="";
            $U="";
            $A="";
            $C="";
            if(isset($_GET['filters'])){
                 $filters = $_GET['filters'];
                 for($i=0;$i<strlen($filters);$i++){
                     if($filters[$i] == "M"){
                         $H=$H.$filters[$i];
                         $U=$U.$filters[$i];
                         $A=$A.$filters[$i];
                         $C=$C.$filters[$i];
                     }else if($filters[$i] == "H"){

                         $M=$M.$filters[$i];
                         $U=$U.$filters[$i];
                         $A=$A.$filters[$i];
                         $C=$C.$filters[$i];
                     }else if($filters[$i] == "U"){
                         $H=$H.$filters[$i];
                         $M=$M.$filters[$i];
                         $A=$A.$filters[$i];
                         $C=$C.$filters[$i];
                     }else if($filters[$i] == "A"){
                         $H=$H.$filters[$i];
                         $M=$M.$filters[$i];
                         $U=$U.$filters[$i];
                         $C=$C.$filters[$i];
                     }else if($filters[$i] == "C"){
                         $H=$H.$filters[$i];
                         $M=$M.$filters[$i];
                         $U=$U.$filters[$i];
                         $A=$A.$filters[$i];
                     }
                 }
            }
            $orden = "";
            $busq = "";
            if(isset($_GET['orden'])){
                $orden = "&orden=".$_GET['orden'];
            }
            if(isset($_GET['barra_de_busqueda'])){
                $busq = "&barra_de_busqueda=".$_GET['barra_de_busqueda'];
            }
        ?>
        <ol id = "lista_filtrado">
            <li><a style="<?php if(strpos(' '.$filters,"H")){echo "color:grey";}?>" href="<?php if(strpos(' '.$filters,"H"))echo "index.php?filters=".$H.$orden.$busq; else echo "index.php?filters=H".$H.$orden.$busq;?>" class="ref-filtro">Hombre</a></li>
            <li><a style="<?php if(strpos(' '.$filters,"M")){echo "color:grey";}?>" href="<?php if(strpos(' '.$filters,"M"))echo "index.php?filters=".$M.$orden.$busq; else echo "index.php?filters=M".$M.$orden.$busq;?>" class="ref-filtro">Mujer</a></li>
            <li><a style="<?php if(strpos(' '.$filters,"U")){echo "color:grey";}?>" href="<?php if(strpos(' '.$filters,"U"))echo "index.php?filters=".$U.$orden.$busq; else echo "index.php?filters=U".$U.$orden.$busq;?>" class="ref-filtro">Unisex</a></li>
            <li><a style="<?php if(strpos(' '.$filters,"A")){echo "color:grey";}?>" href="<?php if(strpos(' '.$filters,"A"))echo "index.php?filters=".$A.$orden.$busq; else echo "index.php?filters=A".$A.$orden.$busq;?>" class="ref-filtro">Accesorios</a></li>
            <li><a style="<?php if(strpos(' '.$filters,"C")){echo "color:grey";}?>" href="<?php if(strpos(' '.$filters,"C"))echo "index.php?filters=".$C.$orden.$busq; else echo "index.php?filters=C".$C.$orden.$busq;?>" class="ref-filtro">Calzado</a></li>
        </ol>
        <div class="busqueda">

            Busca tus artículos favoritos:
            <form action="index.php">
                <input type="hidden" name="filters" value=<?php echo $filters;?>>
                <input type="text" placeholder="Busca..." <?php if(isset($_GET['barra_de_busqueda'])){echo 'value="'.$_GET['barra_de_busqueda'].'"';} ?> name="barra_de_busqueda">
                <?php if(isset($_GET['orden'])){ echo '<input type="hidden" name="orden" value='.$_GET['orden'];} ?>
            </form>

            <div class = "orden">
                Ordenar por:
                <ol id = "lista_ordenado">
                    <li><a href="index.php?orden=AZ&filters=<?php echo $filters; if(isset($_GET['barra_de_busqueda'])){echo $busq;}?>" class="ref-orden">A-Z</a></li>
                    <li><a href="index.php?orden=ZA&filters=<?php echo $filters; if(isset($_GET['barra_de_busqueda'])){echo $busq;}?>" class="ref-orden">Z-A</a></li>
                    <li><a href="index.php?orden=09&filters=<?php echo $filters; if(isset($_GET['barra_de_busqueda'])){echo $busq;}?>" class="ref-orden">Precio: mayor a menor</a></li>
                    <li><a href="index.php?orden=90&filters=<?php echo $filters; if(isset($_GET['barra_de_busqueda'])){echo $busq;}?>" class="ref-orden">Precio: menor a mayor</a></li>
                </ol>
            </div>

        </div>
        <div id="content">
            <?php
            if (file_exists('datos/stock.xml')) {


                $stock = simplexml_load_file("datos/stock.xml");
                if(!isset($_GET['filters'])) {
                    $filters="HMUAC";
                }else if($_GET['filters']==""){
                    $filters="HMUAC";
                }
                if(isset($_GET['barra_de_busqueda'])){
                    $filters=$filters." ".$_GET['barra_de_busqueda'];
                }
                $listFiltros = preg_split("/\s/",$filters);
                foreach ($stock->item as $item){
                        $tags=$item['tags'];
                        $descrip=$item->descripcion;
                        $nombre=$item->nombre;

                        if(filtrado($listFiltros, $tags, $nombre, $descrip)){
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
            }
            ?>
        </div>
        <?php include_once "footer.php";?>
	</body>
</html>
