function hideItems()
{
    $(".item").toggle();
}

$(document).ready(function()
{
    var item = $(".item");
    item.hover(function()
    {
        item.toggleClass("background-gradient-hover");
    });
});

function doAjax()
{
    //PETICION AJAX CON JQUERY
    $.ajax(
    {
        //Url a la que se hace la peticion.
        url: "http://localhost:3000/traer",

        //Metodo de la peticion.
        method: "GET",

        //Tipo de dato que se envia.
        dataType: "json",

        //Datos que se envian.
        data: {"collection":"posts"},

        //Success callback. Se ejecuta cuando la peticion es exitosa.
        success: function(result)
        {
            console.log("Success: ",result);
            appendList(result);
        },

        //Error callback. Se ejecuta cuando la peticion devuelve error.
        error: function( jqXHR, textStatus, errorThrow )
        {
            console.log( "Error: ", errorThrow );
            console.log( "Error status: ", textStatus );
        },

        //Complete callback. Se ejecuta luego del callback
        //Se ejecuta siempre, en caso de error y en caso exitoso tambien.
        complete: function( jqXHR, textStatus )
        {
            console.log( "Complete: ", textStatus );
        }

    });

}

function appendList(result)
{
    result.data.forEach(function(post)
    {
        var rowHTML = "<div class='row rowListCBF'>" +
                        "<div class='id col-xs-2' >" + post.id + "</div>" +
                        "<div class='titulo col-xs-4'>" + post.titulo + "</div>" +
                        "<div class='articulo col-xs-4'>" + post.articulo + "</div>" +
                        "<div class='fecha col-xs-2'>" + post.created_dttm + "</div>"+
                        "</div>";

        //Agrego el row del post al container.
        $("#postsContainer").append(rowHTML);
    }, this);
}