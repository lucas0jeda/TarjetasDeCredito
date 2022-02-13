$(document).ready(function () {
  let link = window.location.href;
  const explode = link.split(".com.uy");
  switch (explode[1]){
    case "/":
      sessionStorage.clear();
      categorias().then(data => {
        cargarCategorias(data);
        if(typeof data === 'object') {
          cargarNavCategorias(data, 1);
          cargarNavCategoriasMobile(data, 1);
        }
      });
      emisores().then(data => {
        if(typeof data === 'object') {
          cargarNavBancosYEmisores(data, 1);
          cargarBancosYEmioresMobile(data, 1);
        }
      });
      sellos().then(data => {
        if(typeof data === 'object') {
          cargarNavSellos(data, 1);
          cargarNavSellosMobile(data, 1);
        }
      });
      break;
    case "/#":
      sessionStorage.clear();
      categorias().then(data => {
        cargarCategorias(data);
        if(typeof data === 'object') {
          cargarNavCategorias(data, 1);
          cargarNavCategoriasMobile(data, 1);
        }
      });
      emisores().then(data => {
        if(typeof data === 'object') {
          cargarNavBancosYEmisores(data, 1);
          cargarBancosYEmioresMobile(data, 1);
        }
      });
      sellos().then(data => {
        if(typeof data === 'object') {
          cargarNavSellos(data, 1);
          cargarNavSellosMobile(data, 1);
        }
      });
    case "/category.html":
      categorias().then(data => {
        if(typeof data === 'object') {
          cargarNavCategorias(data, 1);
          cargarNavCategoriasMobile(data, 1);
        }
      });
      emisores().then(data => {
        if(typeof data === 'object') {
          cargarNavBancosYEmisores(data, 1);
          cargarBancosYEmioresMobile(data, 1);
        }
      });
      sellos().then(data => {
        if(typeof data === 'object') {
          cargarNavSellos(data, 1);
          cargarNavSellosMobile(data, 1);
        }
      });
      break;
    case "/emisor.html":
      categorias().then(data => {
        if(typeof data === 'object') {
          cargarNavCategorias(data, 1);
          cargarNavCategoriasMobile(data, 1);
        }
      });
      emisores().then(data => {
        if(typeof data === 'object') {
          cargarNavBancosYEmisores(data, 1);
          cargarBancosYEmioresMobile(data, 1);
        }
      });
      sellos().then(data => {
        if(typeof data === 'object') {
          cargarNavSellos(data, 1);
          cargarNavSellosMobile(data, 1);
        }
      });
      break;
    case "/credit-cards.html":
      categorias().then(data => {
        if(typeof data === 'object') {
          cargarNavCategorias(data, 1);
          cargarNavCategoriasMobile(data, 1);
        }
      });
      emisores().then(data => {
        if(typeof data === 'object') {
          cargarNavBancosYEmisores(data, 1);
          cargarBancosYEmioresMobile(data, 1);
        }
      });
      sellos().then(data => {
        if(typeof data === 'object') {
          cargarNavSellos(data, 1);
          cargarNavSellosMobile(data, 1);
        }
      });
      break;
  }

  $('[data-toggle="tooltip"]').tooltip();

  $(".mobile-nav-toggle").click(function () {
    $("#mobileSideNav").toggleClass("show", 1000);
    $("body").toggleClass("show-mobile-nav", 1000);
  });

  $(".drop-down-link").click(function () {
    $(this).parent().toggleClass("show-drop-down", 1000);
  });

  $(".card-details .show-more-details .show-more-lnk").click(function () {
    $(this).addClass("d-none");
    $(this).parent().find(".more-details").removeClass("d-none");
    $(this).parent().find(".show-less-lnk").removeClass("d-none");
  });

  $(".card-details .show-more-details .show-less-lnk").click(function () {
    $(this).addClass("d-none");
    $(this).parent().find(".more-details").addClass("d-none");
    $(this).parent().find(".show-more-lnk").removeClass("d-none");
  });

});

