var $grid = $('.grid').imagesLoaded( function() {
  // init Masonry after all images have loaded
  $grid.masonry({
    columnWidth: 40
  });
});
$grid.on( 'click', '.grid-item', function() {
  $(this).toggleClass('gigante');
  // trigger layout after item size changes
  $grid.masonry('layout');
});
$('.grid').highlight('False');
$('.grid').highlight('Proceso Fallido');