var posts = new Array();

var req;

window.onload = function()
{
    console.log('onload');

    //Dibujo los posts.
    renderPosts();
};





function renderPosts( )
{
    req = new XMLHttpRequest();

    //Abro spinner
    openSpinner();
    
    //Creo el success callback
    req.onreadystatechange = function()
    {
        if(this.readyState==4 && this.status ==200)
        {
            //Parse de la respuesta.
            posts = JSON.parse(req.response).data;

            //Recorro el array de posts.
            if(posts)
            {
                //Creo el elemento html para agregar.
                var tablaHTML = "<table><tr class='thead'><td>ID</td><td>Fecha</td><td>Titulo</td><td>Contenido</td><td>Coleccion</td><td>Acciones</td></tr>";
                
                for(var i=0;i<posts.length;i++)
                {
                    var post = posts[i];
                    //console.log('post: ', post);

                    tablaHTML = tablaHTML + "<tr><td>" + post.id + "</td><td>" + post.created_dttm + "</td><td>" + post.titulo + "</td><td>" + post.articulo + "</td><td>" + post.collection + "</td><td><button onclick='editarPost(" + post.id + ")'>Editar</button><button onclick='eliminarPost(" + post.id + ")'>ELIMINAR</button></td></tr>";
                }

                tablaHTML = tablaHTML + "<tr> <td></td> <td></td> <td><input type='text' id='titulo'></td> <td><input type='text' id='contenido'></td> <td><input type='text' id='coleccion'></td><td><button onclick='enviarAlta()'>Agregar</button></td></tr></table>";

                //Selecciono el contenedor.
                var elemento = document.getElementById('bl-posts-list-container');

                //Append del html armado al elemento.
                elemento.innerHTML = tablaHTML;
            }
            //Cierro el spinner.
            closeSpinner();
        }
        else if( this.status ==500 || this.status == 404 )
        {
            //closeSpinner();
        }
    }

    //Envio la llamada.
    req.open("GET", "/traer?collection=posts", true);
    req.send();
}

function openSpinner()
{
    var elem = document.getElementById('spinner');

    elem.classList.add('active');
}

function closeSpinner()
{
    var elem = document.getElementById('spinner');

    elem.classList.remove('active');
}

function editarPost( id )
{
    
}

function eliminarPost( ide )
{
    //Abro spinner
    openSpinner();

    req = new XMLHttpRequest();
    var datos =
    {
        collection : "posts",
        id : ide
    };

    req.onreadystatechange = function()
    {
        if(this.readyState==4 && this.status ==200)
        {
            closeSpinner();
            renderPosts();
        }
    };

    req.open("POST","/eliminar",true);
    req.setRequestHeader("Content-Type", "application/json");

    req.send(JSON.stringify(datos));
}



function enviarAlta()
{
    //Abro spinner
    openSpinner();

    var title = document.getElementById('titulo').value;
    var cont = document.getElementById('contenido').value;

    var datos =
    {
        titulo : title,
        collection : "posts",
        articulo : cont
    }
    
    req = new XMLHttpRequest();
    req.onreadystatechange = function()
    {
        if(this.readyState==4 && this.status ==200)
        {
            closeSpinner();
            renderPosts();
        }
    };
    req.open("POST","/agregar",true);
    req.setRequestHeader("Content-Type", "application/json");
    req.send(JSON.stringify(datos));
}