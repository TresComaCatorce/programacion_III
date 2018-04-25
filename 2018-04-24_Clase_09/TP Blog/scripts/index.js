//-----------------------------------
// Declaracion de variables globales.
//-----------------------------------
var xhr;
var datos = new Array();
//-----------------------------------



//--------------------------------------------------------------------------------
// Funciones que se ejecutan cuando carga la pagina (Una vez cargado todo el DOM).
//--------------------------------------------------------------------------------
window.onload = function()
{
    cargarDatos();
}
//--------------------------------------------------------------------------------



//------------------------------------------------------------------------
// Traigo los articulos del blog desde el servidor con una peticion AJAX.
//------------------------------------------------------------------------
function cargarDatos()
{
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
           var resp = JSON.parse(this.response);
           console.log(resp.message, resp.data);
           refrescarTabla(resp.data);
           datos = resp.data;
        }
    };
    xhr.open("POST","http://localhost:3000/traer",true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify({"collection":"posts"}));
}
//------------------------------------------------------------------------



//--------------------------------------------------------------------------------
// Funcion que dibuja la tabla de articulos existententes en la pagina.
// @param <arrayArticulos> Array de objetos javascript con los articulos del blog.
//--------------------------------------------------------------------------------
function refrescarTabla( arrayArticulos )
{
    if(arrayArticulos)
    {
        arrayArticulos.forEach(function(item)
        {
            articuloHTML = '<div class="row">'+ item.titulo + '</div><div class="row">' + item.articulo + '</div><div class="row">' + item.created_dttm + '</div>';
            $('#articulos').html(articuloHTML);
        });
    }
}
//--------------------------------------------------------------------------------
