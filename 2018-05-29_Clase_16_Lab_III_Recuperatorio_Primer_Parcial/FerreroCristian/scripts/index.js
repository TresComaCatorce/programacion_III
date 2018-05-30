var xhr;
var datos = new Array();

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
            for( var i=0 ; response.data.length > i ; i++ )
            {
                var post = response.data[i];
                
                if( post.active )
                {
                    $('#postsContainer').append("<div class='col-sm-12 col-md-6'><div><h1 class='post-title'>" + post.titulo + "</h1></div><div><img class='img-fluid' src='img/imagen_2.jpg' alt='Imagen puente de la torre'></div><div><span class='post-content'>" + post.articulo + "</span></div><div><span class='post-mas'>" + post.mas + "</span></div><div><span class='post-date'>" + post.created_dttm + "</span></div></div>");
                }
            }

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

window.onload = function(){
    cargarDatos();
}

function toggleSpinner()
{
    $("#spinner").toggle();
}