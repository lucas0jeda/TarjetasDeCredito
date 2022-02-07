$(document).ready(function() {
   switch (window.location.href){
      case 'http://localhost/TarjetasDeCredito/admin/SistemaDePuntos/':
         sessionStorage.removeItem("sistemaDePuntosID");
         $("#addSisPuntos").click(function (){
            window.location.replace("http://localhost/TarjetasDeCredito/admin/SistemaDePuntos/crear.html");
         });
         getAllSistemasDePuntos();
         break;
      case "http://localhost/TarjetasDeCredito/admin/SistemaDePuntos/editar.html":
         if(sessionStorage.getItem("sistemaDePuntosID")){
            cargarDatosEdicion(sessionStorage.getItem("sistemaDePuntosID"));
            $("#btnEnviar").click(function (e){
               e.preventDefault();
               editSistemaDePuntos();
            });
         }
         break;
      case "http://localhost/TarjetasDeCredito/admin/SistemaDePuntos/crear.html":
         getAllCards();
         $("#btnEnviar").click(function (e){
            e.preventDefault();
            insertSistemaDePuntos();
         });
         break;
   }

   setTimeout(function (){
      $(".btnEditar").click(function (){
         sessionStorage.setItem('sistemaDePuntosID',$(this).val());
         window.location.replace("http://localhost/TarjetasDeCredito/admin/SistemaDePuntos/editar.html");
      });
      $(".btnEliminar").click(function (){
         let confirmationDelete = confirm("Estas seguro que deseas eliminar este sistema de puntos?");
         if(confirmationDelete){
            deleteSisDePuntos($(this).val());
         }
      });
   },2000);
});

function getAllSistemasDePuntos(){
   try{
      fetch('http://localhost/TarjetasDeCredito/app/sistemaDePuntos/all').then(response => response.json()).then(data => {
         if(typeof data === 'object'){
            let output = '';
            for(let i in data){
               output += `<tr>
                    <td>${data[i].id}</td>
                    <td>${data[i].Nombre}</td>
                    <td>${data[i].nombreTarjeta}</td>
                    <td>${data[i].id_tarjeta}</td>
                    <td><button type="button" class="btnEditar btn btn-primary" value="${data[i].id}">Editar</button></td>
                    <td><button type="button" class="btnEliminar btn btn-primary" value="${data[i].id}">Eliminar</button></td>
                <tr>`;
            }
            $('#dataSisPuntosBodyTable').html(output);
         }else{
            console.log("error");
         }
      })
   }catch (e){
      console.log(e);
   }
}

function cargarDatosEdicion(id){
   getAllCards();
   try{
      const data = new FormData();
      data.append('ID', id);
      fetch('http://localhost/TarjetasDeCredito/app/sistemaDePuntos/selectOneSistemaDePuntos', {
         method: "POST",
         body: data
      }).then(response => response.json()).then(data => {
         if(typeof data === 'object'){
            setTimeout(function (){
               $("#id").val(data.id);
               $("#tarjeta").val(data.id_tarjeta).change();
               $("#nombre").val(data.Nombre);
               let equivalencia = data.equivalencia;
               equivalencia = equivalencia.split('-');
               $("#equivalenciaPUno").val(equivalencia[0]);
               $("#monedaEquivalencia").val(equivalencia[1]).change();
               $("#equivalenciaPDos").val(equivalencia[2]);
               $("#informacion").val(data.informacion_adicional);
               $("#linkCatalogo").val(data.link_de_catalogo);
            },500)
         }else{
            console.log("error")
         }
      });
   }catch (e){
      console.log(e);
   }
}

function getAllCards(){
   try{
      fetch('http://localhost/TarjetasDeCredito/app/tarjetas/all').then(response => response.json()).then(data => {
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

function editSistemaDePuntos(){
   let id = $("#id").val();
   let tarjeta = $("#tarjeta").val();
   let nombre = $("#nombre").val();
   let equivalencia = $("#equivalenciaPUno").val() + "-" + $("#monedaEquivalencia").val() + "-" + $("#equivalenciaPDos").val();
   let informacion = $("#informacion").val();
   let link = $("#linkCatalogo").val();
   let data = new FormData();
   data.append('ID', id);
   data.append('tarjetaId', tarjeta);
   data.append('nombre', nombre);
   data.append('equivalencia', equivalencia);
   data.append('informacion', informacion);
   data.append('link', link);
   fetch('http://localhost/TarjetasDeCredito/app/sistemaDePuntos/updateSistemaDePuntos', {
      method: "POST",
      body: data
   }).then(response => response.json()).then(data => {
      if(data){
         alert("Sistema de puntos editado con exito!");
         window.location.replace("http://localhost/TarjetasDeCredito/admin/SistemaDePuntos/");
      }else{
         console.log("error");
      }
   });
}

function deleteSisDePuntos(id){
   let data = new FormData();
   data.append('ID', id);
   fetch('http://localhost/TarjetasDeCredito/app/sistemaDePuntos/deleteSistemaDePuntos', {
      method: "POST",
      body: data
   }).then(response => response.json()).then(data => {
      if(data){
         alert("Sistema de puntos eliminado con exito!");
         location.reload();
      }else{
         console.log("error");
      }
   });
}

function insertSistemaDePuntos(){
   let tarjeta = $("#tarjeta").val();
   let nombre = $("#nombre").val();
   let equivalencia = $("#equivalenciaPUno").val() + "-" + $("#monedaEquivalencia").val() + "-" + $("#equivalenciaPDos").val();
   let informacion = $("#informacion").val();
   let link = $("#linkCatalogo").val();
   let data = new FormData();
   data.append('tarjetaId', tarjeta);
   data.append('nombre', nombre);
   data.append('equivalencia', equivalencia);
   data.append('informacion', informacion);
   data.append('link', link);
   try{
      fetch('http://localhost/TarjetasDeCredito/app/sistemaDePuntos/insertSistemaDePuntos', {
         method: "POST",
         body: data
      }).then(response => response.json()).then(data => {
         if(data){
            alert("Sistema de puntos ingresado correctamente!");
            window.location.replace("http://localhost/TarjetasDeCredito/admin/SistemaDePuntos/");
         }else{
            console.log("error");
         }
      });
   }catch (e) {
      console.log(e);
   }

}

