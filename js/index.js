
function listaPorPrecioAscendente() {
    var content = document.getElementById("content").getElementsByClassName("item");
    var list = new Array(content.length);
    var i, j, k, item;
    for (i = 0; i < content.length; i++) {
        item = content[i];
        j = 0;
        finish = false;
        while (j < i && !finish) {
            if (parseFloat(item.getElementsByClassName("buy-item")[0].getElementsByClassName("actual_price")[0].innerHTML) <
                parseFloat(list[j].getElementsByClassName("buy-item")[0].getElementsByClassName("actual_price")[0].innerHTML)) {
                j++;
            }
            else {
                finish = true;
            }
        }
        for (k = i; k > j; k--) {
            list[k] = list[k-1];
        }
        list[j] = item;
    }
    for (i = 0; i < list.length; i++) {
        console.log(list[i].getElementsByClassName("buy-item")[0].getElementsByClassName("actual_price")[0]);
    }
    return list;
}

function listaPorPrecioDescendente() {
    return listaPorPrecioAscendente().reverse();
}

function listaPorNombreAscendente() {
    var content = document.getElementById("content").getElementsByClassName("item");
    var list = new Array(content.length);
    var i, j, k, item;
    for (i = 0; i < content.length; i++) {
        item = content[i];
        j = 0;
        finish = false;
        while (j < i && !finish) {
            if ((item.getElementsByClassName("buy-item")[0].getElementsByClassName("item_name")[0].innerHTML).localeCompare
            (list[j].getElementsByClassName("buy-item")[0].getElementsByClassName("item_name")[0].innerHTML) == 1) {
                j++;
            }
            else {
                finish = true;
            }
        }
        for (k = i; k > j; k--) {
            list[k] = list[k-1];
        }
        list[j] = item;
    }
    for (i = 0; i < list.length; i++) {
        console.log(list[i].getElementsByClassName("buy-item")[0].getElementsByClassName("actual_price")[0]);
    }
    return list;
}

function listaPorNombreDescendente() {
    return listaPorNombreAscendente().reverse();
}

function ordenar(tipo) {
    var s = "";
    var l;
    switch (tipo) {
        case 1:
            l = listaPorNombreAscendente();
            break;
        case 2:
            l = listaPorNombreDescendente()
            break;
        case 3:
            l = listaPorPrecioAscendente();
            break;
        case 4:
            l = listaPorPrecioDescendente();
            break;
        case 5:
            break;
    }
    var i;
    for (i = 0; i < l.length; i++) {
        s += "<div class=\"item\">" + l[i].innerHTML + "</div>";
    }
    document.getElementById("content").innerHTML = s;
}




