const searchParams = new URLSearchParams(window.location.search);
$("#myForm").submit( function(eventObj) {
  $("<input />").attr("type", "hidden")
      .attr("name", "id")
      .attr("value", searchParams.get("id"))
      .appendTo("#myForm");
  return true;
});
$("#submitForm").submit( function(eventObj) {
  $("<input />").attr("type", "hidden")
      .attr("name", "id")
      .attr("value", searchParams.get("id"))
      .appendTo("#submitForm");
  return true;
});