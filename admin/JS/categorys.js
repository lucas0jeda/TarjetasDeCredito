$( document ).ready(function() {
    switch (window.location.href){
        case "http://localhost/TarjetasDeCredito/admin/Categorias/editar.html":
            if(sessionStorage.getItem("category")){
                cargarDatosEdicion(sessionStorage.getItem("category"));
               $("#btnEnviar").click(function (e){
                    e.preventDefault();
                    editCategory();
                });
            }
            break;
        case "http://localhost/TarjetasDeCredito/admin/Categorias/crear.html":
            console.log("ok");
            $("#btnEnviar").click(function (e){
                e.preventDefault();
                insertCategory();
            });
            break;
        case "http://localhost/TarjetasDeCredito/admin/Categorias/":
            sessionStorage.removeItem("category");
            $("#addCategory").click(function (){
                window.location.replace("http://localhost/TarjetasDeCredito/admin/Categorias/crear.html");
            });
            getAllCategorys();
            break;
    }

    setTimeout(function (){
        $(".btnEditar").click(function (){
            sessionStorage.setItem('category',$(this).val());
            window.location.replace("http://localhost/TarjetasDeCredito/admin/Categorias/editar.html");
        });
        $(".btnEliminar").click(function (){
            let confirmationDelete = confirm("Estas seguro que deseas eliminar esta categoria?");
            if(confirmationDelete){
                deleteCategory($(this).val());
            }
        });
    },2000);
});

function getAllCategorys(){
    try{
        fetch('http://localhost/TarjetasDeCredito/app/categorys/all').then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                let output = '';
                for(let i in data){
                    output += `<tr>
                    <td>${data[i].id_categoria}</td>
                    <td>${data[i].titulo_categoria}</td>
                    <td>${data[i].informacion}</td>   
                    <td><button type="button" class="btnEditar" value="${data[i].id_categoria}">Editar</button></td>
                    <td><button type="button" class="btnEliminar" value="${data[i].id_categoria}">Eliminar</button></td>
                <tr>`;
                }
                $('#dataCategorysBodyTable').html(output);
            }else{
                console.log("error");
            }
        })
    }catch (e) {
        console.log(e);
    }
}

function cargarDatosEdicion(idCategory){
    try{
        const data = new FormData();
        data.append('ID', idCategory);
        fetch('http://localhost/TarjetasDeCredito/app/categorys/selectOneCategory', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(typeof data === 'object'){
                $("#id").val(data.id_categoria);
                $("#titulo_categoria").val(data.titulo_categoria);
                $("#informacion").val(data.informacion);
            }else{
                console.log("error")
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function editCategory(){
    try{
        let id = $("#id").val();
        let titulo = $("#titulo_categoria").val();
        let informacion = $("#informacion").val();
        const data = new FormData();
        data.append('ID', id);
        data.append('titulo', titulo);
        data.append('informacion', informacion);
        fetch('http://localhost/TarjetasDeCredito/app/categorys/updateCategory', {
            method: "POST",
            body: data
        }).then(response => response.json()).then(data => {
            if(data){
                alert("Categoria editada con exito!");
                window.location.replace("http://localhost/TarjetasDeCredito/admin/Categorias/");
            }else{
                console.log("error");
            }
        });
    }catch (e) {
        console.log(e);
    }
}

function deleteCategory(idCategory){
    const data = new FormData();
    data.append('ID', idCategory);
    fetch('http://localhost/TarjetasDeCredito/app/categorys/deleteCategory', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            alert("Categoria eliminada con exito!");
            location.reload();
        }else{
            console.log("error");
        }
    });
}

function insertCategory(){
    let titulo = $("#titulo_categoria").val();
    let informacion = $("#informacion").val();
    const data = new FormData();
    data.append('titulo', titulo);
    data.append('informacion', informacion);
    fetch('http://localhost/TarjetasDeCredito/app/categorys/insertCategory', {
        method: "POST",
        body: data
    }).then(response => response.json()).then(data => {
        if(data){
            console.log("OK");
            alert("Categoria Ingresada correctamente!");
            window.location.replace("http://localhost/TarjetasDeCredito/admin/Categorias/");
        }else{
            console.log("error");
        }
    });
}



