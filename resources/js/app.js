import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.toggleZoom = function () {
    const img = document.getElementById("mainImage");

    if (img.classList.contains("zoomed")) {
        img.classList.remove("zoomed");
        img.style.transform = "scale(1)";
        img.style.cursor = "zoom-in";
        img.style.left = "0px";
        img.style.top = "0px";
        img.style.position = "relative";
    } else {
        img.classList.add("zoomed");
        img.style.transform = "scale(2)";
        img.style.cursor = "move";
        img.style.position = "absolute";
    }
};

window.showInMainImage = function (src) {
    const img = document.getElementById("mainImage");
    img.classList.remove("zoomed");
    img.style.transform = "scale(1)";
    img.style.left = "0px";
    img.style.top = "0px";
    img.style.cursor = "zoom-in";
    img.style.position = "relative";
    img.src = src;
};

document.addEventListener("DOMContentLoaded", () => {
    const img = document.getElementById("mainImage");
    let isDragging = false;
    let startX = 0;
    let startY = 0;

    img.addEventListener("mousedown", function (e) {
        if (!img.classList.contains("zoomed")) return;
        isDragging = true;
        startX = e.clientX - img.offsetLeft;
        startY = e.clientY - img.offsetTop;
        img.style.cursor = "move";
    });

    document.addEventListener("mouseup", function () {
        isDragging = false;
        if (img.classList.contains("zoomed")) {
            img.style.cursor = "move";
        }
    });

    document.addEventListener("mousemove", function (e) {
        if (!isDragging || !img.classList.contains("zoomed")) return;
        const x = e.clientX - startX;
        const y = e.clientY - startY;
        img.style.left = `${x}px`;
        img.style.top = `${y}px`;
    });
});
