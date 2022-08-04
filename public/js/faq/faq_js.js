let dropdown = document.getElementsByClassName("faq-div");
let i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("faq-div-active");
    let dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.height === "110px") {
      dropdownContent.style.height = "0px";
    } else {
        dropdownContent.classList.toggle("faq-content-active");
      }
  });
}

// let magnifying_area = document.querySelector('#magnifying_area');
// let magnifying_img = document.querySelector('#magnifying_img');

// magnifying_area.addEventListener('mousemove', (e) => {
//     clientX = e.clientX - magnifying_area.offsetLeft;
//     clientY = e.clientY - magnifying_area.offsetTop;

//     mWidth = magnifying_area.offsetWidth;
//     mHeight = magnifying_area.offsetHeight;

//     clientX = clientX / mWidth * 100;
//     clientY = clientY / mHeight * 100;

//      magnifying_img.style.transform = 'translate(-'+clientX+'%, -'+clientY+'%) scale(2)';
//     // magnifying_img.style.transform = 'translate(-50%, -50%) scale(2)';
// })
// magnifying_area.addEventListener('mouseleave', () => {
//     magnifying_img.style.transform = 'translate(-50%, -50%) scale(1)';
// })