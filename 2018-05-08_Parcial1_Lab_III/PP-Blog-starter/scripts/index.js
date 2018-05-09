window.onload = function()
{
    console.log('onload');
    //Abro spinner
    openSpinner();

    //Creo el request.
    var req = new XMLHttpRequest();
    
    //Creo el success callback
    req.onreadystatechange = function()
    {
        if(this.readyState==4 && this.status ==200)
        {
            //Parse de la respuesta.
            var posts = JSON.parse(req.response);

            //Dibujo los posts.
            renderPosts(posts);

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
};


function renderPosts( posts )
{
    //Recorro el array de posts.
    if(posts.data)
    {
        for(var i=0;i<posts.data.length;i++)
        {
            var post = posts.data[i];
            console.log('post: ', post);

            //Solo si el post esta activo.
            if( post.active )
            {
                //Creo el elemento html para agregar.
                var postHTML = "<div class='bl-post' id='bl-post-" + i + "'><h3 class='bl-title'>" + post.titulo + "</h3><div class='bl-content'>" + post.articulo + "</div><img src='img/imagen_" + i + ".jpg'/><div class='bl-collection-date-container'><div class='bl-collection'>Coleccion:" + post.collection + "</div><div class='bl-date'>Agregado el: " + post.created_dttm + "</div></div></div>";
                
                //Selecciono el contenedor.
                var elemento = document.getElementById('bl-posts-container');

                //Append del html armado al elemento.
                elemento.innerHTML = elemento.innerHTML + postHTML;
            }
        }


    }
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