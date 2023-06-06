let lbl_ket = document.getElementsByName('lbl-ket');
let ket =document.getElementsByName('ket');
let textarea =document.getElementById('txtarea');


function selectedradio(radio){
    for (let i= 0; i< lbl_ket.length; i++) {
        lbl_ket[i].classList.remove('radio-active')
        lbl_ket[i].classList.add('radio-non-active')
        
        radio.classList.add('radio-active')
        radio.classList.remove('radio-non-active')

        textarea.setAttribute('disabled', "true")
    }
}

function clearradio(){
    for (let i= 0; i< ket.length; i++) {
        ket[i].checked = false
        textarea.removeAttribute('disabled')
        lbl_ket[i].classList.remove('radio-active')
        lbl_ket[i].classList.add('radio-non-active')
    }
}