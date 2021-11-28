
document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        loadNavbar();
    }
}

function loadNavbar(){
    $("#header").load("http://localhost/TarjetasDeCredito/admin/layout/nav.html");
}
