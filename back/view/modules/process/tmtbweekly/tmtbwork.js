class RTimetableWork {

    constructor() {
        this.settingsGlobal = new Settings();
        this.api = this.settingsGlobal.api + 'timetbwork';
        this.send = new Send();
        this.parameters = '';
        this.json = '';
        this.timetableweekly = new TimeTableWeekly();
        this.timetablework = new TimeTableWork();
        this.employee = new Employee()
        this.cemployeelist = [];
        this.actionurl = '?action=' + this.send.action;
        this.modalCargando = document.querySelector('#modalLoadingTimetableWorkR');
        this.modalCargandoObject = new Modal(this.modalCargando, {
            backdrop: false
        });
        this.list = [];
        this.eventsDefault();
        this.read();
    }

    eventsDefault() {
        let clase = this;
        this.modalCargando.addEventListener("show.bs.modal", function (event) {
            clase.run();
        });
    }

    read() {
        this.send.action = 'read';
        this.json = '';
        this.modalCargandoObject.show();
    }

    setObject() {
        this.timetableemployee.number_hours = parseInt(this.frmUpkeep.txtNumberHoursTimetableEmployee.value);
        this.timetableemployee.number_minutes = parseInt(this.frmUpkeep.slcNumberMinutesTimetableEmployee.value);
        this.json = this.timetableemployee;
        this.modalCargandoObject.show();
    }

    run() {
        this.actionurl = '?action=' + this.send.action;
        this.parameters = '';
        if (this.send.action == 'read') {
            this.parameters += '&idtimetable_weekly=' + this.timetableweekly.idtimetable_weekly;
            this.parameters += '&filter=' + '';
            this.parameters += '&size=' + 1000;
            this.parameters += '&page=' + 1;
            this.parameters += '&idemployee=';
        }
        console.log(this.parameters);
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
                clase.list = [];
                if (jsonResponse.counter > 0) {
                    jsonResponse.content.forEach(element => {
                        clase.list.push(element);
                        //clase.list.push(new Hours(element));
                    });
                    //TODO: UPDATE, CREATE, DELETE
                    if (jsonResponse.message != 'ok') {
                        clase.read();
                        //clase.modalUpkeepObject.hide();
                        new ModalAlert(jsonResponse.message);
                    }
                } else {
                    //new ModalAlert('Horarios sin Asignar a ');
                }
            } else {
                //TODO: ERROR(TRUE) DEL SERVIDOR
                new ModalAlert(jsonResponse.message, 'warning');
            }
            clase.modalCargandoObject.hide();
        }).then(function () {

            clase.print();
        }).catch(function (error) {
            new ModalAlert(error, 'error')
            console.error(error);
            clase.modalCargandoObject.hide();
        });
    }
    print() {
        //TODO : TABLA DE HORARIO
        let thead = document.querySelector('#listTimetableWorkHead');
        let tbody = document.querySelector('#listTimetableWorkBody');
        tbody.innerHTML = ''
        thead.innerHTML = '<th class="text-center align-middle" rowspan="2"><button class="btn btn-sm text-success bg-white"><i class="far fa-calendar-alt"></i></button></th>';
        thead.innerHTML += '<th class="text-center align-middle" colspan="2" rowspan="2"><button class="btn btn-sm text-success bg-white"><i class="far fa-user mr-1"></i>COLABORADOR</button></th>';
        listDia.forEach(dia => {
            thead.innerHTML += '<th class="text-center align-middle" style="width: 12.50%"><button class="btn btn-sm text-success bg-white">' + dia.nombre + '</button></th>';
        });
        let tr = '';
        a.list.forEach(employee => {
            tr += '<tr>'
            tr += '<td class="text-center align-middle"><button class="btn btn-sm btn-outline-warning updateTimeTableWork" idemployee="' + employee.idemployee + '"><i class="fas fa-user-edit"></i></button></td>';
            tr += '<td colspan="2" style="white-space: nowrap;"><i class="far fa-user mr-1"></i>' + employee.paternal + ' ' + employee.maternal + ' ' + employee.names + '<br><i class="fas fa-mobile-alt mr-1"></i>' + employee.mobile + '</td>';
            listDia.forEach(dia => {
                let existe = -1
                let lwork = ''
                let hora = 0;

                this.list.forEach(work => {

                    (dia.id == work.day && work.idemployee == employee.idemployee) ? (hora = work.start_hour + (work.start_minute == 0 ? 0 : 0.5) + work.number_hours + (work.number_minutes == 0 ? 0 : 0.5), existe = 1, lwork = work.start_hour + (work.start_minute == 0 ? ':00 - ' : ':30 - ')) : null;
                })
                if (existe == -1) {
                    tr += '<td style="white-space: nowrap;color:red;" class="text-center align-middle"><i class="fas fa-calendar-day mr-1"></i>LIBRE</td>';
                } else {
                    tr += '<td style="white-space: nowrap;" class="text-center align-middle"><i class="far fa-user mr-1"></i>' + lwork + (Number.isInteger(hora) ? parseInt(hora) + ':00' : parseInt(hora) + ':30') + '</td>';
                }
            })
            tr += '</tr>'
        })
        tbody.innerHTML += tr;
        this.eventsList();
    }

    eventsList() {
        let clase = this;
        document.querySelectorAll('.updateTimeTableWork').forEach(btnUpdate => {
            btnUpdate.onclick = function () {
                clase.employee = a.getEmployee(parseInt(this.getAttribute('idemployee')));
                d.setEmployee(clase.employee);
                d.send.action = 'read';
                d.modalCargandoObject.show();
                document.querySelector('#listTimetableEmploye').style.display='block';
            }
        })

        document.querySelector('#btnBackTmtbWork').onclick = function () {
            document.querySelector('#listTimetableWork').style.display = 'none';
            document.querySelector('#listTimetableEmploye').style.display = 'none';
            document.querySelector('#listUpkeeptTmtbWeekly').style.display = 'block';
        }

    }
}
//##################################################################################################
class CRUDTimetableWork {

