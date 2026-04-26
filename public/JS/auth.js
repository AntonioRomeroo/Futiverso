// ===============================
// REFERENCIAS AL DOM
// ===============================

// Botón que abre el modal de login
const openAuth = document.getElementById("openAuth");

// Botón de cerrar (la X del modal)
const closeAuth = document.getElementById("closeAuth");

// Fondo oscuro + contenedor del modal
const authModal = document.getElementById("authModal");

// Botones de las pestañas (Login / Registro)
const tabs = document.querySelectorAll(".auth-tab");

// Formularios (login y registro)
const forms = document.querySelectorAll(".auth-form");


// ===============================
// FUNCIONES PRINCIPALES
// ===============================

// Función para mostrar el modal
function showModal(){
  authModal.classList.add("show");     // añade la clase que lo hace visible
  authModal.setAttribute("aria-hidden", "false"); // accesibilidad
}

// Función para ocultar el modal
function hideModal(){
  authModal.classList.remove("show");  // quita la clase visible
  authModal.setAttribute("aria-hidden", "true");  // accesibilidad
}


// ===============================
// EVENTOS DE APERTURA / CIERRE
// ===============================

// Al hacer click en "Iniciar sesión" → abrir modal
openAuth.addEventListener("click", showModal);

// Al hacer click en la X → cerrar modal
closeAuth.addEventListener("click", hideModal);

// Si el usuario hace click fuera de la tarjeta (fondo oscuro)
// cerramos el modal
authModal.addEventListener("click", (e) => {
  if (e.target === authModal) {
    hideModal();
  }
});


// ===============================
// CAMBIO ENTRE LOGIN Y REGISTRO
// ===============================

// Recorremos cada pestaña (Login / Registro)
tabs.forEach(tab => {

  // Cuando se hace click en una pestaña
  tab.addEventListener("click", () => {

    // 1️⃣ Quitamos la clase "active" a todas las pestañas
    tabs.forEach(t => t.classList.remove("active"));

    // 2️⃣ Activamos la pestaña pulsada
    tab.classList.add("active");

    // 3️⃣ Sabemos qué formulario mostrar gracias al data-tab
    // data-tab="login" o data-tab="register"
    const target = tab.dataset.tab;

    // 4️⃣ Ocultamos todos los formularios
    forms.forEach(f => f.classList.remove("active"));

    // 5️⃣ Mostramos solo el formulario correspondiente
    document
      .getElementById(target + "Form")
      .classList.add("active");
  });

});
