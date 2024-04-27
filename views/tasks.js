// const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
// const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
// $(document).ready(function () {
//   $('[data-toggle="tooltip"]').tooltip();
// });
var tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl, {
    container: ".task-card",
  });
});
// $('[data-bs-toggle="tooltip"]').tooltip({
//   container: "body",
// });
const button = document.getElementById("create-task");
button.addEventListener("click", async () => {
  document.location.href = "index.php?page=create-task";
});

// const users = document.querySelectorAll(".tt");
// users.forEach((user) => {
//   const tooltip = new bootstrap.Tooltip(user);
// });
