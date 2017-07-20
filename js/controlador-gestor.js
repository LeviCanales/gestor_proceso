//La que ordena los procesos, los agranda al tocar.
var $grid = $('.grid').imagesLoaded( function() {
  // init Masonry after all images have loaded
  $grid.masonry({
    columnWidth: 10
  });
});
$grid.on( 'click', '.grid-item', function() {
  $(this).toggleClass('gigante');
  // trigger layout after item size changes
  $grid.masonry('layout');
});
$('.grid').highlight('False');
$('.grid').highlight('Proceso Fallido');
 //Funcion para Subir Archivo.
$(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "ajax/ajax-proceso.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    location.href ="";
                }
            });
        });
     });
//Para compara la contraseña
$("#btn-contra").click(function(){
      if($().crypt({method:"sha1",source:$("#contra").val()})=="fc61330e819610cfccfc8b2fb37678a9ffbd3f4d"){
      	$("#cuadro-contra").hide();
      	$("#subir").show();
      }else{
      	$("#invalido").html("<span class='highlight'>Contraseña Invalida</span>");
      }
});
//Pasar los procesos por ajax:
$("#ejecutar").click(function(){
	$("#iniciar").button("loading");
	$("#spin").show();
	if (!($("#numero_ciclos").val().length==0)) {
		var procesos ="numero_ciclos="+$("#numero_ciclos").val();
		procesos += "&"+"tamanio_proceso="+$("#tamanio_proceso").val();
		for (var i = 0; i < Number($("#tamanio_proceso").val()); i++) {
			procesos +=  "&" +"proceso"+i+"="+$("#proceso"+i).val();
		}
		//alert(procesos);
		$.ajax({
			url:"ajax/acciones.php?accion=1",
			data: procesos,
			method: "POST",
			success: function(resultado){
				$("#spin").hide();
				$("#resultado").html(resultado);
			},
			error: function(){
				alert("No dio");
			}
		});
	}
	$("#iniciar").button("reset");
});