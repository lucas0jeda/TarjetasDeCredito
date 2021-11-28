$(document).ready(function (){
    switch (window.location.href){
        case "http://localhost/TarjetasDeCredito/admin/Tarjetas/":
            sessionStorage.removeItem("category");
            $("#addCard").click(function (){
                window.location.replace("http://localhost/TarjetasDeCredito/admin/Tarjetas/crear.html");
            });
            getAllCards();
            break;
        case "http://localhost/TarjetasDeCredito/admin/Tarjetas/crear.html":
            cargarSellosYEmisores();
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                let validacion = validarDatos();
                console.log(validacion);
                //insertTarjeta();
            });
            break;
        case "http://localhost/TarjetasDeCredito/admin/Tarjetas/editar.html":
            if(sessionStorage.getItem("tarjeta")){
                cargarSellosYEmisores();
                setTimeout(function (){
                    cargarDatosEdicion(sessionStorage.getItem("tarjeta"));
                }, 1000);
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    //editTarjeta();
                });
            }
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('tarjeta',$(this).val());
            window.location.replace("http://localhost/TarjetasDeCredito/admin/Tarjetas/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar esta tarjeta?");
            if(confirmationDelete){
                deleteCard($(this).val());
            }
        });
    },2000);
})

function getAllCards(){
    try{
        fetch('http://localhost/TarjetasDeCredito/app/tarjetas/all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <th>${data[i].id_tarjeta}</th>
                    <td>${data[i].nombre}</td>
                    <td>${data[i].nombreEmisor}</td>  
                    <td>${data[i].nombreSello}</td>
                    <td>${data[i].uso}</td>
                    <td><button type="button" class="btnEditar" value="${data[i].id_tarjeta}">Editar</button></td>
                    <td><button type="button" class="btnEliminar" value="${data[i].id_tarjeta}">Eliminar</button></td>
                <tr>`;
                }
                $('#dataCardBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function deleteCard(idCard){
    const data = new FormData();
    data.append('ID', idCard);
    fetch('http://localhost/TarjetasDeCredito/app/tarjetas/deleteCard', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Tarjeta eliminada con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function cargarSellosYEmisores(){
    try{
        fetch('http://localhost/TarjetasDeCredito/app/emisores/all').then(response => response.json()).then(emisor => {
            if(typeof emisor === 'object'){
                let output = `<option value="" selected disabled>---</option>`;
                for(let i in emisor){
                    output += `<option value="${emisor[i].id_emisor}">${emisor[i].nombre}</option>`;
                }
                $('#emisor').html(output);
            }else{
                console.log("error");
            }
        });
        fetch('http://localhost/TarjetasDeCredito/app/sellos/all')
            .then(response => response.json())
            .then(sellos => {
                if(typeof sellos === 'object'){
                    let output = `<option value="" selected disabled>---</option>`;
                    for(let i in sellos){
                        output += `<option value="${sellos[i].id_sello}">${sellos[i].nombre}</option>`;
                    }
                    $('#sello').html(output);
                }else{
                    console.log("error");
                }
            })
    }catch (e) {
        console.log(e);
    }
}

function validarDatos(){
    let result = false;
    let nombre = $('#nombre').val();
    let emisor = $('#emisor').val();
    let sello = $('#sello').val();
    let tipo = $('#tipo').val();
    let uso = $('#uso').val();
    let imagen = $('#imagen').val();
    if(nombre != '' && emisor != '' && sello != '' && tipo != '' && uso != '' && imagen != '') {
        result = true;
    }
    return result
}

function cargarDatosEdicion(idTarjeta){
    try{
        const data = new FormData();
        data.append('ID', idTarjeta);
        fetch('http://localhost/TarjetasDeCredito/app/tarjetas/selectOneTarjeta', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                $('#nombre').val(data.nombre);
                $('#id').val(data.id_tarjeta);
                $("#emisor").val(data.id_emisor).change();
                $("#sello").val(data.id_sello).change();
                $("#tipo").val(data.tipo).change();
                $("#uso").val(data.uso).change();
                $('#costo_de_emision').val(data.costo_de_emision);
                $('#costo_primer_anio').val(data.costo_primer_anio);
                $('#costo_renovacion').val(data.costo_renovacion);
                $('#costo_adicionales').val(data.costo_adicionales);
                $('#comision_compras_exterior').val(data.comision_compras_exterior);
                $('#pago').val(data.pago);
                $("#cashback").val(data.cashback).change();
                $("#programa_de_puntos").val(data.programa_de_puntos).change();
                $('#limite_gasto_maximo').val(data.limite_de_gasto_maximo);
                $('#intereses_cuotas').val(data.interes_cuotas);
                $('#cuenta_bancaria').val(data.cuenta_bancaria).change();
                $('#costo_envio_estado_de_cuenta').val(data.costo_envio_estado_de_cuenta);
                $('#envio_estado_de_cuenta_email').val(data.envio_estado_de_cuenta_email).change();
                $('#adelanto_de_efectivo').val(data.adelanto_de_efectivo);
                $('#aumento_de_limite_por_viaje').val(data.aumento_de_limite_por_viaje);
                $('#telefono_para_extravio').val(data.telefono_para_extravio);
                $('#contactless').val(data.contactless).change();
                $('#reimpresion_de_plastico').val(data.reimpresion_de_plastico);
                $('#reimpresion_de_pin').val(data.reimpresion_de_pin);
                $('#reemplazo_por_robo_extravio').val(data.reemplazo_por_robo_extravio);
                $('#fecha_de_cierre').val(data.fecha_de_cierre);
                $('#cambio_fecha_de_cierre').val(data.cambio_fecha_de_cierre);
                $('#informacion_adicional').val(data.informacion_adicional);
                $('#imagen').val(data.imagen);
            }else{
                console.log("error")
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function editTarjeta(){

}