function cargarNavCategorias(data, cargar = 0){
  if(cargar == 1){
    let colUnoItems = [1,5,9,13];
    let colDosItems = [2,6,10,14];
    let colTresItems = [3,7,11,15];
    let colCuatroItems = [4,8,12,16];
    let col1 = '';
    let col2 = '';
    let col3 = '';
    let col4 = '';
    let contador = 1;
    let output = ``;
    for(let i in data) {
      if(contador <= 16){
        col1 = $("#colNavCategories1").html();
        col2 = $("#colNavCategories2").html();
        col3 = $("#colNavCategories3").html();
        col4 = $("#colNavCategories4").html();
        output = `
            <li>
                <a href="#" name="linksCategorias" id='${data[i].id_categoria}' onclick="redirectCategoriaTarjetas(this.id)">
                    <i class="fas fa-money-check-alt"></i>
                    ${data[i].titulo_categoria}
                </a>
            </li>`;
        if(colUnoItems.includes(contador)){
          $("#colNavCategories1").html(col1 + output);
        }
        if(colDosItems.includes(contador)){
          $("#colNavCategories2").html(col2 + output);
        }
        if(colTresItems.includes(contador)){
          $("#colNavCategories3").html(col3 + output);
        }
        if(colCuatroItems.includes(contador)){
          $("#colNavCategories4").html(col4 + output);
        }
        contador++;
      }else{
        break;
      }
    }
  }
}

function cargarNavCategoriasMobile(data, cargar = 0){
  if(cargar == 1){
    let contador = 1;
    let output = ``;
    for(let i in data) {
      if(contador <= 4){
        output += `
          <li>
            <a href="#" name="linksCategorias" id='${data[i].id_categoria}' onclick="redirectCategoriaTarjetas(this.id)">
                <i class="fas fa-money-check-alt"></i>
                ${data[i].titulo_categoria}
            </a>
          </li>
        `;
      }
    }
    $("#navCategoriasMobile").html(output);
  }
}

function cargarNavBancosYEmisores(data, cargar = 0){
  if(cargar == 1){
    let colUnoItems = [1,5,9,13];
    let colDosItems = [2,6,10,14];
    let colTresItems = [3,7,11,15];
    let colCuatroItems = [4,8,12,16];
    let col1 = '';
    let col2 = '';
    let col3 = '';
    let col4 = '';
    let contador = 1;
    let output = ``;
    for(let i in data) {
      if(!sessionStorage.getItem('emisor_' + data[i].id_emisor)){
        sessionStorage.setItem('emisor_' + data[i].id_emisor, JSON.stringify(data[i]));
      }
      if(contador <= 16){
        col1 = $("#colNavEmisores1").html();
        col2 = $("#colNavEmisores2").html();
        col3 = $("#colNavEmisores3").html();
        col4 = $("#colNavEmisores4").html();
        output = `
            <li>
                <a href="#" name="linksCategorias" id='${data[i].id_emisor}' onclick="redirectEmisoresTarjetas(this.id)">
                    <i class="fas fa-university"></i>
                    ${data[i].nombre}
                </a>
            </li>`;
        if(colUnoItems.includes(contador)){
          $("#colNavEmisores1").html(col1 + output);
        }
        if(colDosItems.includes(contador)){
          $("#colNavEmisores2").html(col2 + output);
        }
        if(colTresItems.includes(contador)){
          $("#colNavEmisores3").html(col3 + output);
        }
        if(colCuatroItems.includes(contador)){
          $("#colNavEmisores4").html(col4 + output);
        }
        contador++;
      }else{
        break;
      }
    }
  }
}

function cargarBancosYEmioresMobile(data, cargar = 0){
  if(cargar == 1){
    let contador = 1;
    let output = ``;
    for(let i in data) {
      if(contador <= 4){
        output += `
          <li>
            <a href="#" name="linksCategorias" id='${data[i].id_emisor}' onclick="redirectEmisoresTarjetas(this.id)">
                <i class="fas fa-university"></i>
                ${data[i].nombre}
            </a>
          </li>
        `;
      }
    }
    $("#navEmisoresMobile").html(output);
  }
}

