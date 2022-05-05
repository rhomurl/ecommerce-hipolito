// let accordions = document.querySelectorAll('#accordions');
// let valid = false;
// console.log(accordions);

// function validate() {
//     for (let i = 0; i < accordions.length; i++) {
//         if (accordions[i].checked) {
//             alert('checked');
//         }
//     }
// }
// validate();

// FIRST SOLUTION
let paypalAccordion = document.querySelector('#paypalAccordion');
let creditCardAccordion = document.querySelector('#creditCardAccordion');
let codAccordion = document.querySelector('#codAccordion');

paypalAccordion.addEventListener('click', () => {
    creditCardAccordion.checked = false;
    codAccordion.checked = false;
});
creditCardAccordion.addEventListener('click', () => {
    paypalAccordion.checked = false;
    codAccordion.checked = false;
});
codAccordion.addEventListener('click', () => {
    paypalAccordion.checked = false;
    creditCardAccordion.checked = false;
});
