$( document ).ready(function() {
    let data = JSON.parse(sessionStorage.getItem('PublicTarjetaCargar'));
    cargarCardCompleteInfomation()
});


function cargarCardCompleteInfomation(idTarjeta){
    try {
        const data = new FormData();
        data.append('id_tarjeta', "3");
        fetch('http://localhost/TarjetasDeCredito/app/tarjetas/getOneCompleteInformationCard', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            console.log(data);
            let output = `
                <div class="card-brand">
                    <img src="images/emisorImg/logos/${data.LogoEmisor}" width="100" height="35" alt="Card Brand Image" />
                </div>
                <h1>Tarjeta ${data.nombre}</h1>
                <a href="#" class="card-img-link">
                    <img src="images/cardsImg/${data.imagen}" width="250" height="155" alt="Card Image" />
                </a>
            `;
            $("#iformacionPrincipal").html(output);

            output = `
                <div class="col-6 col-md-3 feature">
                        <h5 class="lbl-bold">EMISOR</h5>
                        <p>
                            ${data.nombreEmisor}
                        </p>
                    </div>
                    <div class="col-6 col-md-3 feature">
                        <h5 class="lbl-bold">SELLO</h5>
                        <p>
                            ${data.nombreSello}
                        </p>
                    </div>
                    <div class="col-6 col-md-3 feature">
                        <h5 class="lbl-bold">TIPO</h5>
                        <p>
                            ${data.tipo}
                        </p>
                    </div>
                    <div class="col-6 col-md-3 feature">
                        <h5 class="lbl-bold">USO</h5>
                        <p>
                           ${data.uso}
                        </p>
                    </div>
            `;
            $("#PrimeraInformacion").html(output);

            output = ``;
            if(data.MoreInformation.sistema_de_puntos != undefined){
                output = `
                    <div class="col-4 feature">
                        <h5 class="lbl-bold">TASA DE RECOMPENSAS</h5>
                        <p>
                            ${data.MoreInformation.sistema_de_puntos.equivalencia ? data.MoreInformation.sistema_de_puntos.equivalencia : "-" } <br /> ${formatearEquivalenciaPuntos(data.MoreInformation.sistema_de_puntos.equivalencia) ? formatearEquivalenciaPuntos(data.MoreInformation.sistema_de_puntos.equivalencia) : "-"}
                        </p>
                    </div>
                    <div class="col-4 feature">
                        <h5 class="lbl-bold">NOMBRE</h5>
                        <p>
                            ${data.MoreInformation.sistema_de_puntos.Nombre}
                        </p>
                    </div>
                    <div class="col-4 feature">
                        <h5 class="lbl-bold">CATALOGO</h5>
                        <p>
                            <a href="${data.MoreInformation.sistema_de_puntos.link_de_catalogo ? data.MoreInformation.sistema_de_puntos.link_de_catalogo : "#" }" target="_blank">VER CATALOGO AQUI</a>
                        </p>
                    </div>                    
                `;
            }
            $("#InformacionSistemaDePuntosInfoBase").html(output);

            output = ``;
            if(data.MoreInformation.sistema_de_puntos != undefined) {
                if (data.MoreInformation.sistema_de_puntos.informacion_adicional != "") {
                    output = `
                    <div class="col-12 feature">
                        <h5 class="lbl-bold">INFORMACION ADICIONAL</h5>
                        <p>
                            ${data.MoreInformation.sistema_de_puntos.informacion_adicional.replace(/(?:\r\n|\r|\n)/g, '</br>')}
                        </p>
                    </div>
                `;
                }
            }
            $("#InformacionSistemaDePuntosInfoAdicional").html(output);


            output = ventajaODesventaja(data.cashback, data.programa_de_puntos, data.cuenta_bancaria, data.envio_estado_de_cuenta_email, data.contactless);
            $("#tarjetaVentajas").html(`<h3 class="lbl-bold">Ventajas</h3>` + output.ventajas);
            $("#tarjetaDesventajas").html(`<h3 class="lbl-bold">Desventajas</h3>` + output.desventajas);

            if(data.MoreInformation.requisitos != undefined) {
                output = `
                 <div class="rate d-flex">
                    <div class="rate-title">
                        Edad Minima:
                    </div>
                    <div class="rate-value">
                        ${data.MoreInformation.requisitos.edad_minima}
                    </div>
                 </div>
                 <div class="rate d-flex">
                    <div class="rate-title">
                        Edad Maxima:
                    </div>
                    <div class="rate-value">
                        ${data.MoreInformation.requisitos.edad_maxima}
                    </div>
                 </div>
                 <div class="rate d-flex">
                    <div class="rate-title">
                        Cedula de Identidad:
                    </div>
                    <div class="rate-value">
                        ${formatearBit(data.MoreInformation.requisitos.cedula_de_identidad)}
                    </div>
                 </div>
                 <div class="rate d-flex">
                    <div class="rate-title">
                        Fotocopia de la Cedula de Identidad:
                    </div>
                    <div class="rate-value">
                        ${formatearBit(data.MoreInformation.requisitos.fotocopia_CI)}
                    </div>
                 </div>
            `;
                $("#requisitosUno").html(output);
                output = `
                <div class="rate d-flex">
                    <div class="rate-title">
                        Clering:
                    </div>
                    <div class="rate-value">
                        ${formatearBit(data.MoreInformation.requisitos.clering)}
                    </div>
                 </div>
                 <div class="rate d-flex">
                    <div class="rate-title">
                        Constancia de Domicilio:
                    </div>
                    <div class="rate-value">
                        ${formatearBit(data.MoreInformation.requisitos.constancia_de_domicilio)}
                    </div>
                 </div>
                 <div class="rate d-flex">
                    <div class="rate-title">
                        Certificado de Ingresos:
                    </div>
                    <div class="rate-value">
                        ${formatearBit(data.MoreInformation.requisitos.certificado_de_ingresos)}
                    </div>
                 </div>    
                 <div class="rate d-flex">
                    <div class="rate-title">
                        Recibo de Sueldo:
                    </div>
                    <div class="rate-value">
                        ${formatearBit(data.MoreInformation.requisitos.recibo_de_sueldo)}
                    </div>
                 </div>  
                       
            `;
                $("#requisitosDos").html(output);
                output = `
                    <div class="rate d-flex">
                        <p>
                            <span class="lbl-bold">Ingresos Minimos:</span> <br/><br/>
                            ${data.MoreInformation.requisitos.ingresos_minimos.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data.MoreInformation.requisitos.ingresos_minimos.replace(/(?:\r\n|\r|\n)/g, '</br>') : "-"}
                        </p>
                    </div>
                    <div class="rate d-flex">
                        <p>
                            <span class="lbl-bold">Antiguedad Laboral:</span><br/><br/>
                            ${data.MoreInformation.requisitos.antiguedad_laboral.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data.MoreInformation.requisitos.ingresos_minimos.replace(/(?:\r\n|\r|\n)/g, '</br>') : "-"}
                        </p>
                    </div>
                `;
                $("#requisitosTres").html(output);
            }

            if(data.MoreInformation.beneficios != undefined) {

                output = `
                        <p>
                            <span>${data.MoreInformation.beneficios.titulo_beneficio}</span> <br/><br/>
                        </p>
                        <div class="rate d-flex">
                            <p>
                                <span class="lbl-bold">Descripcion:</span> <br/><br/>
                                ${data.MoreInformation.beneficios.descripcion.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data.MoreInformation.requisitos.ingresos_minimos.replace(/(?:\r\n|\r|\n)/g, '</br>') : "X"}
                            </p>
                        </div>
                `;
                $("#BeneficiosDesc").html(output);

                output = `
                    <div class="rate d-flex">
                        <p>
                            <span class="lbl-bold">Informacion Adicional:</span> <br/><br/>
                            ${data.MoreInformation.beneficios.informacion_adicional.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data.MoreInformation.requisitos.ingresos_minimos.replace(/(?:\r\n|\r|\n)/g, '</br>') : "-"}
                        </p>
                    </div>
                `;
                $("#BeneficiosInfo").html(output);
            }

            if(data.MoreInformation.seguros != undefined) {
                output = `
                    <p>
                        <span>${data.MoreInformation.seguros.titulo_seguro}</span> <br/><br/>
                    </p>
                    <div class="rate d-flex">
                        <p>
                            <span class="lbl-bold">Descripcion:</span> <br/><br/>
                            ${data.MoreInformation.seguros.descripcion.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data.MoreInformation.requisitos.ingresos_minimos.replace(/(?:\r\n|\r|\n)/g, '</br>') : "X"}
                        </p>
                    </div>
                `;
                $("#SegurosDesc").html(output);

                output = `
                    <div class="rate d-flex">
                        <p>
                            <span class="lbl-bold">Informacion Adicional:</span> <br/><br/>
                            ${data.MoreInformation.seguros.informacion_adicional.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data.MoreInformation.requisitos.ingresos_minimos.replace(/(?:\r\n|\r|\n)/g, '</br>') : "-"}
                        </p>
                    </div>
                `;
                $("#SegurosInfo").html(output);
            }


        });
    }catch (e){
        console.log(e);
    }
}

