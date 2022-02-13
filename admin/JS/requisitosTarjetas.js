$(document).ready(function(){
    let link = window.location.href;
    const explode = link.split(".com.uy");
    switch (explode[1]){
        case "/admin/RequisitosTarjeta/":
            sessionStorage.removeItem("idTarjetaRequisito");
            sessionStorage.removeItem("RequisitoTarjetaJson");
            $("#addRequisito").click(function (){
                window.location.replace("http://www.tarjetasdecredito.com.uy/admin/RequisitosTarjeta/crear.html");
            });
            getAllCards("index");
            break;
        case "/admin/RequisitosTarjeta/detalle.html":
            let output = `<li class="list-group-item">Tarjeta:</li>
                          <li class="list-group-item">` + sessionStorage.getItem('idTarjetaRequisito') + `</li>`;
            $("#tarjeta").html(output);
            getRequisitosTarjeta("detalle");
            break;
        case "/admin/RequisitosTarjeta/editar.html":
            if(sessionStorage.getItem("idTarjetaRequisito")){
                $("#divBtnEditar").html(`<button class="form-control btn btn-primary" type="submit" id="btnDelete" disabled="false">Eliminar Requisito</button>`);
                getRequisitosTarjeta("editar");
                $("#btnEnviar").click(function(e){
                    e.preventDefault();
                    let validation =   validacion();
                    if(validation){
                        updateRequisitosTarjetas();
                    }
                });
                setTimeout(function (){
                    $("#btnDelete").click(function(e){
                        e.preventDefault();
                        let eliminar = confirm('Estas seguro que deseas eliminar estos requisitos?')
                        if(eliminar){
                            deleteRequisito();
                        }
                    });
                    $( "#btnDelete" ).prop( "disabled", false );
                },500);
            }
            break;
        case "/admin/RequisitosTarjeta/crear.html":
            getAllCards("crear");
            $("#btnEnviar").click(function(e){
                e.preventDefault();
                let validation =  validacion();
                if(validation){
                    insertRequisitosTarjetas();
                }
            });
            $("#edad_minima").keypress(function(evt){
                // code is the decimal ASCII representation of the pressed key.
                var code = (evt.which) ? evt.which : evt.keyCode;

                if(code==8) { // backspace.
                    return true;
                } else if(code>=48 && code<=57) { // is a number.
                    return true;
                } else{ // other keys.
                    return false;
                }
            });
            $("#edad_maxima").keypress(function(evt){
                // code is the decimal ASCII representation of the pressed key.
                var code = (evt.which) ? evt.which : evt.keyCode;

                if(code==8) { // backspace.
                    return true;
                } else if(code>=48 && code<=57) { // is a number.
                    return true;
                } else{ // other keys.
                    return false;
                }
            });
            break;
    }

    setTimeout(function (){
        $(".btnDetalle").click(function (){
            sessionStorage.setItem('idTarjetaRequisito',$(this).val());
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/RequisitosTarjeta/detalle.html");
        });
        $(".btnEditar").click(function (){
            sessionStorage.setItem('idTarjetaRequisito',$(this).val());
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/RequisitosTarjeta/editar.html");
        });
    }, 2000);
});

function deleteRequisito(){
    let id = $("#id").val();
    let data = new FormData();
    data.append('id', id);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=requisitosTarjeta&action=deleteRequisito', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Requisito eliminado con exito!");
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/RequisitosTarjeta/");
        }else{
            console.log("error");
        }
    });
}

function validacion(){
    let retorno = false;
    let edadMinima = $("#edad_minima").val();
    let edadMaxima = $("#edad_maxima").val();
    if(edadMinima.length <= 2  || edadMaxima.length <= 2){
        retorno = true;
    }
    return retorno;
}

function updateRequisitosTarjetas(){
    let id = $("#id").val();
    let tarjeta = $("#tarjeta").val();
    let edadMinima = $("#edad_minima").val();
    let edadMaxima = $("#edad_maxima").val();
    let clering = $("#clering").val();
    let constanciaDeDomicilio = $("#constancia_de_domicilio").val();
    let cedulaDeIdentidad = $("#cedula_de_identidad").val();
    let fotocopiaCI = $("#fotocopia_CI").val();
    let reciboDeSueldo = $("#recibo_de_sueldo").val();
    let certificadoDeIngresos = $("#certificado_de_ingresos").val();
    let ingresosMinimos = $("#ingresosMinimos").val();
    let antiguedadLaboral = $("#antiguedad_laboral").val();
    let data = new FormData();
    data.append('id', id);
    data.append('tarjeta',tarjeta);
    data.append('edad_minima',edadMinima);
    data.append('edad_maxima',edadMaxima);
    data.append('clering',clering);
    data.append('constancia_de_domicilio',constanciaDeDomicilio);
    data.append('cedula_de_identidad',cedulaDeIdentidad);
    data.append('fotocopia_CI',fotocopiaCI);
    data.append('recibo_de_sueldo',reciboDeSueldo);
    data.append('certificado_de_ingresos',certificadoDeIngresos);
    data.append('ingresosMinimos',ingresosMinimos);
    data.append('antiguedad_laboral',antiguedadLaboral);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=requisitosTarjeta&action=updateRequisito', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Requisito editado con exito!");
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/RequisitosTarjeta/");
        }else{
            console.log("error");
        }
    });
}

