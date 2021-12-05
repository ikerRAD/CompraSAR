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
