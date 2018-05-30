window.onload = function()
{
    $('form').on('submit', function(e){
        //como tengo un form, debo evitar el comportamiento por default.
        e.preventDefault();  
    });

    $("#btnLogIn").click(function(e){;
        //lamar a login
        login();
    });

};

function login()
{
    //preparo la data para enviar
    var usuarioIngresado = $('#txtUsuario')[0].value;
    var passIngresado = $('#txtPassword')[0].value;

    data =
    {
        "usuario": usuarioIngresado,
        "password": passIngresado
    };

    $.ajax({
        url: "/login", 
        method: "POST",
        success: function(result,status,response)
        {
            sessionStorage.setItem( "token" , result.token );
            window.location.replace(response.getResponseHeader('redirect'));
        },
        
        error: function(jqXHR,textStatus,errorThrown )
        {
            console.log('Error login: ', errorThrown);
        }
    });
}