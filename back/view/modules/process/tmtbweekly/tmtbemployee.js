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
        this.modalAddTimetableWork = document.querySelector('#modalAddTimetableWork');
        this.modalAddTimetableWorkObject = new Modal(this.modalAddTimetableWork);
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
        document.querySelector('#btnBackListEmployee').onclick=function () {
            document.querySelector('#listTimetableEmploye').style.display = 'none';
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
            this.parameters += '&size=' + 100;
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
            console.log(error);
        });
    }

    print() {
        //TODO : PANEL USUARIO
        let nameEmployee = document.querySelector('#nameEmployee');
        nameEmployee.innerHTML = this.employee.paternal + ' ' + this.employee.maternal + ', ' + this.employee.names;
        let mobileEmployee = document.querySelector('#mobileEmployee');
        mobileEmployee.innerHTML = '<i class="fas fa-fw fa-phone-volume"></i>' + this.employee.mobile;
        /*let hrSemanales = document.querySelector('#hrSemanalesEmployee');
        hrSemanales.innerHTML = 'HORAS SEMANALES: ' + this.employee.weekly_hours + ':00';
        */
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
            trDel += '<td class="text-center align-middle" style="width: 12.50%">';
            trDel += '<button class="btn btn-sm btn-danger btn-delete-work" id ="delete-' + dia.id + '" disabled>';
            trDel += '<i class="far fa-trash-alt"></i></button></td>';
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
                    let maxH = 0;
                    let maxM = 0;
                    this.list.forEach(hrs => {
                        dia.id == hrs.tmtbE.day ? existe = 2 : null;
                        hrs.arrayHours.forEach(hr => {
                            if (hrs.tmtbE.day == dia.id && hr.hour == i && hr.min == (j == 0 ? 0 : 30)) {
                                maxH = hr.maxH;
                                maxM = hr.maxM;
                                existe = 1;
                            }
                        })
                    })
                    if (existe == -1) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-outline-info btn-sm addTimetableEmployee" disabled><i class="fas fa-battery-full"></i></button>'
                        tr += '</td>'
                    } else if (existe == 1) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-success btn-item-work" maxh="' + maxH + '" maxm="' + maxM + '" day="' + dia.id + '" hour="' + i + '" min="' + (j == 0 ? 0 : 30) + '">';
                        tr += '<i class="far fa-grin-squint-tears"></i></button>'
                        tr += '</td>'
                    } else if (existe == 2) {
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
        this.setTimetable();
        this.eventsList();
    }

    setTimetable() {
        c1.timetableweekly = c.timetableweekly;
        c1.employee = c.employee;
        c1.read();

    }
    eventsList() {
        let clase = this;
        let txtHours = document.querySelector('#txtNumberHoursTimetableWork');
        let slcMinutes = document.querySelector('#slcNumberMinutesTimetableWork');
        document.querySelectorAll('.btn-item-work').forEach(btnWork => {
            btnWork.onclick = function () {
                let title = document.querySelector('#title-modalAddTimetableWork');
                let sTitle = 'REGISTRAR HORARIO EN ' +
                    getDia(this.getAttribute('day')).nombre + ' ' +
                    this.getAttribute('hour') + ':' + (this.getAttribute('min') == 0 ? '00' : '30');
                title.innerHTML = sTitle;
                txtHours.setAttribute('min', 0);
                slcMinutes.value = 0;
                slcMinutes.disabled = false;
                txtHours.setAttribute('max', btnWork.getAttribute('maxh'));
                txtHours.setAttribute('maxm', btnWork.getAttribute('maxm'));
                txtHours.value = 0;
                clase.modalAddTimetableWorkObject.show();
                c1.create();
                c1.timetablework.day = parseInt(btnWork.getAttribute('day'));
                c1.timetablework.start_hour = parseInt(btnWork.getAttribute('hour'));
                c1.timetablework.start_minute = parseInt(btnWork.getAttribute('min'));
                c1.timetablework.idemployee = parseInt(clase.employee.idemployee);
            }
        });
        txtHours.onchange = function () {
            this.value == this.getAttribute('max') ?
                (this.getAttribute('maxm') == 30 ? slcMinutes.disabled = false : (slcMinutes.disabled = true, slcMinutes.value = 0)) :
                slcMinutes.disabled = false;
        }

    }
}
let d = new CRUDTimetableEmployee();