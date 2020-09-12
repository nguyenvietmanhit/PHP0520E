$(document).ready(function () {

  var closeNavigate = function () {
    $('.overlay').hide();
    $('.sidebar').removeClass('opened');
    $('body').removeClass('fixed');
  }

  //close sidebar panel, clicked overlay and close sidebar button.
  $('.overlay, .sidebar-toggle-button').on('click', function () {
    closeNavigate();
  });

//sidebar navigation close method.
  var openNavigate = function () {
    if ($(window).width() < 760)
      $('body').addClass('fixed');
    $('.overlay').show();
    $('.sidebar').addClass('opened');
  }

  //sidebar menu click event. open when clicked.
  $('.toggle-sidebar').on('click', function () {
    openNavigate();
  });

  $('.material-button').on('click', function (e) {
    $('.material-button').not($(this)).next('.header-submenu').hide();
    // addWaveEffect($(this), e);
    $(this).next('.header-submenu').toggleClass('active');
  });

});