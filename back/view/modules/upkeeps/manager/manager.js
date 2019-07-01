class CRUDManager {

    constructor() {
        this.settingsGlobal = new Settings();
        this.api = this.settingsGlobal.api + 'manager';
        this.send = new Send();
        this.parameters = '';
        this.json = '';
        this.actionurl = '?action=' + this.send.action;
        this.modalCargando = document.querySelector('#modalCargandoManager');
        this.modalCargandoObject = new Modal(this.modalCargando, {
            backdrop: false
        });
        this.frmSearch = document.querySelector('#FrmSearchManager');
        this.btnCreate = document.querySelector('#btnCreateManager');
        this.frmUpkeep = document.querySelector('#frmUpkeepManager');
        this.modalUpkeep = document.querySelector('#modalUpkeepManager');
        this.modalUpkeepObject = new Modal(this.modalUpkeep);
        this.modalChangePass = document.querySelector('#modalChangePassManager');
        this.modalChangePassObject = new Modal(this.modalChangePass);
        this.frmChangePass = document.querySelector('#frmChangePassManager');
        this.list = [];
        this.manager = new Manager();
        this.eventsDefault();
        this.read();
    }
    setManager(id) {
        let clase = this;
        this.manager = new Manager();
        this.list.forEach(function (element, index) {
            if (element.idmanager == id) {
                clase.manager = element;
                return;
            }
        })
    }
    eventsDefault() {
        let clase = this;

        this.modalCargando.addEventListener("show.bs.modal", function (event) {
            clase.run();
        });

        this.modalUpkeep.addEventListener("hide.bs.modal", function (event) {
            clase.send.action = 'read';
            clase.json = '';
        });

        this.modalChangePass.addEventListener("hide.bs.modal", function (event) {
            clase.send.action = 'read';
            clase.json = '';
        });

        this.frmUpkeep.onsubmit = function () {
            clase.setObject();
            return false;
        };
        this.frmChangePass.onsubmit = function () {
            try {
                clase.send.action = 'changepass';
                clase.Manager.pass = this.txtPassManager.value;
                clase.json = clase.Manager;
                clase.modalCargandoObject.show();
            } catch (error) {
                console.error(error);
            }
            return false;
        };

        this.btnCreate.onclick = function () {
            clase.create();
            clase.modalUpkeepObject.show();
        }
        this.frmSearch.onsubmit = function () {
            clase.read();
            return false;
        }
        document.querySelectorAll('.searchManager').forEach(search => {
            search.onchange = function () {
                search.classList.contains('sendSize') ? clase.send.sizePage = this.value : null;
                clase.send.numberPage = 1;
                clase.read();
            }
        })
    }

    read() {
        this.send.action = 'read';
        this.json = '';
        this.modalCargandoObject.show();
    }
    create() {
        this.frmUpkeep.txtLoginManager.value = '';
        this.frmUpkeep.txtPaternalManager.value = '';
        this.frmUpkeep.txtMaternalManager.value = '';
        this.frmUpkeep.txtNamesManager.value = '';

        this.send.action = 'create';
        this.parameters = '';
    }
    update() {
        this.json = this.manager;
        console.log(this.manager);
        this.frmUpkeep.txtLoginManager.value = this.manager.login;
        this.frmUpkeep.txtPaternalManager.value = this.manager.paternal;
        this.frmUpkeep.txtMaternalManager.value = this.manager.maternal;
        this.frmUpkeep.txtNamesManager.value = this.manager.names;
        this.send.action = 'update';
        this.parameters = '';
    }
    delete() {
        this.send.action = 'delete';
        this.parameters = '';
        this.json = this.manager;
    }

    setObject() {
        this.Manager.paternal = document.querySelector('#txtPaternalManager').value;
        this.Manager.maternal = document.querySelector('#txtMaternalManager').value;
        this.Manager.names = document.querySelector('#txtNamesManager').value;
        this.Manager.gender = document.querySelector('#slcGenderManager').value;
        this.json = this.Manager;
        this.modalCargandoObject.show();
    }

    run() {
        this.actionurl = '?action=' + this.send.action;
        this.parameters = '';
        if (this.send.action == 'read') {
            this.parameters += '&filter=' + document.querySelector('#txtFilterManagerSearch').value;
            this.parameters += '&gender=' + document.querySelector('#slcGenderManagerSearch').value;
            this.parameters += '&size=' + document.querySelector('#sizePageManager').value;
            this.parameters += '&page=' + this.send.numberPage;
        }
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
            if (jsonResponse.error == false) {
                document.getElementById("tbodyManager").innerHTML = '';
                if (jsonResponse.counter > 0) {
                    clase.list = [];
                    document.querySelector('#titleManager').innerHTML = '[ ' + jsonResponse.counter + ' ] COLABORADORES';
                    jsonResponse.content.forEach(element => {
                        clase.Manager = element;
                        clase.list.push(clase.Manager);
                    });
                    clase.print();
                    new Pagination(jsonResponse.counter, clase.send, 'paginationManager', clase.modalCargandoObject);
                    //TODO: UPDATE, CREATE, DELETE
                    if (jsonResponse.message != 'ok') {
                        clase.read();
                        clase.modalUpkeepObject.hide();
                        new ModalAlert(jsonResponse.message);
                    }
                } else {
                    new ModalAlert('No hay Resultados', 'error');
                }
            } else {
                //TODO: ERROR(TRUE) DEL SERVIDOR
                new ModalAlert(jsonResponse.message, 'warning');
            }
            clase.modalCargandoObject.hide();
        }).catch(function (error) {
            new ModalAlert(error, 'error')
            clase.modalCargandoObject.hide();
        });
    }
    print() {
        document.getElementById("tbodyManager").innerHTML = '';
        let row = '';
        this.list.forEach(function (manager) {
            row = '<tr>'
            row += '<td class="align-middle text-center" style="white-space: nowrap;"><small><i class="far fa-id-card mr-1"></i>' + manager.login + '</small></td>';
            row += '<td style="white-space: nowrap;"><small><i class="far fa-user mr-1"></i>' + manager.paternal + ' ' + manager.maternal + ' ' + manager.names + '</small></td>';
            row += '<td class="align-middle text-center"><button idmanager="' + manager.idmanager + '" type="button" class="btn btn-sm btn-outline-info changepassManager"><small><i class="fas fa-key"></i></small></button></td>';
            row += '<td class="align-middle text-center"><button idmanager="' + manager.idmanager + '" type="button" class="btn btn-sm btn-outline-success resetManager"><small><i class="fas fa-redo-alt"></i></small></button></td>';
            row += '<td class="align-middle text-center"><button idmanager="' + manager.idmanager + '" type="button" class="btn btn-sm btn-outline-warning updateManager"><small><i class="far fa-edit"></i></small></button></td>';
            row += '<td class="align-middle text-center"><button idmanager="' + manager.idmanager + '" type="button" class="btn btn-sm btn-outline-danger deleteManager"><small><i class="far fa-trash-alt"></i></small></button></td>';
            row += '</tr>';
            document.getElementById("tbodyManager").innerHTML += row;
        });
        this.eventsList();
    }

    eventsList() {
        let clase = this;
        document.querySelectorAll('.changepassManager').forEach(btnUpdate => {
            btnUpdate.onclick = function () {
                clase.setManager(parseInt(this.getAttribute('idManager')));
                clase.frmChangePass.txtPassManager.value = '';
                clase.modalChangePassObject.show();
            }
        });

        document.querySelectorAll('.resetManager').forEach(btnUpdate => {
            btnUpdate.onclick = function () {
                clase.setManager(parseInt(this.getAttribute('idmanager')));
                clase.update();
                new ModalAction(clase.modalCargandoObject, 'Seguro que desea Reestablecer la contraseña para ' + clase.manager.names + ' ' + clase.manager.paternal + ' ' + clase.manager.maternal, 'update');
            }
        });

        document.querySelectorAll('.updateManager').forEach(btnUpdate => {
            console.log(btnUpdate);
            btnUpdate.onclick = function () {
                clase.setManager(parseInt(this.getAttribute('idmanager')));
                clase.update();
                clase.modalUpkeepObject.show();
            }
        });

        document.querySelectorAll('.deleteManager').forEach(btnUpdate => {
            btnUpdate.onclick = function () {
                clase.setManager(parseInt(this.getAttribute('idmanager')));
                clase.delete();
                new ModalAction(clase.modalCargandoObject, 'Seguro que desea Eliminar a ' + clase.manager.names + ' ' + clase.manager.paternal + ' ' + clase.manager.maternal);
            }
        });

    }

}
let a = new CRUDManager();