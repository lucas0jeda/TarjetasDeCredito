$( document ).ready(function() {
    let data =JSON.parse(sessionStorage.getItem('PublicCategoriaCargar'));
    cargarDatosCategoria(data);
    cargarTarjetasCategria(data.id_categoria);
});

function cargarDatosCategoria(data){
    //let result = data.informacion.replace(/(?:\r\n|\r|\n)/g, '</p><p class="md-font-size">');
    let result = data.informacion.replace(/(?:\r\n|\r|\n)/g, '</br>');
    let output = `<h1 class="lbl-bold">${data.titulo_categoria}</h1>
                  <p class="md-font-size">
                            ${result}
                  </p>`
    $("#startInformationCategory").html(output);
}


function cargarTarjetasCategria(idCategoria){
    try{
        const data = new FormData();
        data.append('id_categoria', idCategoria);
        fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=getTarjetasCategoria', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = ``;
                for(let i in data){
                    console.log(data[i]);
                    output += `<div class="recommended-card custom-card">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="custom-card-image">
                                    <img src="./images/cardsImg/${data[i].imagen}" alt="${data[i].imagen}" />
                                </div>
                                <div class="custom-card-buttons d-none d-md-block">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-9 custom-card-info">
                                <h2>${data[i].nombre}</h2>
                                <!---<p class="card-title-hint">
                                    <span>iExcelente!</span>
                                    <span class="material-icons custom-star active-star">
                                        star_rate
                                    </span>
                                    <span class="material-icons custom-star active-star">
                                        star_rate
                                    </span>
                                    <span class="material-icons custom-star active-star">
                                        star_rate
                                    </span>
                                    <span class="material-icons custom-star active-star">
                                        star_rate
                                    </span>
                                    <span class="material-icons custom-star">
                                        star_rate
                                    </span>
                                    <span>19 oponioniones</span>
                                </p> --->

                                <div class="custom-card-buttons d-md-none">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles</a>
                                </div>

                                <div class="row no-gutters card-features">
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Emisor</h6>
                                        <p class="d-none d-md-block">
                                            ${data[i].NombreEmisor}
                                        </p>
                                        <p class="d-md-none">
                                            ${data[i].NombreEmisor}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Tipo</h6>
                                        <p class="d-none d-md-block">
                                            ${data[i].tipo}
                                        </p>
                                        <p class="d-md-none">
                                            ${data[i].tipo}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Uso</h6>
                                        <p>
                                            ${data[i].uso}
                                        </p>
                                    </div>
                                </div>

                                <div class="card-details">
                                    <p>
                                        <i class="fa fa-check"></i>
                                        ${data[i].costo_de_emision.replace(/(?:\r\n|\r|\n)/g, '</br>')}
                                    </p>
                                    <p>
                                        <i class="fa fa-check"></i>
                                        ${data[i].costo_primer_anio.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data[i].costo_primer_anio.replace(/(?:\r\n|\r|\n)/g, '</br>') : '-'}
                                    </p>
                                    <div class="show-more-details">
                                        <a href="javascript:void(0)" class="show-more-lnk">
                                            Show More
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!--FIN ROW--->
                    </div>`;


                }
                $("#cards").html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}