$(document).ready(function (){
    let link = window.location.href;
    const explode = link.split(".com");
    switch (explode[1]){
        case "/admin/Tarjetas/":
            sessionStorage.removeItem("tarjeta");
            $("#addCard").click(function (){
                window.location.replace("/admin/Tarjetas/crear.html");
            });
            getAllCards();
            break;
        case "/admin/Tarjetas/crear.html":
            cargarSelectores();
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                let validacion = validarDatos();
                if(validacion){
                    insertCard();
                }
            });
            break;
        case "/admin/Tarjetas/editar.html":
            if(sessionStorage.getItem("tarjeta")){
                cargarSelectores();
                setTimeout(function (){
                    cargarDatosEdicion(sessionStorage.getItem("tarjeta"));
                }, 1000);
                $("#imagen").change(function(){
                    let file = this.files[0];
                    console.log(URL.createObjectURL(file));
                    $("#imagenTarjeta").attr("src", URL.createObjectURL(file));
                })
                $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    let validacion = validarDatos();
                    if(validacion){
                        editTarjeta();
                    }
                });
            }
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('tarjeta',$(this).val());
            window.location.replace("/admin/Tarjetas/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar esta tarjeta?");
            if(confirmationDelete){
                deleteCard($(this).val());
            }
        });
    },2000);
})


function prueba(){

}

