'use strict'

let foto3 = document.getElementById('foto-servico3');
let imagemupload3 = document.getElementById('foto_capa3');

foto3.addEventListener('click', () => {
    imagemupload3.click();
    });

imagemupload3.addEventListener('change', () => {
        let reader = new FileReader();
            reader.onload = () =>{
                foto3.src = reader.result;
            }
        reader.readAsDataURL(imagemupload3.files[0])
})