$(function(){
			  var patentes = [ 

			   {value: "asd345" , data: " 2015-09-16 00:51:17 " }, 
 {value: "asd233" , data: " 2018-04-10 00:44:06 " }, 
 {value: "asd233" , data: " 2018-04-10 00:44:20 " }, 
 {value: "asd233" , data: " 2018-04-10 00:44:28 " }, 
 {value: "gay666" , data: " 2018-04-10 00:45:27 " }, 
 {value: "gfd233" , data: " 2018-04-10 00:45:38 " }, 

			   
			  ];
			  
			  // setup autocomplete function pulling from patentes[] array
			  $('#autocomplete').autocomplete({
			    lookup: patentes,
			    onSelect: function (suggestion) {
			      var thehtml = '<strong>patente: </strong> ' + suggestion.value + ' <br> <strong>ingreso: </strong> ' + suggestion.data;
			      $('#outputcontent').html(thehtml);
			         $('#botonIngreso').css('display','none');
      						console.log('aca llego');
			    }
			  });
			  

			});