class CRUDTimetableEmployee {

    constructor() {
        this.settingsGlobal = new Settings();
        this.api = this.settingsGlobal.api + 'timetbemployee';
        this.hourStart = 9;
        this.hourEnd = 24;
        this.minHours = 3;
        this.send = new Send();
        this.parameters = '';
        this.json = '';
        this.timetableemployee = new TimeTableEmployee();
        this.employee = new Employee();
        this.frmUpkeep = document.querySelector('#frmAddTimetableEmployee');
        this.actionurl = '?action=' + this.send.action;
        this.modalCargando = document.querySelector('#modalCargandoTimetableEmployee');
        this.modalCargandoObject = new Modal(this.modalCargando, {
            backdrop: false
        });
        this.modalAddTimetableEmployee = document.querySelector('#modalAddTimetableEmployee');
        this.modalAddTimetableEmployeeObject = new Modal(this.modalAddTimetableEmployee);
        this.list = [];
        this.eventsDefault();
    }

    setEmployee(employee) {
        this.employee = employee;
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
        this.timetableemployee.number_hours = parseInt(this.frmUpkeep.txtNumberHoursTimetableEmployee.value);
        this.timetableemployee.number_minutes = parseInt(this.frmUpkeep.slcNumberMinutesTimetableEmployee.value);
        this.json = this.timetableemployee;
        this.modalCargandoObject.show();
    }

