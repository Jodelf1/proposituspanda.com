'use strict'

let foto = document.getElementById('foto-servico1');
let imagemupload = document.getElementById('foto_capa1');

foto.addEventListener('click', () => {
    imagemupload.click();
    });

imagemupload.addEventListener('change', () => {
        let reader = new FileReader();
            reader.onload = () =>{
                foto.src = reader.result;
            }
        reader.readAsDataURL(imagemupload.files[0])
})