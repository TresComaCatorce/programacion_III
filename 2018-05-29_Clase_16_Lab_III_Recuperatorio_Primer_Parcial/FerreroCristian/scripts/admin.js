var postAModificar;

window.onload = function()
{
    //Si no tengo token redirecciono a loggin.
    console.log('token: ', sessionStorage.getItem('token'));    

    if( !sessionStorage.getItem('token') )
    {
        window.location.replace('/login.html');
    }
    else
    {
        cargarDatos();
    }
};

function guardar(){
           //modificacion o alta?
}


function limpiarFormulario()
{
    //limpia el formulario
}

function enviarAlta(data)
{
    //console.log('alta: ', $('#post-title-new')[0].value);
    toggleSpinner();

    $.ajax(
    {
        url: "/agregar",
        method: "POST",
        data:
        {
            collection: "posts",
            titulo: $('#post-title-new')[0].value,
            articulo: $('#post-article-new')[0].value,
            mas: "",
        },
        success: function(response)
        {
            console.log('alta succ: ', response);
            cargarDatos();
        },
        error: function(data)
        {
            console.log("Error alta: ", data)
        },
        headers:
        {
            'authorization' : sessionStorage.getItem('token')//recuperar token del sessionStorage
        },
        complete: function()
        {
            toggleSpinner();
        }
    });
}

function cargarDatos()
{
    toggleSpinner();

    $.ajax(
    {
        url: "/traer",
        method: "GET",
        data: {collection:"posts"},
        success: function(response)
        {
            $('#tblPosts>thead').html("");
            $('#tblPosts>tbody').html("");

            $('#tblPosts>thead').append("<tr><th>ID</th><th>Fecha</th><th>Titulo</th><th>Articulo</th><th>Modificar</th><th>Borrar</th></tr>");

            for( var i=0 ; response.data.length > i ; i++ )
            {
                var post = response.data[i];
                
                $('#tblPosts>tbody').append("<tr><td>" + post.id + "</td><td><span id='post-date-" + post.id + "'>" + post.created_dttm + "</span></td><td><input disabled id='post-title-" + post.id + "' value='" + post.titulo + "'/></td><td><input disabled id='post-article-" + post.id + "'value='" + post.articulo + "'/></td><td><button class ='btn btn-warning' id='post-modificar-guardar-" + post.id + "' onclick='modificar(" + post.id + ")'>Modificar</button></td><td><button class ='btn btn-warning' onclick='borrar(" + post.id + ")'>Borrar</button></td></tr>");
            }

            $('#tblPosts>tbody').append("<tr><td></td><td></td><td><input id='post-title-new' value=''/></td><td><input id='post-article-new' value=''/></td><td><button class ='btn btn-warning' id='post-nuevo' onclick='enviarAlta()'>Agregar Post</button></td><td></td></tr>");

        },
        error: function(data)
        {
            console.log("Error: ", data)
        },
        complete: function()
        {
            toggleSpinner();
        }
    });
}

function borrar(idPostABorrar)
{
    $.ajax(
    {
        url: "/eliminar",
        method: "POST",
        data:
        {
            collection : "posts",
            id : idPostABorrar
        },
        success: function(){
            cargarDatos()
        },

        error: function(data)
        {
            console.log("Error baja: ", data)
        }
    });
}


function modificar(id)
{
    postAModificar = id;
    //Habilito los input.
    $('#post-title-'+id)[0].disabled = false;
    $('#post-article-'+id)[0].disabled = false;
    //Cambio el texto del boton.
    $('#post-modificar-guardar-'+id)[0].textContent  = 'Guardar';
    //Cambio el boton del boton.
    $('#post-modificar-guardar-'+id)[0].onclick = guardarModif;
}

function guardarModif(a,b,c)
{
    $('#post-title-'+postAModificar)[0].disabled = true;
    $('#post-article-'+postAModificar)[0].disabled = true;
    $('#post-modificar-guardar-'+postAModificar)[0].textContent  = 'Modificar';
    /*console.log('GUARDAR');
    console.log('titulo: ', $('#post-title-'+postAModificar)[0].value);
    console.log('art: ', $('#post-article-'+postAModificar)[0].value);
    console.log('date: ', $('#post-date-'+postAModificar)[0].innerText);*/
    
    var newTitulo = $('#post-title-'+postAModificar)[0].value;
    var newArt = $('#post-article-'+postAModificar)[0].value;
    var theDate = $('#post-date-'+postAModificar)[0].innerText;

    var myData =
    {
        "titulo": newTitulo,
        "articulo": newArt,
        "mas": "",
        "collection": "posts",
        "id": postAModificar,
        "active" : true,
        "created_dttm" : theDate
    }

    $.ajax(
    {
        url: "/modificar",
        method: "POST",
        data: myData,
        success: function(response)
        {
            console.log('Succ modif: ',response);
            cargarDatos();
        },

        error: function(data)
        {
            console.log("Error modif: ", data)
        }
    });
}

function toggleSpinner()
{
    $("#spinner").toggle();
}