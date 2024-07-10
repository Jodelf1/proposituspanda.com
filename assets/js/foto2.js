'use strict'

let foto2 = document.getElementById('foto-servico2');
let imagemupload2 = document.getElementById('foto_capa2');

foto2.addEventListener('click', () => {
    imagemupload2.click();
    });

imagemupload2.addEventListener('change', () => {
        let reader = new FileReader();
            reader.onload = () =>{
                foto2.src = reader.result;
            }
        reader.readAsDataURL(imagemupload2.files[0])
})