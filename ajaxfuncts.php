<?php
if(isset($_GET['KEY']))
    switch ($_GET['KEY']) {
        case "resenya":
            echo "i es igual a 0";
            break;

        case "compra":
            if (file_exists('stock.xml')) {
                $stock = simplexml_load_file("stock.xml");
                $item = $stock->item[intval($_GET['pos'])];
                $total_stock = 0;
                $my_stock = 0;
                foreach ($item->tallas as $tallas){

                    if($tallas->talla == $_GET['talla']){
                        $my_stock = $tallas->cantidad;
                    }
                    $total_stock = $total_stock + $tallas->cantidad;
                }

                if($total_stock == 0){
                    echo "No nos queda stock de este artículo, vuelva otro día";
                }else if($my_stock == 0){
                    echo "No nos queda stock de esta talla, seleccione otra";
                }else{
                    if($my_stock-intval($_GET['cantidad'])<0){
                        echo "No nos queda tanto stock de esta talla, seleccione menos";
                    }else{
                        echo "Enhorabuena! Ha comprado con éxito ".$_GET['cantidad'].' de '.$item->nombre;
                    }
                }

            }
            break;
    }
?>