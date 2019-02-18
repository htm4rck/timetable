document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('#btnAbrirEmployee').addEventListener('click',function(){
        let modal =new Modal(document.querySelector('#modalman'))
        modal.show();
        //$('#modalman').modal('show');
    });
});