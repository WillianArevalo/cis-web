$(document).ready(function () {
  // Verificar el tema seleccionado al cargar la página
  var selectedTheme = localStorage.getItem("theme");
  const icondark = document.getElementById("icon-dark");
  const iconlight = document.getElementById("icon-light");

  // Verificar el tema seleccionado al cargar la página
  if (selectedTheme) {
    $("body").attr("data-bs-theme", selectedTheme);
    if (selectedTheme === "light") {
      iconlight.classList.remove("d-none");
      icondark.classList.add("d-none");
    } else {
      icondark.classList.remove("d-none");
      iconlight.classList.add("d-none");
    }
  } else {
    localStorage.setItem("theme", "light");
    $("body").attr("data-bs-theme", "light");
    iconlight.classList.remove("d-none");
    icondark.classList.add("d-none");
  }

  // Asignar evento al botón para cambiar el tema
  $("#btn-theme").click(function () {
    if (selectedTheme === "light") {
      localStorage.setItem("theme", "dark");
      icondark.classList.remove("d-none");
      iconlight.classList.add("d-none");
      $("body").attr("data-bs-theme", "dark");
      selectedTheme = "dark";
    } else {
      localStorage.setItem("theme", "light");
      iconlight.classList.remove("d-none");
      icondark.classList.add("d-none");
      $("body").attr("data-bs-theme", "light");
      selectedTheme = "light";
    }
  });
});
