class CRUDManager {

    constructor() {
        this.settingsGlobal = new Settings();
        this.api = this.settingsGlobal.api + 'manager';
        this.send = new Send();
        this.parameters = '';
        this.json = '';
        this.actionurl = '?action=' + this.send.action;
        this.modalCargando = document.querySelector('#modalLoadingManager');
        this.modalCargandoObject = new Modal(this.modalCargando, {
            backdrop: false
        });
        this.txtLogin = document.querySelector('#txtLogin');
        this.txtPass = document.querySelector('#txtPass');
        this.btnLogin = document.querySelector('#btnLogin');
        this.list = [];
        this.Manager = new Manager();
        this.eventsDefault();
    }
    setManager(id) {
        let clase = this;
        this.Manager = new Manager();
        this.list.forEach(function (element, index) {
            if (element.idManager == id) {
                clase.Manager = element;
                return;
            }
        })
    }
    eventsDefault() {
        let clase = this;
        this.modalCargando.addEventListener("show.bs.modal", function (event) {
            clase.run();
        });
        this.btnLogin.onclick = function () {

            clase.login();
            return false;
        }
    }

    login() {
        if (this.txtLogin.value != '') {
            if (this.txtPass.value != '') {
                this.Manager.login = this.txtLogin.value;
                this.Manager.pass = this.txtPass.value;
                this.json = this.Manager;
                this.send.action = 'login';
                this.modalCargandoObject.show();
            } else {
                new ModalAlert('Ingresa Tu Clave', 'error');
            }
        } else {
            new ModalAlert('Ingresa Tu Usuario', 'error');
        }

    }

    run() {
        this.actionurl = '?action=' + this.send.action;
        let clase = this;
        fetch(this.api + this.actionurl + this.parameters, {
            method: this.send.method,
            body: JSON.stringify(this.json),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function (response) {
            //response.text().then(text=>{console.info(text)});
            return response.json();
        }).then(function (jsonResponse) {
            console.log(jsonResponse);
            if (jsonResponse.error == false) {
                sessionStorage.validate=!jsonResponse.error;
                sessionStorage.idmanager=jsonResponse.content.idmanager;
                sessionStorage.paternal=jsonResponse.content.paternal;
                sessionStorage.maternal=jsonResponse.content.maternal;
                sessionStorage.names=jsonResponse.content.names;
                sessionStorage.login=jsonResponse.content.login;
                window.location='index';
            } else {
                sessionStorage.clear();
                new ModalAlert(jsonResponse.message, 'error');
            }
            clase.modalCargandoObject.hide();
        }).catch(function (error) {
            new ModalAlert(error, 'error');
            clase.modalCargandoObject.hide();
        });
    }
}
new CRUDManager();