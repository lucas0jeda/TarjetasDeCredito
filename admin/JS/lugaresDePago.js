$( document ).ready(function() {
    let link = window.location.href;
    const explode = link.split(".com");
    switch (explode[1]){
        case "/admin/LugaresDePago/editar.html":
            if(sessionStorage.getItem("lugarDePago")){
                cargarDatosEdicion(sessionStorage.getItem("lugarDePago"));
                $("#imagen").change(function(){
                    let file = this.files[0];
                    console.log(URL.createObjectURL(file));
                    $("#logoLugarDePago").attr("src", URL.createObjectURL(file));
                })
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    let validacion = validacion();
                    if(validacion){
                        editLugarDePago();
                    }
                });
            }
            break;
       case "/admin/LugaresDePago/crear.html":
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                let validacion = validacion();
                if(validacion){
                    insertLugarDePago();
                }
            });
            break;
        case "/admin/LugaresDePago/":
            sessionStorage.removeItem("lugarDePago");
            $("#addLugarDePago").click(function (){
                window.location.replace("/admin/LugaresDePago/crear.html");
            });
            getAllLugarDePago();
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('lugarDePago',$(this).val());
            window.location.replace("/admin/LugaresDePago/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar este lugar de pago?");
            if(confirmationDelete){
                deleteLugarDePago($(this).val());
            }
        });
    },2000);
});

function validacion(){
    let retorno = false;
    let nombre = $("#nombre").val();
    if(nombre != ""){
        retorno = true;
    }
    return retorno;

}

function getAllLugarDePago(){
    try{
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=lugarDePago&action=all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <td>${data[i].id_lugar_de_pago}</td>
                    <td>${data[i].Nombre}</td>
                    <td>${data[i].logo}</td>   
                    <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_lugar_de_pago}">Editar</button></td>
                    <td><button type="button" class="btnEliminar btn btn-primary" value="${data[i].id_lugar_de_pago}">Eliminar</button></td>
                <tr>`;
                }
                $('#dataLugaresDePagoBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function cargarDatosEdicion(idLugarDePago){
    try{
        const data = new FormData();
        data.append('ID', idLugarDePago);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=lugarDePago&action=selectOneLugarDePago', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                $("#id").val(data.id_lugar_de_pago);
                $("#nombre").val(data.Nombre);
                $("#logo").val(data.logo);
                let src = "/images/lugarDePagoImg/" + data.logo;
                $("#logoLugarDePago").attr("src", src);
                sessionStorage.setItem("logoActual", data.logo);
            }else{
                console.log("error")
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function editLugarDePago(){
    try{
        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let imagen = document.getElementById("imagen").files[0];
        let logoActual = sessionStorage.getItem("logoActual");
        const data = new FormData();
        data.append('ID', id);
        data.append('nombre', nombre);
        data.append('imagen', imagen);
        data.append("logoActual", logoActual);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=lugarDePago&action=updateLugarDePago', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            console.log(data);
            if(data){
                sessionStorage.removeItem("logoActual");
                alert("Lugar de pago editado con exito!");
                window.location.replace("/admin/LugaresDePago/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function deleteLugarDePago(idLugarDePago){
    const data = new FormData();
    data.append('ID', idLugarDePago);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=lugarDePago&action=deleteLugarDePago', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Lugar de pago eliminado con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function insertLugarDePago(){
    const data = new FormData();
    let nombre = $("#nombre").val();
    let imagen = document.getElementById("imagen").files[0];
    data.append('nombre', nombre);
    data.append('imagen', imagen);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=lugarDePago&action=insertLugarDePago', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Lugar de pago ingresado con exito!");
            window.location.replace("/admin/LugaresDePago/");
        }else{
            console.log("error");
        }
    });

}

function validacion(){
    let retorno = false;
    let nombre = $("#nombre").val();
    let imagen = $("#imagen").val();
    if(nombre != "" && imagen != ""){
        retorno = true;
    }
    return retorno;
}