    run() {
        this.actionurl = '?action=' + this.send.action;
        this.parameters = '';
        if (this.send.action == 'read') {
            this.parameters += '&filter=' + document.querySelector('#txtFilterEmployeeSearch').value;
            this.parameters += '&gender=' + document.querySelector('#slcGenderEmployeeSearch').value;
            this.parameters += '&size=' + document.querySelector('#sizePageEmployee').value;
            this.parameters += '&page=' + this.send.numberPage;
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
            return response.json();
        }).then(function (jsonResponse) {
            if (jsonResponse.error == false) {
                clase.list = [];
                if (jsonResponse.counter > 0) {
                    jsonResponse.content.forEach(element => {
                        clase.list.push(new Hours(element));
                    });
                    //TODO: UPDATE, CREATE, DELETE
                    if (jsonResponse.message != 'ok') {
                        clase.read();
                        //clase.modalUpkeepObject.hide();
                        new ModalAlert(jsonResponse.message);
                    }
                } else {
                    new ModalAlert('Horarios sin Asignar a ' + clase.employee.names, 'error');
                }
            } else {
                //TODO: ERROR(TRUE) DEL SERVIDOR
                new ModalAlert(jsonResponse.message, 'warning');
            }
            clase.modalCargandoObject.hide();
            clase.print();
        }).catch(function (error) {
            new ModalAlert(error, 'error')
            clase.modalCargandoObject.hide();
        });
    }
    print() {
        //TODO : PANEL USUARIO
        let nameEmployee = document.querySelector('#nameEmployee');
        nameEmployee.innerHTML = this.employee.paternal + ' ' + this.employee.maternal + ', ' + this.employee.names;
        let mobileEmployee = document.querySelector('#mobileEmployee');
        mobileEmployee.innerHTML = '<i class="fas fa-fw fa-phone-volume"></i>' + this.employee.mobile;
        let hrSemanales = document.querySelector('#hrSemanalesEmployee');
        hrSemanales.innerHTML = 'HORAS SEMANALES: ' + this.employee.weekly_hours + ':00';
        let hrExtra = document.querySelector('#hrExtraEmployee');
        let minExtra = '00'
        this.employee.extra_minutes == 0 ? minExtra = '00' : minExtra = '30'
        hrExtra.innerHTML = 'HORAS EXTRA: 0' + this.employee.extra_hours + ':' + minExtra;
        //TODO : TABLA DE HORARIO
        let thead = document.querySelector('#listTimetableEmployeeHead');
        let tbody = document.querySelector('#listTimetableEmployeeBody');
        thead.innerHTML = '<th class="text-center align-middle" colspan="2" rowspan="2"><button class="btn btn-sm text-success bg-white"><i class="far fa-calendar-alt"></i></button></th>';
        listDia.forEach(dia => {
            thead.innerHTML += '<th class="text-center align-middle" style="width: 12.50%"><button class="btn btn-sm text-success bg-white">' + dia.abr + '</button></th>';
        });
        let trDel = '';
        trDel += '<tr>';
        trDel += '<td class="text-center align-middle"><button class="btn btn-sm btn-success">H</button></td>';
        trDel += '<td class="text-center align-middle"><button class="btn btn-sm btn-success">M</button></td>';

        listDia.forEach(dia => {
            trDel += '<td class="text-center align-middle" style="width: 12.50%"><button class="btn btn-sm btn-danger deleteTimetableEmployee" id ="delete-' + this.employee.idemployee + dia.id + '" idtimetableemployee ="' + this.employee.idemployee + dia.id + '" disabled><i class="far fa-trash-alt"></i></button></td>';
        });
        trDel += '</tr>';
        tbody.innerHTML = trDel;

        let tr = '';
        for (let i = this.hourStart; i < this.hourEnd; i++) {
            let hora = "";
            if (i < 10) {
                hora += "0" + i;
            }
            if (i > 9) {
                hora += i;
            }
            tr += '<tr>';
            tr += '  <td rowspan="2" class="align-middle text-center">';
            tr += '    <button class="btn btn-outline-dark btn-sm"><h6>' + hora + '</h6></button>';
            tr += '  </td>';
            for (let j = 0; j < 2; j++) {
                if (j == 0) {
                    tr += '<td class="align-middle text-center"><button class="btn btn-outline-dark btn-sm">:00</button></td>'
                } else
                    if (j == 1) {
                        tr += '<tr>'
                        tr += '<td class="align-middle text-center"><button class="btn btn-outline-dark btn-sm">:30</button></td>'
                    }
                listDia.forEach(dia => {
                    //TODO :BOTONES START
                    /*
                    *-1 HORARIO SIN ASIGNAR
                    * 1 HORARIO ASIGNADO
                    * 2 HORARIO NO DISPONIBLE
                    */
                    let existe = -1;
                    this.list.forEach(hrs => {
                        dia.id == hrs.tmtbE.day ? existe = 2 : null;
                        hrs.arrayHours.forEach(hr => {
                            if (hrs.tmtbE.day == dia.id && hr.hour == i && hr.min == (j == 0 ? 0 : 30)) {
                                existe = 1;
                            }
                        })
                    })
                    if (existe != -1) {
                        document.querySelector('#delete-' + this.employee.idemployee + dia.id).disabled = false;
                    }
                    if (existe == -1) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-outline-success btn-sm addTimetableEmployee" dia="' + dia.id + '" hour="' + i + '" min="' + (j == 0 ? 0 : 30) + '"><i class="fas fa-battery-full"></i></button>'
                        tr += '</td>'
                    }
                    else if (existe == 1) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-primary" disabled><i class="far fa-grin-squint-tears"></i></button>'
                        tr += '</td>'
                    }
                    else if (existe == 2) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-outline-info btn-sm" disabled><i class="fas fa-battery-full"></i></button>'
                        tr += '</td>'
                    }
                    //TODO :BOTONES END
                });
                tr += '</tr>'
            }
        }
        tbody.innerHTML += tr;
        this.eventsList();
    }

    eventsList() {
        let clase = this;
        let numberHours = document.querySelector('#txtNumberHoursTimetableEmployee');
        let numberMinutes = document.querySelector('#slcNumberMinutesTimetableEmployee');
        let min = 0;

        document.querySelectorAll('.deleteTimetableEmployee').forEach(btnDelete => {
            btnDelete.onclick = function () {
                clase.timetableemployee.idtimetable_employee = parseInt(this.getAttribute('idtimetableemployee'));
                clase.timetableemployee.idemployee = clase.employee.idemployee;
                clase.delete();
                clase.json = clase.timetableemployee;
                new ModalAction(clase.modalCargandoObject, 'Seguro que desea Eliminar a ' + clase.employee.names + ' ' + clase.employee.paternal + ' ' + clase.employee.maternal);
            }
        });

        document.querySelectorAll('.addTimetableEmployee').forEach(btnAdd => {
            btnAdd.onclick = function () {
                clase.create();
                clase.timetableemployee.day = parseInt(btnAdd.getAttribute('dia'));
                clase.timetableemployee.start_hour = parseInt(btnAdd.getAttribute('hour'));
                clase.timetableemployee.start_minute = parseInt(btnAdd.getAttribute('min'));
                clase.timetableemployee.idemployee = parseInt(clase.employee.idemployee);
                btnAdd.getAttribute('min') == 0 ? min = 0 : min = 0.5;
                let title = document.querySelector('#title-modalAddTimetableEmployee');
                let sTitle = 'REGISTRAR HORARIO EN ' +
                    getDia(btnAdd.getAttribute('dia')).nombre + ' ' +
                    btnAdd.getAttribute('hour') + ':' + (btnAdd.getAttribute('min') == 0 ? '00' : '30');
                title.innerHTML = sTitle;
                numberHours.value = clase.minHours;
                numberHours.setAttribute('min', clase.minHours);
                //TODO : MAXIMO DE HORAS
                numberHours.setAttribute('max',
                    (clase.hourEnd - (btnAdd.getAttribute('min') == 0 ?
                        parseInt(btnAdd.getAttribute('hour')) : (parseInt(btnAdd.getAttribute('hour')) + 1))
                    ));
                //TODO : DESABILITAR LOS MINUTOS
                (clase.hourEnd - btnAdd.getAttribute('hour')) <= clase.minHours ?
                    (numberMinutes.value = 0, numberMinutes.disabled = true) : numberMinutes.disabled = false;
                //TODO : HORARIOS MENORES AL MINIMO
                (clase.hourEnd - ((btnAdd.getAttribute('min') == 0 ? 0 : 0.5) + parseInt(btnAdd.getAttribute('hour')))) < clase.minHours ?
                    (new ModalAlert('Como minimo debe Asignar ' + clase.minHours + ' Horas', 'error'), clase.read()) : clase.modalAddTimetableEmployeeObject.show();
            }
        });

        numberHours.onchange = function () {
            (parseInt(this.getAttribute('max')) + parseFloat(min)) == numberHours.value ?
                (numberMinutes.value = 0, numberMinutes.disabled = true) : numberMinutes.disabled = false;
        }
    }
}
let tm = new CRUDTimetableEmployee();

