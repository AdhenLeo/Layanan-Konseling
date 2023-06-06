let menu = document.querySelector('#menu')
let aside = document.querySelector('#aside-responsive')
let closeIcon = document.querySelector('#close-icon')

menu.addEventListener('click', () => {
    aside.classList.add('ease-in-out');
    aside.classList.add('left-0');
    aside.classList.remove('-left-full');
})

closeIcon.addEventListener('click', () => {
    aside.classList.add('ease-in-out');
    aside.classList.remove('left-0');
    aside.classList.add('-left-full');
})