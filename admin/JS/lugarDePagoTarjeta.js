$(document).ready(function(){
    let link = window.location.href;
    const explode = link.split(".com.uy");
    switch (explode[1]){
        case "/admin/LugaresDePagoTarjeta/":
            sessionStorage.removeItem("lugarDePago");
            sessionStorage.removeItem("lugaresDePagoTarjeta");
            getAllCards();
            break;
        case "/admin/LugaresDePagoTarjeta/detalle.html":
            let output = `<li class="list-group-item">Tarjeta:</li>
                          <li class="list-group-item">` + sessionStorage.getItem('lugarDePago') + `</li>`;
            $("#tarjeta").html(output);
            getLugaresDePagoTarjeta("detalle");
            break;
        case "/admin/LugaresDePagoTarjeta/editar.html":
            if(sessionStorage.getItem("lugarDePago")){
                getAllLugaresDePago();
                $("#btnEnviar").click(function(e){
                    e.preventDefault();
                    updateLugaresDePagoTarjetas();
                });
            }
            break;
    }

    setTimeout(function (){
        $(".btnDetalle").click(function (){
            sessionStorage.setItem('lugarDePago',$(this).val());
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/LugaresDePagoTarjeta/detalle.html");
        });
        $(".btnEditar").click(function (){
            sessionStorage.setItem('lugarDePago',$(this).val());
            window.location.replace("http://www.tarjetasdecredito.com.uy/admin/LugaresDePagoTarjeta/editar.html");
        });
    }, 2000);
});

function getAllCards(){
    try{
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <th>${data[i].id_tarjeta}</th>
                    <td>${data[i].nombre}</td>
                    <td>${data[i].tipo}</td>
                    <td><button type="button" class="btnDetalle btn btn-primary" value="${data[i].id_tarjeta}">Detalle</button></td>
                    <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id_tarjeta}">Editar</button></td>
                <tr>`;
                }
                $('#dataLugarDePagoTarjetaBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function getLugaresDePagoTarjeta(action){
    let idtarjeta = sessionStorage.getItem('lugarDePago');
    const data = new FormData();
    data.append('id_tarjeta', idtarjeta);
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=getLugaresDePagoTarjeta', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(Object.keys(data).length != 0){
            if(typeof data === 'object'){
                sessionStorage.setItem('lugaresDePagoTarjeta', JSON.stringify(data));
                cargarDatos(action, data);
            }
        }else{
            sessionStorage.setItem('lugaresDePagoTarjeta', JSON.stringify(data));
        }
    });
}

function getAllLugaresDePago(){
    // <label class="list-group-item"><input class="form-check-input me-1" type="checkbox" value="">First checkbox</label>
    try{
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=lugarDePago&action=all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                cargarDatos("editar", data);
                setTimeout(function(){
                    getLugaresDePagoTarjeta("cargar");
                },1000);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function formatearEspacios(string){
    return string.replace(/ /g, "-");
}

function cargarDatos(action, data){
    let output = ``;
    switch (action){
        case "editar":
            output += `<li class="list-group-item">Lugares de pago:</li>`;
            for(let i in data){
                let id = formatearEspacios(data[i].Nombre);
                output += `<li class="list-group-item"><input class="form-check-input me-1" name="lugares" id="${id}" type="checkbox" value="${data[i].id_lugar_de_pago}" aria-label="">${data[i].Nombre}</li>`;
            }
            $("#tarjeta").html(output);
            break;
        case "detalle":
            output += `<li class="list-group-item">Lugares de pago:</li>`;
            for(let i in data){
                output += `<li class="list-group-item">${data[i].NombreLugar}</li>`;
            }
            $("#lugarDePagoTarjeta").html(output);
            break;
        case "cargar":
            for(let i in data){
                let id = formatearEspacios(data[i].NombreLugar);
                $("#" + id).prop("checked", true);
            }
            break;
        default:
            console.log("error");
            break;
    }
}

function updateLugaresDePagoTarjetas(){
    let lugaresDePagoTarjeta = [];
    let idLugares = [];
    for(let i = 0; i < JSON.parse(sessionStorage.lugaresDePagoTarjeta).length; i++){
        lugaresDePagoTarjeta.push(JSON.parse(sessionStorage.lugaresDePagoTarjeta)[i].id_lugar_de_pago);
    }
    $("input[name=lugares]").each(function(){
        if(this.checked)
        {
            if(!lugaresDePagoTarjeta.includes(this.value)){
                let lugar = {"id" : this.value, "idTarjeta" : sessionStorage.getItem('lugarDePago'), "action": "insert"};
                idLugares.push(lugar);
            }
        }else{
            if(lugaresDePagoTarjeta.includes(this.value)){
                let lugar = {"id" : this.value, "idTarjeta" : sessionStorage.getItem('lugarDePago'), "action": "delete"};
                idLugares.push(lugar);
            }
        }
    });
    try{
        if(idLugares.length > 0){
          let JsonString = JSON.stringify(idLugares);
            fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=updateLugaresDePagoTarjeta', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JsonString
            }).then(response => response.json()).then(data => {
                if(data){
                    alert('Operacion realizada con exito!');
                    window.location="http://www.tarjetasdecredito.com.uy/admin/LugaresDePagoTarjeta/";
                }
            });
        }else{
            alert('No se encontraron cambios para modificar');
        }
    }catch (e){
        console.log(e);
    }
}