class Alert {
    constructor(state = 'succes', id = 'modalAlert', content = '') {
        this.state = state;
        this.html = '';
        this.id = id;
        this.succes = '<img src="/back/view/images/check.svg" width="100" class="mt-3 mb-5">'
        this.content = content;
        this.getAlert();
        this.setModal();

    }
    getAlert() {
        this.html += '<div id="' + this.id + '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">';
        this.html += '<div class="modal-dialog modal-dialog-centered">';
        this.html += '<div class="modal-content">';
        //this.html += '<div class="modal-header">';
        //this.html += '<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>';
        //this.html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        //this.html += '  <span aria-hidden="true">&times;</span>';
        //this.html += '</button>';
        //this.html += '</div>';
        this.html += '<div class="modal-body text-center justify-content-center align-items-center">';
        this.html += this.succes;
        this.html += '<p><strong><em>';
        this.html += this.content;
        this.html += '</em></strong></p>';
        this.html += '</div>';
        this.html += '<div class="modal-footer justify-content-center mt-2 mb-2">';
        this.html += '<button type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>';
        this.html += '</div>';
        this.html += '</div>';
        this.html += '</div>';
        this.html += '</div>';
        document.write(this.html);
    }
    setModal() {
        let modal = document.querySelector('#' + this.id);
        this.modal = new Modal(modal, {
            //content: this.content, // sets modal content
            backdrop: 'static', // we don't want to dismiss Modal when Modal or backdrop is the click event target
            //keyboard: false // we don't want to dismiss Modal on pressing Esc key
        });
    }
    showAlert() {
        this.modal.show();
    }
}