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
                        echo "OK";
                    }
                }

            }
            break;
        case "envio":

            $toreturn = 'OK';

            if(strlen($_GET['ciudad'])<1){
                $toreturn = 'ciudad inválida';
            }
            $cp = "/[0-9]+/i";
            if(strlen($_GET['cp'])!=7 || preg_match($cp, $_GET['cp']) == 0){
                if($toreturn=='OK')
                    $toreturn = 'código postal inválido';
                else
                    $toreturn = $toreturn . ', código postal inválido';
            }
            if(strlen($_GET['dir'])<1){
                if($toreturn=='OK')
                    $toreturn = 'dirección inválida';
                else
                    $toreturn = $toreturn . ', dirección inválida';
            }
            echo $toreturn;
            break;
        case "pago":
            $toreturn = "";
            if(strlen($_GET['nombre'])<3 || preg_match("/[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s[a-zA-ZñÑáéíóúÁÉÍÓÚ\-]+.?)+/", $_GET['nombre']) == 0){
                $toreturn = "ERROR: nombre inválido";
            }
            $datesplit = preg_split("/\//",$_GET['date']);
            if(preg_match("/[0-9]{1,2}\/[0-9]{2}/", $_GET['date'])==0 || intval($datesplit[0])>12 || intval($datesplit[1])<intval(date("Y"))%100||
                (intval($datesplit[1])==intval(date("Y"))%100 && intval($datesplit[1])<intval(date("m")))){
                if($toreturn=='')
                    $toreturn = 'ERROR: fecha de caducidad inválida';
                else
                    $toreturn = $toreturn . ', fecha de caducidad inválida';
            }
            if(preg_match("/[0-9]{16}/", $_GET['tarjeta']) == 0){
                if($toreturn=='')
                    $toreturn = 'ERROR: número de tarjeta inválido';
                else
                    $toreturn = $toreturn . ', número de tarjeta inválido';
            }
            if(preg_match("/[0-9]{3}/", $_GET['cvc']) == 0){
                if($toreturn=='')
                    $toreturn = 'ERROR: número de seguridad inválido';
                else
                    $toreturn = $toreturn . ', número de seguridad inválido';
            }
            if($toreturn == ""){
                if (file_exists('stock.xml')) {
                    $stock = simplexml_load_file("stock.xml");
                    $item = $stock->item[intval($_GET['pos'])];
                    $pagado = round(intval($_GET['cant'])*($item->precio*(1-($item->descuento/100))),2);
                    $toreturn = 'Has comprado'.$_GET['cant'].' de '.$item->nombre.":<br> ".$pagado.'€ en total<br>'.'<a href="index.php"><button>seguir comprando</button></a>';
                }
            }

            echo $toreturn;

    }
?>