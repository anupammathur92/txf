$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
  $('.nav-menu li:has(ul)').closest('.nav-item').addClass('menu-has-children');
  $('.menu-has-children').children('.nav-link').addClass('toogleLink');
  $('.menu-has-children').children('.nav-link').append('<span class="float-right"><i class="far fa-chevron-right"></i></span>');
  $('.toogleLink').click(function(){
    $(this).toggleClass('active');
  })
});
