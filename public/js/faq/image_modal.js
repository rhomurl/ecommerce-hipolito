const images = document.querySelectorAll(".images img");
const modal = document.querySelector(".img_modal");
const modalImg = document.querySelector(".modalImg");
const modalTxt = document.querySelector(".modalTxt");
const close = document.querySelector(".close");

images.forEach((image) => {
    image.addEventListener("click", () => {
        modalImg.src = image.src;
        modalTxt.innerHTML = image.alt;
        modal.classList.add("appear");

        close.addEventListener("click", () => {
        modal.classList.remove("appear");
        });
    });

});

modal.addEventListener('click', (event) => {
    if (modal == modal) {
        modal.classList.remove("appear");
    }
});