$(document).ready(function (){
    switch (window.location.href){
        case "http://localhost/TarjetasDeCredito/admin/Emisores/":
            sessionStorage.removeItem("emisor");
            $("#addEmisor").click(function (){
                window.location.replace("http://localhost/TarjetasDeCredito/admin/Emisores/crear.html");
            });
            getAllEmisores();
            break;
        case "http://localhost/TarjetasDeCredito/admin/Emisores/editar.html":
            if(sessionStorage.getItem("emisor")){
                cargarDatosEdicion(sessionStorage.getItem("emisor"));
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    editEmisor();
                });
            }
            break;
        case "http://localhost/TarjetasDeCredito/admin/Emisores/crear.html":
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                insertEmisor();
            });
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('emisor',$(this).val());
            window.location.replace("http://localhost/TarjetasDeCredito/admin/Emisores/editar.html");
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
        fetch('http://localhost/TarjetasDeCredito/app/emisores/all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <td>${data[i].id_emisor}</td>
                    <td>${data[i].nombre}</td>
                    <td>${data[i].descripcion}</td>   
                    <td><button type="button" class="btnEditar" value="${data[i].id_emisor}">Editar</button></td>
                    <td><button type="button" class="btnEliminar" value="${data[i].id_emisor}">Eliminar</button></td>
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
        fetch('http://localhost/TarjetasDeCredito/app/emisores/selectOneEmisores', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                $("#id").val(data.id_emisor);
                $("#nombre").val(data.nombre);
                $("#descripcion").val(data.descripcion);
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
        const data = new FormData();
        data.append('ID', id);
        data.append('nombre', nombre);
        data.append('descripcion', descripcion);
        fetch('http://localhost/TarjetasDeCredito/app/emisores/updateEmisor', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Emisor editado con exito!");
                window.location.replace("http://localhost/TarjetasDeCredito/admin/Emisores/");
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
    fetch('http://localhost/TarjetasDeCredito/app/emisores/deleteEmisor', {
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
    const data = new FormData();
    data.append('nombre', nombre);
    data.append('descripcion', descripcion);
    fetch('http://localhost/TarjetasDeCredito/app/emisores/insertEmisor', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Emisor ingresado correctamente!");
            window.location.replace("http://localhost/TarjetasDeCredito/admin/Emisores/");
        }else{
            console.log("error");
        }
    });
}