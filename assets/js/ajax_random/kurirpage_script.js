// order script ajax
function order_num() {
    var numsc = document.getElementById("nums_coun");

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            if(numsc !== null){
                numsc.innerHTML = xhr.responseText;
            }
        }
    }

    xhr.open('GET', 'kurirui/nums_coun', true);
    xhr.send();
}

// order message script ajax
function order_mes() {
    var ordern = document.getElementById("order_notif");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            if(ordern !== null){
                ordern.innerHTML = xhr.responseText;
            }
        }
    }

    xhr.open('GET', 'kurirui/order_kurir_num', true);
    xhr.send();
}

// tabungan script ajax
function dttabungan() {
    var tb = document.getElementById("tabungan_kurir");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            if(tb !== null){
                tb.innerHTML = xhr.responseText;
            }
        }
    }

    xhr.open('GET', 'kurirui/data_tabungan', true);
    xhr.send();
}

// total order script ajax
function torder() {
    var to = document.getElementById("total_order");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            if(to !== null){
                to.innerHTML = xhr.responseText;
            }
        }
    }

    xhr.open('GET', 'kurirui/total_order', true);
    xhr.send();
}

// total penjualan perhari script ajax
function penorder() {
    var tp = document.getElementById("pen_jul_har");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            if(tp !== null){
                tp.innerHTML = xhr.responseText;
            }
        }
    }

    xhr.open('GET', 'kurirui/data_pen_har', true);
    xhr.send();
}

// total penjualan perbulan script ajax
function penorderb() {
    var tb = document.getElementById("total_jul_bun");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            if(tb !== null){
                tb.innerHTML = xhr.responseText;
            }
        }
    }

    xhr.open('GET', 'kurirui/data_pen_bun', true);
    xhr.send();
}

setInterval(function(){
    order_mes(),
    order_num(),
    torder(),
    dttabungan(),
    penorder(),
    penorderb()
}, 5000);