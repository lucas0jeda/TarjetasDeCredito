$(document).ready(function () {

  $('[data-toggle="tooltip"]').tooltip();

  $(".mobile-nav-toggle").click(function () {
    $("#mobileSideNav").toggleClass("show", 1000);
    $("body").toggleClass("show-mobile-nav", 1000);
  });

  $(".drop-down-link").click(function () {
    $(this).parent().toggleClass("show-drop-down", 1000);
  });

  $(".card-details .show-more-details .show-more-lnk").click(function () {
    $(this).addClass("d-none");
    $(this).parent().find(".more-details").removeClass("d-none");
    $(this).parent().find(".show-less-lnk").removeClass("d-none");
  });

  $(".card-details .show-more-details .show-less-lnk").click(function () {
    $(this).addClass("d-none");
    $(this).parent().find(".more-details").addClass("d-none");
    $(this).parent().find(".show-more-lnk").removeClass("d-none");
  });

});

