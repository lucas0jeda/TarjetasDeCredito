$(document).ready(function() {
    let link = window.location.href;
    const explode = link.split(".com");
    switch (explode[1]){
        case "/admin/SegurosTarjeta/":
            sessionStorage.removeItem("SeguroID");
            $("#addSeguro").click(function (){
                window.location.replace("/admin/SegurosTarjeta/crear.html");
            });
            getAllSeguros();
            break;
        case "/admin/SegurosTarjeta/editar.html":
            if(sessionStorage.getItem("SeguroID")){
                cargarDatosEdicion(sessionStorage.getItem("SeguroID"));
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    let validacion = validacion();
                    if(validacion){
                        editSeguro();
                    }
                });
            }
            break;
        case "/admin/SegurosTarjeta/crear.html":
            getAllCards();
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                let validacion = validacion();
                if(validacion){
                    insertSeguros();
                }
            });
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('SeguroID',$(this).val());
            window.location.replace("/admin/SegurosTarjeta/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar este seguro?");
            if(confirmationDelete){
                deleteSeguro($(this).val());
            }
        });
    },2000);
});

function validacion(){
    let retorno = false;
    let titulo = $("#titulo_seguro").val();
    if(titulo != ""){
        retorno = true;
    }
    return retorno;
}

function insertSeguros(){
    try{
        let idTarjeta = $("#tarjeta").val();
        let titulo = $("#titulo_seguro").val();
        let desc = $("#desc").val();
        let informacionAdicional = $("#informacion").val();
        let data = new FormData();
        data.append('idTarjeta', idTarjeta);
        data.append('titulo', titulo);
        data.append('desc', desc);
        data.append('informacionAdicional', informacionAdicional);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=segurosTarjeta&action=insertSeguro', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Seguro ingresado correctamente!");
                window.location.replace("/admin/SegurosTarjeta/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function editSeguro(){
    try{
        let idSeuro = $("#id").val();
        let idTarjeta = $("#tarjeta").val();
        let titulo = $("#titulo_seguro").val();
        let desc = $("#desc").val();
        let informacionAdicional = $("#informacion").val();
        let data = new FormData();
        data.append('id', idSeuro);
        data.append('idTarjeta', idTarjeta);
        data.append('titulo', titulo);
        data.append('desc', desc);
        data.append('informacionAdicional', informacionAdicional);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=segurosTarjeta&action=updateSeguro', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Seguro editado con exito!");
                window.location.replace("/admin/SegurosTarjeta/");
            }else{
                console.log("error");
            }
        });
    }catch (e){
        console.log(e);
    }
}

function cargarDatosEdicion(id){
    getAllCards();
    try{
        const data = new FormData();
        data.append('ID', id);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=segurosTarjeta&action=selectOneSeguro', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                setTimeout(function (){
                    $("#id").val(data.id_seguro);
                    $("#tarjeta").val(data.id_tarjeta).change();
                    $("#titulo_seguro").val(data.titulo_seguro);
                    $("#desc").val(data.descripcion);
                    $("#informacion").val(data.informacion_adicional);
                },500)
            }else{
                console.log("error")
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function deleteSeguro(idSeguro){
    const data = new FormData();
    data.append('ID', idSeguro);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=segurosTarjeta&action=deleteSeguro', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Seguro eliminado con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function getAllCards(){
    try{
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = ``;
                for(let i in data){
                    output += `<option value="${data[i].id_tarjeta}">${data[i].nombre}</option>`
                }
                $('#tarjeta').html(output)
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function getAllSeguros(){
    try{
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=segurosTarjeta&action=all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <td>${data[i].id_seguro}</td>
                    <td>${data[i].titulo_seguro}</td>
                    <td>${data[i].nombreTarjeta}</td>
                    <td>${data[i].id_tarjeta}</td>   
                    <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_seguro}">Editar</button></td>
                    <td><button type="button" class="btnEliminar btn btn-primary" value="${data[i].id_seguro}">Eliminar</button></td>
                <tr>`;
                }
                $('#dataSegurosBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}