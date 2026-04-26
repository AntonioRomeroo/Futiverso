const carousels = Array.from(document.querySelectorAll("[data-sqcarousel]"))
  .map((box) => {
    const track = box.querySelector(".sq-track");
    const slides = track ? Array.from(track.children) : [];
    return { box, track, slides, index: 0 };
  })
  .filter(c => c.track && c.slides.length > 1);

function updateAll() {
  carousels.forEach((c) => {
    c.track.style.transform = `translateX(-${c.index * 100}%)`;
  });
}

function nextAll() {
  carousels.forEach((c) => {
    c.index = (c.index + 1) % c.slides.length;
  });
  updateAll();
}

// Primer pintado
updateAll();


const intervalMs = 2500; 
setInterval(nextAll, intervalMs);


//Esto nos permite tener solo un desplegable abierto a la vez

document.querySelectorAll(".dd").forEach(dd => {
  dd.addEventListener("toggle", () => {
    if (!dd.open) return;
    document.querySelectorAll(".dd").forEach(o => {
      if (o !== dd) o.open = false;
    });
  });
});


