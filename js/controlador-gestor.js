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
            var ruta = "ajax-proceso.php";
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