function funcionprecio(precio){
    var num = document.getElementById("cuantos").value;
    document.getElementById("precio_actual").innerHTML= "Total: "+parseInt(precio*num*100)/100+"€";
}

function comprarAJAX(form, pos){

    var xhr;
    if(XMLHttpRequest)
        xhr = new XMLHttpRequest();
    else
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    xhr.open('GET','ajaxfuncts.php?KEY=compra&pos='+pos+'&talla='+form.talla.value+'&cantidad='form.cantidad.value,true);

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById("compra_resultado").innerHTML = xhr.responseText;
        }
    }

    xhr.send('');

}