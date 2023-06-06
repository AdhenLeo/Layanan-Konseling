let dropdownBtn = document.querySelector('#dropdown')
let dropdownCard = document.querySelector('#dropdown-card')
let toggle = true

dropdownBtn.addEventListener("click", () => {
    toggle == true ? dropdownCard.classList.remove('hidden') : dropdownCard.classList.add('hidden')
    toggle = !toggle
    console.log(toggle)
})