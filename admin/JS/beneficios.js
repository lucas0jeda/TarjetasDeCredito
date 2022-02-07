$(document).ready(function() {
    let link = window.location.href;
    const explode = link.split(".com");
    switch (explode[1]) {
        case "/admin/Beneficios/":
            sessionStorage.removeItem("beneficioID");
            $("#addBeneficio").click(function (){
                window.location.replace("/admin/Beneficios/crear.html");
            });
            getAllBeneficios();
            break;
        case "/admin/Beneficios/editar.html":
            if(sessionStorage.getItem("beneficioID")){
                cargarDatosEdicion(sessionStorage.getItem("beneficioID"));
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    editBeneficio();
                });
            }
            break;
        case "/admin/Beneficios/crear.html":
            getAllCards();
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                if(validacion()) {
                    insertBeneficio();
                }else{
                    alert("No completo todos los campos oblgatorios");
                }
            });
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('beneficioID',$(this).val());
            window.location.replace("/admin/Beneficios/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar este beneficio?");
            if(confirmationDelete){
                deleteBeneficio($(this).val());
            }
        });
    },2000);
});


function getAllCards(){
    try{
        fetch('/app/beneficios/selectorBeneficios').then(response => response.json()).then(data => {
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

function deleteBeneficio(idBeneficio){
    const data = new FormData();
    data.append('ID', idBeneficio);
    fetch('/app/beneficios/deleteBeneficio', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Beneficio eliminado con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function cargarDatosEdicion(id){
    getAllCards();
    try{
        const data = new FormData();
        data.append('ID', id);
        fetch('/app/beneficios/selectOneBeneficio', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                setTimeout(function (){
                    $("#id").val(data.id_beneficio);
                    $("#tarjeta").val(data.id_tarjeta).change();
                    $("#titulo_beneficio").val(data.titulo_beneficio);
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

function getAllBeneficios(){
    try{
        fetch('/app/beneficios/all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <td>${data[i].id_beneficio}</td>
                    <td>${data[i].titulo_beneficio}</td>
                    <td>${data[i].nombreTarjeta}</td>
                    <td>${data[i].id_tarjeta}</td>   
                    <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_beneficio}">Editar</button></td>
                    <td><button type="button" class="btnEliminar btn btn-primary" value="${data[i].id_beneficio}">Eliminar</button></td>
                <tr>`;
                }
                $('#dataBeneficiosBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function editBeneficio(){
    try{
        let idBeneficio = $("#id").val();
        let idTarjeta = $("#tarjeta").val();
        let titulo = $("#titulo_beneficio").val();
        let desc = $("#desc").val();
        let informacionAdicional = $("#informacion").val();
        let data = new FormData();
        data.append('idBeneficio', idBeneficio);
        data.append('idTarjeta', idTarjeta);
        data.append('titulo', titulo);
        data.append('desc', desc);
        data.append('informacionAdicional', informacionAdicional);
        fetch('/app/beneficios/updateBeneficio', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Beneficio editado con exito!");
                window.location.replace("/admin/Beneficios/");
            }else{
                console.log("error");
            }
        });
    }catch (e){
        console.log(e);
    }
}

function insertBeneficio(){
    try{
        let idTarjeta = $("#tarjeta").val();
        let titulo = $("#titulo_beneficio").val();
        let desc = $("#desc").val();
        let informacionAdicional = $("#informacion").val();
        let data = new FormData();
        data.append('idTarjeta', idTarjeta);
        data.append('titulo', titulo);
        data.append('desc', desc);
        data.append('informacionAdicional', informacionAdicional);
        fetch('/app/beneficios/insertBeneficio', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Beneficio ingresado correctamente!");
                window.location.replace("/admin/Beneficios/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function validacion(idTarjeta, titulo){
    let retorno = false
    if($("#tarjeta").val() != "" && $("#titulo_beneficio").val() != ""){
        retorno = true;
    }
    return retorno;
}