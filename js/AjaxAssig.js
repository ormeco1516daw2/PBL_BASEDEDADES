var nom_alumne="";

$(document).ready(function() {

	console.log($('#Modifica_alum').val());
	recuperarUsuarios($('#Modifica_alum').val());
	 $('#Modifica_alum').change(function(){
	 	nom_alumne=$(this).val();
	 	recuperarUsuarios(nom_alumne);
	 });
});

function recuperarUsuarios(_nom_alumne)
{
    try
    {
            
        $.ajax(
            {   // puede ser "get" y "post"
                type: "post",
                url: "ConsultaAjax.php",
                // los datos para la consulta
                data: {'nom_alumne':_nom_alumne},
                dataType:"json",
                // que hacer si funciona 
                success: recuperarUsuarios_callback
            });
    }
    catch(ex)
    {}
    
}

function recuperarUsuarios_callback(ajaxResponse, textStatus)
{   console.log(ajaxResponse);
    var assignaturas = ajaxResponse;
    if (!assignaturas)
    {
        // no se encontraron registros :(
        return;
    }
    $('#Modifica_assig').html("");
    $('#Modifica_assig').append(
       	'<option value=""></option>'
            );
    for (var i=0;i<assignaturas.length ; i++)
    {
       $('#Modifica_assig').append(
       	'<option value="'+assignaturas[i]+'">'+assignaturas[i]+'</option>'
            ); 
    } 
}