    constructor() {
        this.settingsGlobal = new Settings();
        this.api = this.settingsGlobal.api + 'timetbwork';
        this.send = new Send();
        this.parameters = '';
        this.json = '';
        this.timetableweekly = new TimeTableWeekly();
        this.timetablework = new TimeTableWork();
        this.frmUpkeep = document.querySelector('#frmAddTimetableWork');
        this.employee = new Employee()
        this.cemployeelist = [];
        this.actionurl = '?action=' + this.send.action;
        this.modalCargando = document.querySelector('#modalLoadingTimetableWorkCRUD');
        this.modalCargandoObject = new Modal(this.modalCargando, {
            backdrop: false
        });
        this.list = [];
        this.eventsDefault();
    }

    eventsDefault() {
        let clase = this;
        this.modalCargando.addEventListener("show.bs.modal", function (event) {
            clase.run();
        });
        this.frmUpkeep.onsubmit = function () {
            clase.setObject();
            return false;
        }
    }

    read() {
        this.send.action = 'read';
        this.json = '';
        this.modalCargandoObject.show();
    }

    create() {
        this.send.action = 'create';
        this.parameters = '';
    }

    delete() {
        this.send.action = 'delete';
        this.parameters = '';
    }

    setObject() {
        this.timetablework.number_hours = parseInt(this.frmUpkeep.txtNumberHoursTimetableWork.value);
        this.timetablework.number_minutes = parseInt(this.frmUpkeep.slcNumberMinutesTimetableWork.value);
        this.timetablework.idtimetable_weekly = this.timetableweekly.idtimetable_weekly;
        this.json = this.timetablework;
        this.modalCargandoObject.show();
    }

    run() {
        this.actionurl = '?action=' + this.send.action;
        this.parameters = '';
        if (this.send.action == 'read') {
            this.parameters += '&idtimetable_weekly=' + this.timetableweekly.idtimetable_weekly;
            this.parameters += '&filter=' + '';
            this.parameters += '&size=' + 10;
            this.parameters += '&page=' + 1;
            this.parameters += '&idemployee=' + this.employee.idemployee;
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
                clase.list = [];
                if (jsonResponse.counter > 0) {
                    jsonResponse.content.forEach(element => {
                        //clase.list.push(element);
                        console.log(element)
                        clase.list.push(new Hours(element));
                    });
                } else {
                    //new ModalAlert('Horarios sin Asignar a ');
                }
                //TODO: UPDATE, CREATE, DELETE
                if (jsonResponse.message != 'ok') {
                    clase.read();
                    d.read();
                    c.read()
                    //clase.modalUpkeepObject.hide();
                    new ModalAlert(jsonResponse.message);
                }
            } else {
                //TODO: ERROR(TRUE) DEL SERVIDOR
                new ModalAlert(jsonResponse.message, 'warning');
            }
            clase.modalCargandoObject.hide();
        }).then(function () {
            clase.setTimetable();
            //clase.print();
        }).catch(function (error) {
            new ModalAlert(error, 'error')
            console.error(error);
            clase.modalCargandoObject.hide();
        });
    }

    setTimetable() {
        document.querySelectorAll('.btn-item-work').forEach(btnItem => {
            this.list.forEach(itemHours => {
                if (parseInt(itemHours.tmtbE.day) == parseInt(btnItem.getAttribute('day'))) {
                    let btnDel = document.querySelector('#delete-' + itemHours.tmtbE.day);
                    btnDel.disabled = false;
                    btnDel.setAttribute('idtimetable_work', itemHours.tmtbE.idtimetable_work);
                    btnDel.setAttribute('idtimetable_weekly', itemHours.tmtbE.idtimetable_weekly);
                    btnDel.setAttribute('idemployee', itemHours.tmtbE.idemployee);
                    itemHours.arrayHours.forEach(hour => {
                        console.log(hour);
                        btnItem.classList.remove('btn-success');
                        btnItem.disabled = true;
                        if (btnItem.getAttribute('hour') == hour.hour && btnItem.getAttribute('min') == hour.min) {
                            btnItem.innerHTML = '<i class="fas fa-users"></i>';
                            btnItem.classList.remove('btn-warning');
                            btnItem.classList.add('btn-primary');

                        } else if (btnItem.getAttribute('hour') != hour.hour &&
                            btnItem.getAttribute('min') != hour.min &&
                            !btnItem.classList.contains('btn-primary')) {
                            btnItem.classList.add('btn-warning');
                        }
                    })
                }
            })
        });
        this.eventsList();
    }

    eventsList() {
        let clase = this;
        document.querySelectorAll('.btn-delete-work').forEach(btnDelete => {
            btnDelete.onclick = function () {
                clase.timetablework.idtimetable_work = parseInt(this.getAttribute('idtimetable_work'));
                clase.timetablework.idtimetable_weekly = parseInt(this.getAttribute('idtimetable_weekly'));
                clase.timetablework.idemployee = parseInt(this.getAttribute('idemployee'));
                clase.delete();
                clase.json = clase.timetablework;
                new ModalAction(clase.modalCargandoObject, 'Seguro que desea Eliminar a ' + clase.employee.names + ' ' + clase.employee.paternal + ' ' + clase.employee.maternal);
            }
        })
    }
}

let c = new RTimetableWork();
//c.read();
let c1 = new CRUDTimetableWork();