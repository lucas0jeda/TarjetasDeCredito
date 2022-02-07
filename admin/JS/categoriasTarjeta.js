$(document).ready(function(){
    switch (window.location.href){
        case "http://localhost/TarjetasDeCredito/admin/CategoriaTarjetas/":
            sessionStorage.removeItem("TarjetaCat");
            sessionStorage.removeItem("categoriasTarjeta");
            getAllCards();
            break;
        case "http://localhost/TarjetasDeCredito/admin/CategoriaTarjetas/detalle.html":
            let output = `<li class="list-group-item">Tarjeta:</li>
                          <li class="list-group-item">` + sessionStorage.getItem('TarjetaCat') + `</li>`;
            $("#tarjeta").html(output);
            getCategoriasTarjeta("detalle");
            break;
        case "http://localhost/TarjetasDeCredito/admin/CategoriaTarjetas/editar.html":
            if(sessionStorage.getItem("TarjetaCat")){
                getAllCategoria();
                $("#btnEnviar").click(function(e){
                    e.preventDefault();
                    updateCategoriasTarjeta();
                });
            }
            break;
    }

    setTimeout(function (){
        $(".btnDetalle").click(function (){
            sessionStorage.setItem('TarjetaCat',$(this).val());
            window.location.replace("http://localhost/TarjetasDeCredito/admin/CategoriaTarjetas/detalle.html");
        });
        $(".btnEditar").click(function (){
            sessionStorage.setItem('TarjetaCat',$(this).val());
            window.location.replace("http://localhost/TarjetasDeCredito/admin/CategoriaTarjetas/editar.html");
        });
    }, 2000);
});

function updateCategoriasTarjeta(){
    let categoriasTarjeta = [];
    let idCategoria = [];
    for(let i = 0; i < JSON.parse(sessionStorage.categoriasTarjeta).length; i++){
        categoriasTarjeta.push(JSON.parse(sessionStorage.categoriasTarjeta)[i].id_categoria);
    }
    $("input[name=categorias]").each(function(){
        if(this.checked)
        {
            if(!categoriasTarjeta.includes(this.value)){
                let categoria = {"id" : this.value, "idTarjeta" : sessionStorage.getItem('TarjetaCat'), "action": "insert"};
                idCategoria.push(categoria);
            }
        }else{
            if(categoriasTarjeta.includes(this.value)){
                let categoria = {"id" : this.value, "idTarjeta" : sessionStorage.getItem('TarjetaCat'), "action": "delete"};
                idCategoria.push(categoria);
            }
        }
    });
    console.log(categoriasTarjeta);
    console.log(idCategoria);
    try{
        if(idCategoria.length > 0){
            let JsonString = JSON.stringify(idCategoria);
            fetch('http://localhost/TarjetasDeCredito/app/tarjetas/updateCategoriasTarjeta', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JsonString
            }).then(response => response.json()).then(data => {
                if(data){
                    alert('Operacion realizada con exito!');
                    window.location="http://localhost/TarjetasDeCredito/admin/LugaresDePagoTarjeta/";
                }
            });
        }else{
            alert('No se encontraron cambios para modificar');
        }
    }catch (e){
        console.log(e);
    }
}

function getAllCategoria(){
    try{
        fetch('http://localhost/TarjetasDeCredito/app/categorys/all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                cargarDatos("editar", data);
                setTimeout(function(){
                    getCategoriasTarjeta("cargar");
                },1000);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function getAllCards(){
    try{
        fetch('http://localhost/TarjetasDeCredito/app/tarjetas/all').then(response => response.json()).then(data => {
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
                $('#dataCategoriasTarjetaBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function getCategoriasTarjeta(action){
    let idtarjeta = sessionStorage.getItem('TarjetaCat');
    const data = new FormData();
    data.append('id_tarjeta', idtarjeta);
    fetch('http://localhost/TarjetasDeCredito/app/tarjetas/getCategoriasTarjeta', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(Object.keys(data).length != 0){
            if(typeof data === 'object'){
                sessionStorage.setItem('categoriasTarjeta', JSON.stringify(data));
                cargarDatos(action, data);
            }
        }else{
            sessionStorage.setItem('categoriasTarjeta', JSON.stringify(data));
        }
    });
}

function formatearEspacios(string){
    let str = string.replace(/ /g, "-");
    console.log(str);
    return str;
}

function cargarDatos(action, data){
    let output = ``;
    switch (action){
        case "editar":
            output += `<li class="list-group-item">Categorias:</li>`;
            for(let i in data){
                console.log(data[i]);
                let id = formatearEspacios(data[i].titulo_categoria);
                output += `<li class="list-group-item"><input class="form-check-input me-1" name="categorias" id="${id}" type="checkbox" value="${data[i].id_categoria}" aria-label="">${data[i].titulo_categoria}</li>`;
            }
            $("#tarjeta").html(output);
            break;
        case "detalle":
            output += `<li class="list-group-item">Categorias:</li>`;
            for(let i in data){
                output += `<li class="list-group-item">${data[i].tituloCategoria}</li>`;
            }
            $("#categoriaTarjeta").html(output);
            break;
        case "cargar":
            for(let i in data){
                let id = formatearEspacios(data[i].tituloCategoria);
                console.log(id);
                $("#" + id).prop("checked", true);
            }
            break;
        default:
            console.log("error");
            break;
    }
}