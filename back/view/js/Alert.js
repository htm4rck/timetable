class ModalAlert {
    constructor(content = '', state = 'success', id = 'modalAlert') {
        this.state = state;
        this.id = id;
        this.html = '';
        this.icon = '';
        this.setIcon();
        this.content = content;
        this.createModal();
        this.modal = document.querySelector('#' + this.id);
        this.setHTML();
        this.modalObject = new Modal(this.modal, { backdrop: 'static' });
        this.events();
        this.modalObject.show();

    }
    createModal() {
        let modal = document.createElement('div');
        modal.setAttribute('id', this.id);
        modal.setAttribute('class', 'modal fade');
        modal.setAttribute('tabindex', -1);
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-hidden', true);
        document.body.insertBefore(modal, null);
    }
    setIcon() {
        switch (this.state) {
            case 'warning':
                this.icon = `
                <div class="f-modal-icon f-modal-warning scaleWarning">
                    <span class="f-modal-body pulseWarningIns"></span>
                    <span class="f-modal-dot pulseWarningIns"></span>
                </div>`;
                break;
            case 'error':
                this.icon = `
                <div class="f-modal-icon f-modal-error animate">
                    <span class="f-modal-x-mark">
                        <span class="f-modal-line f-modal-left animateXLeft"></span>
                        <span class="f-modal-line f-modal-right animateXRight"></span>
                    </span>
                    <div class="f-modal-placeholder"></div>
                    <div class="f-modal-fix"></div>
                </div>`;
                break;
            case 'success':
            default:
                this.icon = `
                <div class="f-modal-icon f-modal-success animate">
                    <span class="f-modal-line f-modal-tip animateSuccessTip"></span>
                    <span class="f-modal-line f-modal-long animateSuccessLong"></span>
                    <div class="f-modal-placeholder"></div>
                    <div class="f-modal-fix"></div>
                </div>`;
                break;
        }
    }
    events() {
        this.modal.addEventListener("hide.bs.modal", function (event) {
            this.remove();
            document.querySelectorAll('.fade').forEach(show => {
                show.remove();
            });
        });

    }
    setHTML() {
        this.html += '<div class="modal-dialog modal-dialog-centered">';
        this.html += '<div class="modal-content">';
        this.html += '<div class="modal-body text-center justify-content-center align-items-center">';
        this.html += '<div class="f-modal-alert">';
        this.html += this.icon;
        this.html += '<p class="m-5"><strong><em>';
        this.html += this.content;
        this.html += '</em></strong></p>';
        this.html += '<button type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>';
        this.html += '</div>';
        this.html += '</div>';
        this.html += '</div>';
        this.html += '</div>';
        this.modal.innerHTML = this.html;
    }

}