function getAllCards(){
    try{
        fetch('/app/tarjetas/all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <th>${data[i].id_tarjeta}</th>
                    <td>${data[i].nombre}</td>
                    <td>${data[i].nombreEmisor}</td>  
                    <td>${data[i].nombreSello}</td>
                    <td>${data[i].uso}</td>
                    <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_tarjeta}">Editar</button></td>
                    <td><button type="button" class="btnEliminar btn btn-primary" value="${data[i].id_tarjeta}">Eliminar</button></td>
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
    fetch('/app/tarjetas/deleteCard', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            console.log(data);
            alert("Tarjeta eliminada con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function cargarSelectores(){
    try{
        fetch('/app/emisores/all').then(response => response.json()).then(emisor => {
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
        fetch('/app/sellos/all')
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
            });
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
    let imagen = $("#imagen").val();
    if(nombre != '' && emisor != '' && sello != '' && tipo != '' && uso != '', imagen != '') {
        result = true;
    }
    return result
}

function cargarDatosEdicion(idTarjeta){
    try{
        const data = new FormData();
        data.append('ID', idTarjeta);
        fetch('/app/tarjetas/selectOneTarjeta', {
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
                let src = "/images/cardsImg/" + data.imagen;
                $("#imagenTarjeta").attr("src", src);
                sessionStorage.setItem("imagenActual", data.imagen);
            }else{
                console.log("error")
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function editTarjeta(){
    try{
        let id = $('#id').val();
        let nombre = $('#nombre').val();
        let idEmisor = $('#emisor').val();
        let idSello = $('#sello').val();
        let tipo = $('#tipo').val();
        let uso = $('#uso').val();
        let costoDeEmision = $('#costo_de_emision').val();
        let costoPrimerAnio = $('#costo_primer_anio').val();
        let costoRenovacion = $('#costo_renovacion').val();
        let costoAdicionales = $('#costo_adicionales').val();
        let comisionComprasExterior = $('#comision_compras_exterior').val();
        let pago = $('#pago').val();
        let cashback = $("#cashback").val() ?? 0;
        let programaDePuntos = $("#programa_de_puntos").val() ?? 0;
        let limiteGastoMaximo =$('#limite_gasto_maximo').val();
        let interesesCuotas =$('#intereses_cuotas').val();
        let cuentaBancaria = $('#cuenta_bancaria').val() ?? 0;
        let costoEnvioEstadoDeCuenta = $('#costo_envio_estado_de_cuenta').val();
        let envioEstadoDeCuentaEmail = $('#envio_estado_de_cuenta_email').val() ?? 0;
        let adelantoDeEfectivo = $('#adelanto_de_efectivo').val();
        let aumentoDeLimitePorViaje = $('#aumento_de_limite_por_viaje').val();
        let telefonoParaExtravio = $('#telefono_para_extravio').val();
        let contactless = $('#contactless').val() ?? 0;
        let reimpresionDePlastico = $('#reimpresion_de_plastico').val();
        let reimpresionDePin = $('#reimpresion_de_pin').val();
        let reemplazoPorRoboExtravio = $('#reemplazo_por_robo_extravio').val();
        let fechaDeCierre = $('#fecha_de_cierre').val();
        let cambioFechaDeCierre = $('#cambio_fecha_de_cierre').val();
        let informacionAdicional = $('#informacion_adicional').val();
        let imagen = document.getElementById("imagen").files[0];
        let imagenActual = sessionStorage.getItem("imagenActual");
        const data = new FormData();
        data.append('id_tarjeta', id);
        data.append('nombre', nombre);
        data.append('id_emisor', idEmisor);
        data.append('id_sello', idSello);
        data.append('tipo', tipo);
        data.append('uso', uso);
        data.append('costo_de_emision', costoDeEmision);
        data.append('costo_primer_anio', costoPrimerAnio);
        data.append('costo_renovacion', costoRenovacion);
        data.append('costo_adicionales', costoAdicionales);
        data.append('comision_compras_exterior', comisionComprasExterior);
        data.append('pago', pago);
        data.append('cashback', cashback);
        data.append('programa_de_puntos', programaDePuntos);
        data.append('limite_de_gasto_maximo', limiteGastoMaximo);
        data.append('interes_cuotas', interesesCuotas);
        data.append('cuenta_bancaria', cuentaBancaria);
        data.append('costo_envio_estado_de_cuenta', costoEnvioEstadoDeCuenta);
        data.append('envio_estado_de_cuenta_email', envioEstadoDeCuentaEmail);
        data.append('adelanto_de_efectivo', adelantoDeEfectivo);
        data.append('aumento_de_limite_por_viaje', aumentoDeLimitePorViaje);
        data.append('telefono_para_extravio', telefonoParaExtravio);
        data.append('contactless', contactless);
        data.append('reimpresion_de_plastico', reimpresionDePlastico);
        data.append('reimpresion_de_pin', reimpresionDePin);
        data.append('reemplazo_por_robo_extravio', reemplazoPorRoboExtravio);
        data.append('fecha_de_cierre', fechaDeCierre);
        data.append('cambio_fecha_de_cierre', cambioFechaDeCierre);
        data.append('informacion_adicional', informacionAdicional);
        data.append('imagen', imagen);
        data.append("imagenActual", imagenActual)
        fetch('/app/tarjetas/updateCard', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                sessionStorage.removeItem("imagenActual");
                alert("Tarjeta editada con exito!");
                window.location.replace("/admin/Tarjetas/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function insertCard(){
    try{
        let nombre = $('#nombre').val();
        let idEmisor = $('#emisor').val();
        let idSello = $('#sello').val();
        let tipo = $('#tipo').val();
        let uso = $('#uso').val();
        let costoDeEmision = $('#costo_de_emision').val();
        let costoPrimerAnio = $('#costo_primer_anio').val();
        let costoRenovacion = $('#costo_renovacion').val();
        let costoAdicionales = $('#costo_adicionales').val();
        let comisionComprasExterior = $('#comision_compras_exterior').val();
        let pago = $('#pago').val();
        let cashback = $("#cashback").val() ?? 0;
        let programaDePuntos = $("#programa_de_puntos").val() ?? 0;
        let limiteGastoMaximo =$('#limite_gasto_maximo').val();
        let interesesCuotas =$('#intereses_cuotas').val();
        let cuentaBancaria = $('#cuenta_bancaria').val() ?? 0;
        let costoEnvioEstadoDeCuenta = $('#costo_envio_estado_de_cuenta').val();
        let envioEstadoDeCuentaEmail = $('#envio_estado_de_cuenta_email').val() ?? 0;
        let adelantoDeEfectivo = $('#adelanto_de_efectivo').val();
        let aumentoDeLimitePorViaje = $('#aumento_de_limite_por_viaje').val();
        let telefonoParaExtravio = $('#telefono_para_extravio').val();
        let contactless = $('#contactless').val() ?? 0;
        let reimpresionDePlastico = $('#reimpresion_de_plastico').val();
        let reimpresionDePin = $('#reimpresion_de_pin').val();
        let reemplazoPorRoboExtravio = $('#reemplazo_por_robo_extravio').val();
        let fechaDeCierre = $('#fecha_de_cierre').val();
        let cambioFechaDeCierre = $('#cambio_fecha_de_cierre').val();
        let informacionAdicional = $('#informacion_adicional').val();
        let imagen = document.getElementById("imagen").files[0];
        const data = new FormData();
        data.append('nombre', nombre);
        data.append('id_emisor', idEmisor);
        data.append('id_sello', idSello);
        data.append('tipo', tipo);
        data.append('uso', uso);
        data.append('costo_de_emision', costoDeEmision);
        data.append('costo_primer_anio', costoPrimerAnio);
        data.append('costo_renovacion', costoRenovacion);
        data.append('costo_adicionales', costoAdicionales);
        data.append('comision_compras_exterior', comisionComprasExterior);
        data.append('pago', pago);
        data.append('cashback', cashback);
        data.append('programa_de_puntos', programaDePuntos);
        data.append('limite_de_gasto_maximo', limiteGastoMaximo);
        data.append('interes_cuotas', interesesCuotas);
        data.append('cuenta_bancaria', cuentaBancaria);
        data.append('costo_envio_estado_de_cuenta', costoEnvioEstadoDeCuenta);
        data.append('envio_estado_de_cuenta_email', envioEstadoDeCuentaEmail);
        data.append('adelanto_de_efectivo', adelantoDeEfectivo);
        data.append('aumento_de_limite_por_viaje', aumentoDeLimitePorViaje);
        data.append('telefono_para_extravio', telefonoParaExtravio);
        data.append('contactless', contactless);
        data.append('reimpresion_de_plastico', reimpresionDePlastico);
        data.append('reimpresion_de_pin', reimpresionDePin);
        data.append('reemplazo_por_robo_extravio', reemplazoPorRoboExtravio);
        data.append('fecha_de_cierre', fechaDeCierre);
        data.append('cambio_fecha_de_cierre', cambioFechaDeCierre);
        data.append('informacion_adicional', informacionAdicional);
        data.append('imagen', imagen);
        fetch('/app/tarjetas/insertCard', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Tarjeta ingresada con exito!");
                window.location.replace("/admin/Tarjetas/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