function cargarNavSellos(data, cargar = 0){
  if(cargar == 1){
    let colUnoItems = [1,4,7,10];
    let colDosItems = [2,5,8,11];
    let colTresItems = [3,6,9,12];
    let col1 = '';
    let col2 = '';
    let col3 = '';
    let contador = 1;
    let output = ``;
    for(let i in data) {
      if(contador <= 12){
        col1 = $("#colNavSellos1").html();
        col2 = $("#colNavSellos2").html();
        col3 = $("#colNavSellos3").html();
        output = `
            <li>
                <a href="#" name="linksCategorias" id='${data[i].id_sello}'>
                    <i class="fas fa-credit-card"></i>
                    ${data[i].nombre}
                </a>
            </li>`;
        if(colUnoItems.includes(contador)){
          $("#colNavSellos1").html(col1 + output);
        }
        if(colDosItems.includes(contador)){
          $("#colNavSellos2").html(col2 + output);
        }
        if(colTresItems.includes(contador)){
          $("#colNavSellos3").html(col3 + output);
        }
        contador++;
      }else{
        break;
      }
    }
  }
}

function cargarNavSellosMobile(data, cargar = 0){
  if(cargar == 1){
    let contador = 1;
    let output = ``;
    for(let i in data) {
      if(contador <= 4){
        output += `
          <li>
            <a href="#" name="linksCategorias" id='${data[i].id_sello}'>
                <i class="fas fa-credit-card"></i>
                ${data[i].nombre}
            </a>
          </li>
        `;
      }
    }
    $("#navSellosMobile").html(output);
  }
}


function categorias(){
    try{
      return fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=categorys&action=all').then(response => response.json());
    }catch (e) {
      console.log(e);
    }
}

function emisores(){
  try{
    return fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=emisores&action=all').then(response => response.json());
  }catch (e) {
    console.log(e);
  }
}

function sellos(){
  try{
    return fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=sellos&action=all').then(response => response.json());
  }catch (e) {
    console.log(e);
  }
}


function cargarCategorias(data){
  try{
    if(typeof data === 'object'){
      let output = ``;
      for(let i in data){
        if(!sessionStorage.getItem('categoria_' + data[i].id_categoria)){
          sessionStorage.setItem('categoria_' + data[i].id_categoria, JSON.stringify(data[i]));
        }
        if(i < 6){
          output += `<div class="col-12 col-md-6 col-lg-4">
                        <a href="#" name="linksCategorias" id='${data[i].id_categoria}' onclick="redirectCategoriaTarjetas(this.id)">
                            ${data[i].titulo_categoria}
                            <span class="material-icons">
                                arrow_forward
                            </span>
                        </a>
                    </div>`;
        }else{
          output += `<div class="col-12 col-md-6 col-lg-4 Categoriainvisible" style="display: none;">
                            <a href="#" name="linksCategorias" id='${data[i].id_categoria}' onclick="redirectCategoriaTarjetas(this.id)">
                                ${data[i].titulo_categoria}
                                <span class="material-icons">
                                    arrow_forward
                                </span>
                            </a>
                        </div>`;
        }
      }
      $("#categorias").html(output);
    }else{
      console.log("error");
    }
  }catch(e){
    console.log(e);
  }
}

function mostrarMasCategorias(){
  let btn = $("#btnMostrarMasCategorias");
  if(btn.val() == 0){
    $("div.Categoriainvisible").attr('style','');
    btn.val(1);
    let txt = btn.text();
    btn.text(txt.replace('Show More','Show Less'));
  }else{
    $("div.Categoriainvisible").attr('style','display: none;');
    let txt = btn.text();
    btn.text(txt.replace('Show Less','Show More'));
    btn.val(0);
  }
}

function redirectCategoriaTarjetas(data){
  let result = sessionStorage.getItem('categoria_' + data);
  sessionStorage.setItem('PublicCategoriaCargar', result);
  if(sessionStorage.getItem("PublicCategoriaCargar")){
    window.location="http://www.tarjetasdecredito.com.uy/category.html";
  }
}

function redirectEmisoresTarjetas(data){
  let result = sessionStorage.getItem('emisor_' + data);
  sessionStorage.setItem('PublicEmisorCargar', result);
  if(sessionStorage.getItem("PublicEmisorCargar")){
    window.location="http://www.tarjetasdecredito.com.uy/emisor.html";
  }
}
  /*const handleImageUpload = event => {
    const files = event.target.files;
    const formData = new FormData();
    formData.append('imagen', files[0])
    fetch('http://www.tarjetasdecredito.com.uy/app.php?controller=tarjetas&action=guardarImagen', {
    method: 'POST',
    body: formData
  }).then(response => response.json()).then(data => {
      console.log(data);
    })
}*/
