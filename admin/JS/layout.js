
document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        loadNavbar();
    }
}

function loadNavbar(){
    $("#header").load("/admin/layout/nav.html");
}
