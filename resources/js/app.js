//import './bootstrap';
import Dropzone from "dropzone";
Dropzone.autoDiscover = false;
const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube Aquí tu Imágen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init:function (){
        // alert("dropzone creado")
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call( this, imagenPublicada );
            this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add(
                'dz-success',
                'dz-complete'
            );
        }
    }

})
// En caso de que se suba bien el archivo
dropzone.on('success', function (file, response) {
    // console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

// Para borrar un archivo
dropzone.on('removedfile', function (){
    // console.log('Archivo Eliminado');
})
// Para borrar definitivamente una imágen
dropzone.on('removedfile', function (){
    document.querySelector('[name="imagen"]').value = "";
})

// Cuando se está mandando un archivo
// dropzone.on('sending', function(file, xhr, fromData) {
//     console.log(file);
// })
// Por si algo del archivo es que está mal
/*dropzone.on('error', function (file, message){
    console.log(message);
})*/