function getAllCards(action){
    try{
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    switch (action){
                        case 'index':
                            output += `<tr>
                                       <th>${data[i].id_tarjeta}</th>
                                       <td>${data[i].nombre}</td>
                                       <td>${data[i].tipo}</td>
                                       <td><button type="button" class="btnDetalle btn btn-primary" value="${data[i].id_tarjeta}">Detalle</button></td>
                                       <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_tarjeta}">Editar</button></td>
                                       <tr>`;
                            break;
                        case 'crear':
                            output += `<option value="${data[i].id_tarjeta}">${data[i].nombre}</option>`;
                            break;
                    }
                }
                if(action == 'index') {
                    $('#dataRequisitosBodyTable').html(output);
                }else if(action == 'crear'){
                    $('#tarjeta').html(output);
                }
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function cargarDatos(action, data){
    let output = ``;
    switch (action){
        case "editar":
            for(let i in data){
                $("#id").val(data[i].id);
                $("#tarjeta").val(data[i].id_tarjeta);
                $("#edad_minima").val(data[i].edad_minima);
                $("#edad_maxima").val(data[i].edad_maxima);
                $("#clering").val(data[i].clering).change();
                $("#constancia_de_domicilio").val(data[i].constancia_de_domicilio).change();
                $("#cedula_de_identidad").val(data[i].cedula_de_identidad).change();
                $("#fotocopia_CI").val(data[i].fotocopia_CI).change();
                $("#recibo_de_sueldo").val(data[i].recibo_de_sueldo).change();
                $("#certificado_de_ingresos").val(data[i].certificado_de_ingresos).change();
                $("#ingresosMinimos").val(data[i].ingresos_minimos);
                $("#antiguedad_laboral").val(data[i].antiguedad_laboral);
            }
            break;
        case "detalle":
            output += `<li class="list-group-item">Requisitos:</li>`;
            for(let i in data){
                output += `<li class="list-group-item list-group-item-info">Antiguedad Laboral:</li>
                           <li class="list-group-item">${data[i].antiguedad_laboral}</li>
                           <li class="list-group-item list-group-item-info">Cedula De Identidad:</li>
                           <li class="list-group-item">${formatearValoresBits(data[i].cedula_de_identidad)}</li>
                           <li class="list-group-item list-group-item-info">Certificado De Ingresos:</li>
                           <li class="list-group-item">${formatearValoresBits(data[i].certificado_de_ingresos)}</li>
                           <li class="list-group-item list-group-item-info">Clering:</li>
                           <li class="list-group-item">${formatearValoresBits(data[i].clering)}</li>
                           <li class="list-group-item list-group-item-info">Constancia De Domicilio:</li>
                           <li class="list-group-item">${formatearValoresBits(data[i].constancia_de_domicilio)}</li>
                           <li class="list-group-item list-group-item-info">Edad Maxima:</li>
                           <li class="list-group-item">${data[i].edad_maxima}</li>
                           <li class="list-group-item list-group-item-info">Edad Minima:</li>
                           <li class="list-group-item">${data[i].edad_minima}</li>
                           <li class="list-group-item list-group-item-info">Fotocopia CI:</li>
                           <li class="list-group-item">${formatearValoresBits(data[i].fotocopia_CI)}</li>
                           <li class="list-group-item list-group-item-info">Ingresos Minimos:</li>
                           <li class="list-group-item">${data[i].ingresos_minimos}</li>
                           <li class="list-group-item list-group-item-info">Recibo De Sueldo:</li>
                           <li class="list-group-item">${formatearValoresBits(data[i].recibo_de_sueldo)}</li>`;
            }
            $("#requisitosTarjeta").html(output);
            break;
        default:
            console.log("error");
            break;
    }
}

function formatearValoresBits(dato){
    let retorno = "No";
    if(dato == 1){
        retorno = "Si";
    }else if(dato == 0){
        retorno = "No";
    }
    return retorno;
}

function getRequisitosTarjeta(action){
    let idtarjeta = sessionStorage.getItem('idTarjetaRequisito');
    const data = new FormData();
    data.append('id_tarjeta', idtarjeta);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=getRequisitosTarjeta', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(Object.keys(data).length != 0){
            if(typeof data === 'object'){
                sessionStorage.setItem('RequisitoTarjetaJson', JSON.stringify(data));
                cargarDatos(action, data);
            }
        }else{
            sessionStorage.setItem('RequisitoTarjetaJson', JSON.stringify(data));
        }
    });
}

function insertRequisitosTarjetas(){
    try{
        let id = $("#id").val();
        let tarjeta = $("#tarjeta").val();
        let edadMinima = $("#edad_minima").val();
        let edadMaxima = $("#edad_maxima").val();
        let clering = $("#clering").val();
        let constanciaDeDomicilio = $("#constancia_de_domicilio").val();
        let cedulaDeIdentidad = $("#cedula_de_identidad").val();
        let fotocopiaCI = $("#fotocopia_CI").val();
        let reciboDeSueldo = $("#recibo_de_sueldo").val();
        let certificadoDeIngresos = $("#certificado_de_ingresos").val();
        let ingresosMinimos = $("#ingresosMinimos").val();
        let antiguedadLaboral = $("#antiguedad_laboral").val();
        let data = new FormData();
        data.append('id', id);
        data.append('tarjeta',tarjeta);
        data.append('edad_minima',edadMinima);
        data.append('edad_maxima',edadMaxima);
        data.append('clering',clering);
        data.append('constancia_de_domicilio',constanciaDeDomicilio);
        data.append('cedula_de_identidad',cedulaDeIdentidad);
        data.append('fotocopia_CI',fotocopiaCI);
        data.append('recibo_de_sueldo',reciboDeSueldo);
        data.append('certificado_de_ingresos',certificadoDeIngresos);
        data.append('ingresosMinimos',ingresosMinimos);
        data.append('antiguedad_laboral',antiguedadLaboral);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=requisitosTarjeta&action=insertRequisito', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Requisito ingresado correctamente!");
                window.location.replace("http://www.tarjetasdecredito.com.uy/admin/RequisitosTarjeta/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}
