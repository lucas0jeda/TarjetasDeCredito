$(document).ready(function (){
    let link = window.location.href;
    const explode = link.split(".com.uy");
    switch (explode[1]){
        case "/admin/Emisores/":
            sessionStorage.removeItem("emisor");
            $("#addEmisor").click(function (){
                window.location.replace("http://www.tarjetasdecredito.com.uy/admin/Emisores/crear.html");
            });
            getAllEmisores();
            break;
        case "/admin/Emisores/editar.html":
            if(sessionStorage.getItem("emisor")){
                $("#imagen").change(function(){
                    let file = this.files[0];
                    console.log(URL.createObjectURL(file));
                    $("#logoEmisor").attr("src", URL.createObjectURL(file));
                })
                cargarDatosEdicion(sessionStorage.getItem("emisor"));
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    let validation =  validacion();
                    if(validation){
                        editEmisor();
                    }
                });
            }
            break;
        case "/admin/Emisores/crear.html":
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                let validation =  validacion();
                if(validation){
                    insertEmisor();
                }
            });
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('emisor',$(this).val());
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/Emisores/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar este emisor?");
            if(confirmationDelete){
                deleteEmisor($(this).val());
            }
        });
    },2000);
});


function getAllEmisores(){
    try{
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=emisores&action=all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <td>${data[i].id_emisor}</td>
                    <td>${data[i].nombre}</td>
                    <td>${data[i].descripcion.slice(0, -450) + " ..."}</td>   
                    <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_emisor}">Editar</button></td>
                    <td><button type="button" class="btnEliminar btn btn-primary" value="${data[i].id_emisor}">Eliminar</button></td>
                <tr>`;
                }
                $('#dataEmisorBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function cargarDatosEdicion(idEmisor){
    try{
        const data = new FormData();
        data.append('ID', idEmisor);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=emisores&action=selectOneEmisores', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                console.log(data);
                $("#id").val(data.id_emisor);
                $("#nombre").val(data.nombre);
                $("#descripcion").val(data.descripcion);
                let src = "/images/emisorImg/logos/" + data.logo;
                $("#logoEmisor").attr("src", src);
                sessionStorage.setItem("logoActual", data.logo);
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function editEmisor(){
    try{
        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let imagen = document.getElementById("imagen").files[0];
        let logoActual = sessionStorage.getItem("logoActual");
        const data = new FormData();
        data.append('ID', id);
        data.append('nombre', nombre);
        data.append('descripcion', descripcion);
        data.append('imagen', imagen);
        data.append("logoActual", logoActual);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=emisores&action=updateEmisor', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                sessionStorage.removeItem("logoActual");
                alert("Emisor editado con exito!");
                window.location.replace("http://www.tarjetasdecredito.com.uy/admin/Emisores/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function deleteEmisor(idEmisor){
    const data = new FormData();
    data.append('ID', idEmisor);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=emisores&action=deleteEmisor', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Emisor eliminado con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function insertEmisor(){
    let nombre = $("#nombre").val();
    let descripcion = $("#descripcion").val();
    let imagen = document.getElementById("imagen").files[0];
    const data = new FormData();
    data.append('nombre', nombre);
    data.append('descripcion', descripcion);
    data.append('imagen', imagen);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=emisores&action=insertEmisor', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Emisor ingresado correctamente!");
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/Emisores/");
        }else{
            console.log("error");
        }
    });
}

function validacion(){
    let retorno = false;
    let nombre = $("#nombre").val();
    let descripcion = $("#descripcion").val();
    let imagen = $("#imagen").val();
    if(nombre != "" && descripcion != "" && imagen != ""){
        retorno = true;
    }
    return retorno;
}