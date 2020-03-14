$(".wheel-button").wheelmenu({
  trigger: "hover",
  animation: "fade",
  animationSpeed: "instant"
});

$(function() {
  $("#editByClient").click(function() {
      $("#editClientByClient").submit();
  });
});