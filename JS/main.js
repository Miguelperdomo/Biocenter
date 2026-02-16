const toggle = document.querySelector('.nav-toggle');
const menu = document.querySelector('.nav-menu');

toggle.addEventListener('click', () => {
    menu.classList.toggle('show');
});

//IMAGEN


document.addEventListener("DOMContentLoaded", () => {

  const modal = document.getElementById("imgModal");
  const modalImg = document.getElementById("imgModalImg");

  if (!modal || !modalImg) {
    console.error("❌ Modal no existe en el HTML");
    return;
  }

  document.querySelectorAll(".ips-img img").forEach(img => {
    img.addEventListener("click", () => {
      modalImg.src = img.src;
      modal.style.display = "flex";
    });
  });

  modal.addEventListener("click", () => {
    modal.style.display = "none";
  });

});


document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalConfirm");
    const title = document.getElementById("modalTitle");
    const msg = document.getElementById("modalMsg");
    const closeBtn = document.getElementById("closeModal");

    const params = new URLSearchParams(window.location.search);
    const status = params.get("status");

    if (status === "ok") {
        title.textContent = "Mensaje enviado ✅";
        msg.textContent = "Gracias por contactarnos. Te responderemos lo antes posible.";
        modal.style.display = "flex";
    }

    if (status === "error") {
        title.textContent = "Error ❌";
        msg.textContent = "No se pudo enviar el mensaje. Intenta nuevamente.";
        modal.style.display = "flex";
    }

    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
        window.history.replaceState({}, document.title, window.location.pathname);
    });

});



document.addEventListener("DOMContentLoaded", () => {

    const form = document.querySelector("form");
    const spinner = document.getElementById("spinner");

    if (form && spinner) {
        form.addEventListener("submit", () => {
            spinner.style.display = "flex";
        });
    }

});


document.addEventListener("DOMContentLoaded", () => {

  const modal = document.getElementById("pqrModal");
  const open = document.getElementById("openPqr");
  const close = document.getElementById("closePqr");

  open.addEventListener("click", e => {
    e.preventDefault();
    modal.style.display = "flex";
  });

  close.addEventListener("click", () => {
    modal.style.display = "none";
  });

  modal.addEventListener("click", e => {
    if (e.target === modal) modal.style.display = "none";
  });

});


document.addEventListener("DOMContentLoaded", () => {

    const modal1 = document.getElementById("modalConfirm");
    const title1 = document.getElementById("modalTitle");
    const msg1 = document.getElementById("modalMsg");
    const closeBtn1 = document.getElementById("closeModal");

    const params1 = new URLSearchParams(window.location.search);
    const status1 = params1.get("status");

    if (status1 === "ok") {
        title1.textContent = "Mensaje enviado ✅";
        msg1.textContent = "Gracias por Calificarnos";
        modal1.style.display = "flex";
    }

    if (status1 === "error") {
        title1.textContent = "Error ❌";
        msg1.textContent = "No se pudo enviar el mensaje. Intenta nuevamente.";
        modal1.style.display = "flex";
    }

    closeBtn1.addEventListener("click", () => {
        modal1.style.display = "none";
        window.history.replaceState({}, document.title, window.location.pathname);
    });

});





