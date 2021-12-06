function funcionprecio(precio){
    var num = document.getElementById("cuantos").value;
    document.getElementById("precio_actual").innerHTML= "Total: "+parseInt(precio*num*100)/100+"€";
}

function funcion_resenya(item){
    var xhr;
    if(XMLHttpRequest)
        xhr = new XMLHttpRequest();
    else
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
  
    xhr.open('GET','ajaxfuncts.php?KEY=resenya&compra_id=' + item,true);

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById("añadir_resenya").innerHTML = xhr.responseText;
        }
    }
    xhr.send('');
}

function comprarAJAX(form, pos){
    var xhr;
    if(XMLHttpRequest)
        xhr = new XMLHttpRequest();
    else
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    xhr.open('GET','ajaxfuncts.php?KEY=compra&pos='+pos+'&talla='+form.talla[form.talla.selectedIndex].innerHTML+'&cantidad='+form.cantidad.value,true);

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){

            if(xhr.responseText === "OK") {
                document.getElementsByClassName("formulario_compra")[0].innerHTML = '<form action=#>\n' +
                    '                    Escribe tu dirección:\n' +
                    '                    <select name="país">\n' +
                    '                            <option value="Espanya">España</option>\n' +
                    '                            <option value="Francia">Francia</option>\n' +
                    '                            <option value="Italia">Italia</option>\n' +
                    '                    </select>\n' +
                    '                    <br>\n' +
                    '                    Escribe tu ciudad:\n' +
                    '                    <input type="text" name="ciudad" placeholder="tu ciudad..."> \n' +
                    '                    <br>\n' +
                    '                    Código postal:'+
                    '                    <input type="text" maxlength="7" name="cp" placeholder="código postal..."> \n' +
                    '                    <br> \n' +
                    '                    Dirección: \n' +
                    '                    <input type="text" name="dir" placeholder="dirección..."> \n' +
                    '                    <input type="button" name="boton" value="proseguir" onclick="enviar(this.form, '+pos+','+ form.cantidad.value+');">\n' +
                    '                </form>' +
                    '               <div id="envio_resultado"></div>' ;

            }else{
                document.getElementById("compra_resultado").innerHTML = xhr.responseText;
            }
        }
    }

    xhr.send('');
}


function enviar(f, pos, cantidad){

    var mal = false;
    if(f.ciudad.value.length<1){
        alert("introduce una ciudad posible");
        mal=true;
    }
    const pattern = /[0-9]+/;
    if(f.cp.value.length<7 || !pattern.test(f.cp.value)){
        alert("introduce un código postal válido");
        mal=true;
    }
    if(f.dir.value.length<1){
        alert("introduce una dirección válida");
        mal=true;
    }

    if(!mal){
        var xhr;
        if(XMLHttpRequest)
            xhr = new XMLHttpRequest();
        else
            xhr = new ActiveXObject("Microsoft.XMLHTTP");

        xhr.open('GET','ajaxfuncts.php?KEY=envio&ciudad='+f.ciudad.value+'&cp='+f.cp.value+'&dir='+f.dir.value,true);

        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                if(xhr.responseText==="OK"){
                    document.getElementsByClassName("formulario_compra")[0].innerHTML = '<form action=#>\n' +
                        'Propietario:'+
                        '                    <input type="text" name="nombre" placeholder="Nombre Apellidos"> \n' +
                        '                    <br>\n' +
                        'Número de tarjeta:'+
                        '                    <input type="text" name="number" maxlength="16" placeholder="xxxxxxxxxxxxxxxx" > \n' +
                        '                    <br> \n' +
                        'Válida hasta:'+
                        '                    <input type="text" name="caducidad" maxlength="5" placeholder="MM/YY"> \n' +
                        '                    <br> \n' +
                        'Número de seguridad:'+
                        '                    <input type="text" name="cvc" maxlength="3" placeholder="CVC"> \n' +
                        '                    <br> \n' +
                        '                    <input type="button" name="boton" value="finalizar" onclick="pagar(this.form, '+pos+','+ cantidad+');">\n' +
                        '                </form>' ;
                }else{
                    document.getElementById("envio_resultado").innerHTML = xhr.responseText;
                }
            }
        }

        xhr.send('');
    }

}

