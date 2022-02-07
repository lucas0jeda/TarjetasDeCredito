$(document).ready(function (){
    switch (window.location.href){
        case "http://localhost/TarjetasDeCredito/admin/Sellos/":
            sessionStorage.removeItem("sello");
           $("#addSello").click(function (){
                window.location.replace("http://localhost/TarjetasDeCredito/admin/Sellos/crear.html");
            });
            getAllSellos();
            break;
        case "http://localhost/TarjetasDeCredito/admin/Sellos/editar.html":
            if(sessionStorage.getItem("sello")){
                cargarDatosEdicion(sessionStorage.getItem("sello"));
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    editSello();
                });
            }
            break;
        case "http://localhost/TarjetasDeCredito/admin/Sellos/crear.html":
            console.log("ok");
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                insertSello();
            });
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('sello',$(this).val());
            window.location.replace("http://localhost/TarjetasDeCredito/admin/Sellos/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar esta sello?");
            if(confirmationDelete){
                deleteSello($(this).val());
            }
        });
    },2000);
});

function getAllSellos(){
    try{
        fetch('http://localhost/TarjetasDeCredito/app/sellos/all')
            .then(response => response.json())
            .then(data => {
                if(typeof data === 'object'){
                    let output = '';
                    for(let i in data){
                        output += `<tr>
                        <td>${data[i].id_sello}</td>
                        <td>${data[i].nombre}</td>
                        <td>${data[i].descripcion}</td>   
                        <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_sello}">Editar</button></td>
                        <td><button type="button" class="btnEliminar btn btn-primary" value="${data[i].id_sello}">Eliminar</button></td>
                    <tr>`;
                    }
                    $('#dataSelloBodyTable').html(output);
                }else{
                    console.log("error");
                }
            })
    }catch (e) {
        console.log(e);
    }
}

function cargarDatosEdicion(idSello){
    try{
        const data = new FormData();
        data.append('ID', idSello);
        fetch('http://localhost/TarjetasDeCredito/app/sellos/selectOneSello', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                console.log(data);
                $("#id").val(data.id_sello);
                $("#nombre").val(data.nombre);
                $("#descripcion").val(data.descripcion);
                let src = "http://localhost/TarjetasDeCredito/images/sellosImg/" + data.logo;
                $("#logoSello").attr("src", src);
                sessionStorage.setItem("logoActual", data.logo);
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function editSello(){
    try{
        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let desc = $("#descripcion").val();
        let imagen = document.getElementById("imagen").files[0];
        let logoActual = sessionStorage.getItem("logoActual");
        const data = new FormData();
        data.append('ID', id);
        data.append('nombre', nombre);
        data.append('desc', desc);
        data.append('imagen', imagen);
        data.append("logoActual", logoActual);
        fetch('http://localhost/TarjetasDeCredito/app/sellos/updateSello', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                sessionStorage.removeItem("logoActual");
                alert("Sello editado con exito!");
                window.location.replace("http://localhost/TarjetasDeCredito/admin/Sellos/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function deleteSello(id){
    const data = new FormData();
    data.append('ID', id);
    fetch('http://localhost/TarjetasDeCredito/app/sellos/deleteSello', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Sello eliminada con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function insertSello(){
    let nombre = $("#nombre").val();
    let descripcion = $("#descripcion").val();
    let imagen = document.getElementById("imagen").files[0];
    const data = new FormData();
    data.append('nombre', nombre);
    data.append('descripcion', descripcion);
    data.append('imagen', imagen);
    fetch('http://localhost/TarjetasDeCredito/app/sellos/insertSello', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Sello Ingresada correctamente!");
            window.location.replace("http://localhost/TarjetasDeCredito/admin/Sellos/");
        }else{
            console.log("error");
        }
    });
}