function formatearEquivalenciaPuntos(equivalencia){
    let result = equivalencia.split("-");
    switch (result[1]){
        case "$":
            result = result[0] + " Punto = " + result[2] + " Peso";
            break;
        case "USD":
            result = result[0] + " Punto = " + result[2] + " Dolar";
            break;
    }
    return result;
}

function formatearBit(data){
    let retorno = "";
    if(data == "1"){
        retorno = "Si";
    }
    if(data == "0"){
        retorno = "No";
    }
    return retorno;
}

function ventajaODesventaja(cashback, programa_de_puntos, cuenta_bancaria, envio_estado_de_cuenta_email, contactless){
    let output = [];
    let desventajas = ``;
    let ventajas = ``;

    if(cashback == "1"){
        ventajas += `
            <p>
                <i class="fa fa-check"></i>
                Cashback
            </p>
        `;
    }else{
        desventajas += `
            <p>
                <i class="fa fa-times"></i>
                Cashback
            </p>
        `;
    }

    if(programa_de_puntos == "1"){
        ventajas += `
            <p>
                <i class="fa fa-check"></i>
                Programa de Puntos
            </p>
        `;
    }else{
        desventajas += `
            <p>
                <i class="fa fa-times"></i>
                Programa de Puntos
            </p>
        `;
    }

    if(cuenta_bancaria == "0"){
        ventajas += `
            <p>
                <i class="fa fa-check"></i>
                No se necesita cuenta bancaria
            </p>
        `;
    }else{
        desventajas += `
            <p>
                <i class="fa fa-times"></i>
                Se necesita cuenta Bancaria
            </p>
        `;
    }

    if(envio_estado_de_cuenta_email == "1"){
        ventajas += `
            <p>
                <i class="fa fa-check"></i>
                Envio de estado de cuenta por mail
            </p>
        `;
    }else{
        desventajas += `
            <p>
                <i class="fa fa-times"></i>
                Envio de estado de cuenta por mail
            </p>
        `;
    }

    if(contactless == "1"){
        ventajas += `
            <p>
                <i class="fa fa-check"></i>
                Contactless
            </p>
        `;
    }else{
        desventajas += `
            <p>
                <i class="fa fa-times"></i>
                Contactless
            </p>
        `;
    }

    output.ventajas = ventajas;
    output.desventajas = desventajas;
    return output;
}
