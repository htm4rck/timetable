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
        this.modalUpkeep = document.querySelector('#modalUpkeepTmtbWeekly');
        this.modalUpkeepObject = new Modal(this.modalUpkeep);
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

        this.modalUpkeep.addEventListener("hide.bs.modal", function (event) {
            clase.send.action = 'read';
            clase.json = '';
        });

        this.frmUpkeep.onsubmit = function () {
            alert();
            clase.setObject();
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
        document.querySelectorAll('.searchTmtbWeekly').forEach(search => {
            search.onchange = function () {
                search.classList.contains('sendSize') ? clase.send.sizePage = this.value : null;
                clase.send.numberPage = 1;
                clase.read();
            }
        })

        this.frmUpkeep.txtSemanaTmtbWeekly.setAttribute('min', new UtilDate(new Date().toLocaleDateString()).getDateGuion());
        this.frmUpkeep.txtSemanaTmtbWeekly.onchange = function () {
            let aux = this.value.split('-');
            clase.frmUpkeep.txtDescriptionTmtbWeekly.value = new UtilDateWeek(parseInt(aux[0]), parseInt(aux[1]) - 1, parseInt(aux[2])).getWeek();
        }
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
    delete() {
        this.send.action = 'delete';
        this.parameters = '';
        this.json = this.TmtbWeekly;
    }

    setObject() {
        this.TmtbWeekly.description = this.frmUpkeep.txtDescriptionTmtbWeekly.value;
        this.TmtbWeekly.date = new Date().toLocaleDateString();
        this.TmtbWeekly.estate = this.frmUpkeep.slcEstateTmtbWeekly.value;
        this.TmtbWeekly.idmanager = 0;
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
                        element.estate == 'V' ? (clase.TmtbWeeklyV = element, c.timetableweekly = element) : null;
                        document.querySelector('#titleTimetableWork').innerHTML = 'HORARIO SEMANAL [ ' + c.timetableweekly.description + ' ]';
                        c.read();
                        clase.list.push(clase.TmtbWeekly);

                    });
                    clase.print();
                    new Pagination(jsonResponse.counter, clase.send, 'paginationTmtbWeekly', clase.modalCargandoObject);
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
                    state = 'VIGENTE';
                    state = '<button type="button" class="btn btn-success disabled"><i class="far fa-clock mr-3"></i>VIGENTE</button>';
                    break;
                case 'P':
                    state = 'NUEVO';
                    state = '<button type="button" class="btn btn-primary disabled"><i class="far fa-clock mr-2"></i>PROXIMO</button>';
                    break;
                case 'A':
                    state = '<button type="button" class="btn btn-warning disabled"><i class="far fa-clock mr-1"></i>ANTERIOR</button>';
                    break;
            }
            row = '<tr>'
            row += '<td class="align-middle text-center" style="white-space: nowrap;"><i class="fas fa-calendar-day mr-1"></i>' + new UtilDate(TmtbWeekly.date).getDate() + '</td>';
            row += '<td class="align-middle" style="white-space: nowrap;"><i class="far fa-file mr-1"></i>' + TmtbWeekly.description + '</td>';
            row += '<td class="text-center align-middle">' + state + '</td>';
            row += '<td class="align-middle text-center"><button idtmtbweekly="' + TmtbWeekly.idtimetable_weekly + '" type="button" class="btn btn-outline-success updateTmtbWork"><i class="far fa-calendar-alt"></i></button></td>';
            row += '<td class="align-middle text-center"><button idtmtbweekly="' + TmtbWeekly.idtimetable_weekly + '" type="button" class="btn btn-outline-warning updateTmtbWeekly"><i class="far fa-edit"></i></button></td>';
            row += '<td class="align-middle text-center"><button idtmtbweekly="' + TmtbWeekly.idtimetable_weekly + '" type="button" class="btn btn-outline-danger deleteTmtbWeekly"><i class="far fa-trash-alt"></i></button></td>';
            row += '</tr>';
            document.getElementById("tbodyTmtbWeekly").innerHTML += row;
        });
        this.eventsList();
    }

    eventsList() {
        let clase = this;
        document.querySelectorAll('.updateTmtbWork').forEach(btnUpdate => {
            btnUpdate.onclick = function () {

                clase.setTmtbWeekly(parseInt(this.getAttribute("idtmtbweekly")));
                document.querySelector('#titleTimetableWork').innerHTML = 'HORARIO SEMANAL [ ' + this.parentElement.parentElement.children[1].innerHTML + ' ]';
                c.timetableweekly = clase.TmtbWeekly;
                c.read();
                document.querySelector('#listTimetableWork').style.display = 'block';
                document.querySelector('#listUpkeeptTmtbWeekly').style.display = 'none';
            }
        });

        document.querySelectorAll('.updateTmtbWeekly').forEach(btnUpdate => {
            btnUpdate.onclick = function () {
                clase.setTmtbWeekly(parseInt(this.getAttribute('idtmtbweekly')));
                clase.update();
                clase.modalUpkeepObject.show();
            }
        });

        document.querySelectorAll('.deleteTmtbWeekly').forEach(btnDelete => {
            btnDelete.onclick = function () {
                clase.setTmtbWeekly(parseInt(this.getAttribute('idtmtbweekly')));
                clase.delete();
                new ModalAction(clase.modalCargandoObject, 'Seguro que desea Eliminar a ' + clase.TmtbWeekly.names + ' ' + clase.TmtbWeekly.paternal + ' ' + clase.TmtbWeekly.maternal);
            }
        });

    }

}

let b = new CRUDTmtbWeekly();