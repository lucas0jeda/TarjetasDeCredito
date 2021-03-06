document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        let formularioLogin = document.getElementById('loginForm');
        formularioLogin.addEventListener('submit', function(e){
            e.preventDefault();
            login(formularioLogin);
        })
    }
}

function login(formularioLogin){
    try{
        let datos = new FormData(formularioLogin);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=admin&action=login',{
            method: "POST",
            body: datos
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                sessionStorage.setItem('admin',data.usuario);
                window.location.replace("http://www.tarjetasdecredito.com.uy/admin/dashboard.html");
            }else{
                console.log("error");
            }
        })
    }catch(e){
        console.log(e);
    }
}
