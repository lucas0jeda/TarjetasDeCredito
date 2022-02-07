$( document ).ready(function() {
    let data =JSON.parse(sessionStorage.getItem('PublicEmisorCargar'));
    cargarDatosEmisor(data);
    cargarTarjetasPorEmisor(data.id_emisor);
});

function cargarTarjetasPorEmisor(idEmisor){
    try{
        const data = new FormData();
        data.append('id_emisor', idEmisor);
        fetch('/app/tarjetas/getTarjetasPorEmisor', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object') {
                let nombreEmisor = JSON.parse(sessionStorage.getItem('PublicEmisorCargar')).nombre;
                let output = `<h3 class="lbl-bold text-align-center main-title">Tarjetas ${nombreEmisor}</h3>`;
                for (let i in data) {
                    output += `
                        <div class="recommended-card custom-card">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="custom-card-image">
                                    <img src="./images/cardsImg/${data[i].imagen}" alt="card1" />
                                </div>
                                <div class="custom-card-buttons d-none d-md-block">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-9 custom-card-info">
                                <h1>${data[i].nombre}</h1>
                            <!--<p class="card-title-hint">
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
                                </p>--->

                                <div class="custom-card-buttons d-md-none">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                                </div>

                                <div class="row no-gutters card-features">
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
                                        <p class="d-none d-md-block">
                                            ${data[i].uso}
                                        </p>
                                        <p class="d-md-none">
                                            ${data[i].uso}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Cashback</h6>
                                        <p>
                                            ${replaceDataBit(data[i].cashback) ? replaceDataBit(data[i].cashback) : "No"}
                                        </p>
                                    </div>
                                </div>

                                <div class="card-details">
                                    <p>
                                        <i class="fa fa-check"></i>
                                        ${data[i].costo_de_emision.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data[i].costo_de_emision.replace(/(?:\r\n|\r|\n)/g, '</br>') : '-'}
                                    </p>
                                    <p>
                                        <i class="fa fa-check"></i>
                                        ${data[i].costo_primer_anio.replace(/(?:\r\n|\r|\n)/g, '</br>') ? data[i].costo_de_emision.replace(/(?:\r\n|\r|\n)/g, '</br>') : '-'}
                                    </p>
                                    <div class="show-more-details">
                                        <a href="javascript:void(0)" class="show-more-lnk">
                                            Show More
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="more-details">
                                            <p>
                                                <i class="fa fa-check"></i>
                                                No penalty APR. Paying late won't automatically raise your interest rate
                                                (APR). Other account pricing and terms apply
                                            </p>
                                            <p>
                                                <i class="fa fa-check"></i>
                                                Contactless Cards - The security of a chip card, with the convenience of
                                                a
                                                tap
                                            </p>
                                            <p>
                                                <i class="fa fa-check"></i>
                                                Access your FICO® Score for free within Online Banking or your Mobile
                                                Banking app
                                            </p>
                                        </div>
                                        <a href="javascript:void(0)" class="show-less-lnk d-none">
                                            Show Less
                                            <i class="fa fa-angle-up"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                }
                $("#cardsEmisor").html(output);
            }
        })
    }catch (e){
        console.log(e);
    }
}

function replaceDataBit(data){
    if(data == "1"){
        return "Si";
    }else{
        return "No";
    }
    return;
}

function cargarDatosEmisor(data){
    let result = data.descripcion.replace(/(?:\r\n|\r|\n)/g, '</br>');
    let output = `<div class="card-brand">
                <img src="images/emisorImg/logos/${data.logo}" width="100" height="35" alt="Card Brand Image" />
              </div>
                <h1>Tarjetas de crédito ${data.nombre}</h1>
                <p>
                    ${result}                    
                </p>`;
    $("#datosEmisor").html(output);
}