function pagar(f, pos, cantidad) {
    const cardpattern = /[0-9]{16}/;
    const cvcpattern = /[0-9]{3}/;
    const datepattern = /[0-9]{1,2}\/[0-9]{2}/;
    const name = /[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s[a-zA-ZñÑáéíóúÁÉÍÓÚ\-]+.?)+/;
    var mal = false;
    if(f.nombre.value.length<3 || !name.test(f.nombre.value) ){
        alert("nombre inválido");
        mal = true;
    }
    var today = new Date();
    if(!datepattern.test(f.caducidad.value) || parseInt(f.caducidad.value.split("/")[0])>12 || parseInt(f.caducidad.value.split("/")[1])<parseInt(today.getFullYear())%100 ||
        (parseInt(f.caducidad.value.split("/")[1])==parseInt(today.getFullYear())%100 && parseInt(f.caducidad.value.split("/")[0])<(parseInt(today.getMonth()) + 1))){
        alert("fecha inválida");
        mal=true;
    }
    if(!cardpattern.test(f.number.value)){
        alert("número de tarjeta inválido");
        mal=true;
    }
    if(!cvcpattern.test(f.cvc.value)){
        alert("número de seguridad inválido");
        mal=true;
    }

    if(!mal){
        var xhr;
        if(XMLHttpRequest)
            xhr = new XMLHttpRequest();
        else
            xhr = new ActiveXObject("Microsoft.XMLHTTP");

        xhr.open('GET','ajaxfuncts.php?KEY=pago&nombre='+f.nombre.value+'&date='+f.caducidad.value+'&tarjeta='+f.number.value+'&cvc='+f.cvc.value+'&pos='+pos+'&cant='+cantidad,true);

        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                if(xhr.responseText.split(" ")[0]==="ERROR:"){
                    document.getElementsByClassName("formulario_compra")[0].innerHTML = '<form action=#>\n' +
                        'Propietario:'+
                        '                    <input type="text" name="nombre" placeholder="Nombre Apellidos"> \n' +
                        '                    <br>\n' +
                        'Número de tarjeta:'+
                        '                    <input type="text" name="number" maxlength="16" placeholder="xxxxxxxxxxxxxxxx" > \n' +
                        '                    <br> \n' +
                        'Válida hasta:'+
                        '                    <input type="text" name="caducidad" maxlength="5" placeholder="MM/YY"> \n' +
                        '                    <br> \n' +
                        'Número de seguridad:'+
                        '                    <input type="text" name="cvc" maxlength="3" placeholder="CVC"> \n' +
                        '                    <br> \n' +
                        '                    <input type="button" name="boton" value="finalizar" onclick="pagar(this.form, '+pos+','+ cantidad+');">\n' +
                        '                </form>' +
                        '                <div class="error_pago">'+xhr.responseText.substring(7)+'</div>' ;
                }else{
                    document.getElementsByClassName("formulario_compra")[0].innerHTML = xhr.responseText;
                }
            }
        }

        xhr.send('');
    }

}

function ValidarForm(f, id)
{
// Leer valores del formulario
    var nombre = f.nombre.value;
    var puntuacion = f.puntuacion.value;
    var titulo = f.titulo.value;
    var comentario = f.comentario.value;
    var error = "";
// Verificar que los campos obligatorios están rellenados
    if(nombre=="")
        error += "\tTu nombre es obligatorio!\n";
    if(titulo=="")
        error += "\tEl título es obligatorio\n";
    if(comentario=="")
        error += "\tNo has introducido ningún comentario!\n";
// Si hay algún error, mostrar el mensaje
    if(error != "")
    {
        alert("Validación del formulario:\n" + error);
        return false;
    }
    else
        return true;
}

