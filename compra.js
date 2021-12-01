function funcionprecio(precio){
    var num = document.getElementById("cuantos").value;
    document.getElementById("precio_actual").innerHTML= "Total: "+parseInt(precio*num*100)/100+"€";
}