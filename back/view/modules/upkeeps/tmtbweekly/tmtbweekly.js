class CRUDTmtbWeekly {

    constructor() {
        this.settingsGlobal = new Settings();
        this.api = this.settingsGlobal.api + 'timetbweekly';
        this.send = new Send();
        this.parameters = '';
        this.json = '';
        this.actionurl = '?action=' + this.send.action;
        this.modalCargando = document.querySelector('#modalLoadingTmtbWeekly');
        this.modalCargandoObject = new Modal(this.modalCargando, {
            backdrop: false
        });
        this.ctimetablework = [];
        this.frmSearch = document.querySelector('#FrmSearchTmtbWeekly');
        this.btnCreate = document.querySelector('#btnCreateTmtbWeekly');
        this.frmUpkeep = document.querySelector('#frmUpkeepTmtbWeekly');
        this.list = [];
        this.TmtbWeekly = new TimeTableWeekly();
        this.TmtbWeeklyV = new TimeTableWeekly();
        this.eventsDefault();
        this.read();
    }
    setTmtbWeekly(id) {
        let clase = this;
        this.TmtbWeekly = new TimeTableWeekly();
        this.list.forEach(function (element, index) {
            if (element.idtimetable_weekly == id) {
                clase.TmtbWeekly = element;
                return;
            }
        })
    }
    eventsDefault() {
        let clase = this;
        this.modalCargando.addEventListener("show.bs.modal", function (event) {
            clase.run();
        });

        this.frmSearch.onsubmit = function () {
            clase.read();
            return false;
        }

        document.querySelectorAll('.searchTmtbWeekly').forEach(search => {
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
        this.frmUpkeep.txtDescriptionTmtbWeekly.value = '';
        this.frmUpkeep.txtSemanaTmtbWeekly.value = '';
        this.frmUpkeep.slcEstateTmtbWeekly.value = 'P';
        this.send.action = 'create';
        this.parameters = '';
    }

    update() {
        this.frmUpkeep.txtDescriptionTmtbWeekly.value = this.TmtbWeekly.description;
        this.TmtbWeekly.estate == 'A' ?
            this.frmUpkeep.slcEstateTmtbWeekly.value = 'P' :
            this.frmUpkeep.slcEstateTmtbWeekly.value = this.TmtbWeekly.estate;
        this.frmUpkeep.txtSemanaTmtbWeekly.value = '';
        this.json = this.TmtbWeekly;
        this.send.action = 'update';
        this.parameters = '';
    }

    delAll() {
        this.send.action = 'delall';
        this.parameters = '';
        this.json = this.TmtbWeekly;
    }

    delClean() {
        this.send.action = 'delclean';
        this.parameters = '';
        this.json = this.TmtbWeekly;
    }

    setObject() {
        this.TmtbWeekly.description = this.frmUpkeep.txtDescriptionTmtbWeekly.value;
        this.TmtbWeekly.date = new Date().toLocaleDateString();
        this.TmtbWeekly.estate = this.frmUpkeep.slcEstateTmtbWeekly.value;
        this.TmtbWeekly.idmanager = admin.idmanager;
        this.json = this.TmtbWeekly;
        this.modalCargandoObject.show();
    }

    run() {
        this.actionurl = '?action=' + this.send.action;
        this.parameters = '';
        if (this.send.action == 'read') {
            this.parameters += '&filter=' + document.querySelector('#txtFilterTmtbWeeklySearch').value;
            this.parameters += '&estate=' + document.querySelector('#slcEstateTmtbWeeklySearch').value;
            this.parameters += '&size=' + document.querySelector('#sizePageTmtbWeekly').value;
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
            //response.text().then(text => { console.info(text) });
            return response.json();
        }).then(function (jsonResponse) {
            if (jsonResponse.error == false) {
                document.getElementById("tbodyTmtbWeekly").innerHTML = '';
                if (jsonResponse.counter > 0) {
                    clase.list = [];
                    document.querySelector('#titleTmtbWeekly').innerHTML = '[ ' + jsonResponse.counter + ' ] HORARIOS SEMANALES';
                    jsonResponse.content.forEach(element => {
                        clase.TmtbWeekly = element;
                        clase.list.push(clase.TmtbWeekly);
                    });
                    clase.print();
                    new Pagination(jsonResponse.counter, clase.send, 'paginationTmtbWeekly', clase.modalCargandoObject);
                    //TODO: UPDATE, CREATE, DELETE
                    if (jsonResponse.message != 'ok') {
                        clase.read();
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
            console.info(error)
            new ModalAlert(error, 'error')
            clase.modalCargandoObject.hide();
        });
    }

    print() {
        document.getElementById("tbodyTmtbWeekly").innerHTML = '';
        let row = '';
        this.list.forEach(function (TmtbWeekly) {
            let state = ''
            switch (TmtbWeekly.estate) {
                case 'V':
                    state = '<button type="button" class="btn btn-sm btn-success disabled"><small><i class="far fa-clock mr-3"></i>VIGENTE</small></button>';
                    break;
                case 'P':
                    state = '<button type="button" class="btn btn-sm btn-primary disabled"><small><i class="far fa-clock mr-2"></i>PROXIMO</small></button>';
                    break;
                case 'A':
                    state = '<button type="button" class="btn btn-sm btn-warning disabled"><small><i class="far fa-clock mr-1"></i>ANTERIOR</small></button>';
                    break;
            }
            row = '<tr>'
            row += '<td class="align-middle text-center" style="white-space: nowrap;"><small><i class="fas fa-calendar-day mr-1"></i>' + new UtilDate(TmtbWeekly.date).getDate() + '</small></td>';
            row += '<td class="align-middle" style="white-space: nowrap;"><small><i class="far fa-file mr-1"></i>' + TmtbWeekly.description + '</small></td>';
            row += '<td class="text-center align-middle">' + state + '</td>';
            row += '<td class="align-middle text-center"><button idtmtbweekly="' + TmtbWeekly.idtimetable_weekly + '" type="button" class="btn btn-sm btn-outline-warning updateTmtbWeekly"><small><i class="fas fa-broom"></i></small></button></td>';
            row += '<td class="align-middle text-center"><button idtmtbweekly="' + TmtbWeekly.idtimetable_weekly + '" type="button" class="btn btn-sm btn-outline-danger deleteTmtbWeekly"><small><i class="far fa-trash-alt"></i></small></button></td>';
            row += '</tr>';
            document.getElementById("tbodyTmtbWeekly").innerHTML += row;
        });
        this.eventsList();
    }

    eventsList() {
        let clase = this;

        document.querySelectorAll('.updateTmtbWeekly').forEach(btnUpdate => {
            btnUpdate.onclick = function () {
                clase.setTmtbWeekly(parseInt(this.getAttribute('idtmtbweekly')));
                clase.delClean();
                new ModalAction(clase.modalCargandoObject, 'Seguro que desea Limpiar los Horarios de Trabajo del Horario: ' + clase.TmtbWeekly.description, 'update');
            }
        });

        document.querySelectorAll('.deleteTmtbWeekly').forEach(btnDelete => {
            btnDelete.onclick = function () {
                clase.setTmtbWeekly(parseInt(this.getAttribute('idtmtbweekly')));
                clase.delAll();
                new ModalAction(clase.modalCargandoObject, 'Seguro que desea Eliminar el Horario ' + clase.TmtbWeekly.description+' con TODOS sus Horarios de Trabajo');
            }
        });
    }
}

let b = new CRUDTmtbWeekly();