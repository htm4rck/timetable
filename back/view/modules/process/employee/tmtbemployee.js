class CRUDTimetableEmployee {

    constructor() {
        this.settingsGlobal = new Settings();
        this.api = this.settingsGlobal.api + 'timetbemployee';
        this.send = new Send();
        this.parameters = '';
        this.json = '';
        this.employee = new Employee();
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
        this.employee = employee
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
    create() {
        this.send.action = 'create';
        this.parameters = '';
    }

    delete() {
        this.send.action = 'delete';
        this.parameters = '';
    }

    setObject() {
        this.employee.paternal = document.querySelector('#txtPaternalEmployee').value;
        this.employee.maternal = document.querySelector('#txtMaternalEmployee').value;
        this.employee.names = document.querySelector('#txtNamesEmployee').value;
        this.employee.gender = document.querySelector('#slcGenderEmployee').value;
        this.employee.mobile = document.querySelector('#txtMobileEmployee').value;
        this.employee.weekly_hours = document.querySelector('#txtWeekly_HoursEmployee').value == '' ? 0 : document.querySelector('#txtWeekly_HoursEmployee').value;
        this.employee.dni = document.querySelector('#txtDniEmployee').value;
        this.json = this.employee;
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
            //response.text().then(text=>{console.info(text)});
            return response.json();
        }).then(function (jsonResponse) {
            //console.trace(jsonResponse)
            if (jsonResponse.error == false) {
                clase.list = [];
                if (jsonResponse.counter > 0) {
                    jsonResponse.content.forEach(element => {
                        clase.list.push(new Hours(element));
                    });
                    //TODO: UPDATE, CREATE, DELETE
                    if (jsonResponse.message != 'ok') {
                        clase.read();
                        clase.modalUpkeepObject.hide();
                        new ModalAlert(jsonResponse.message);
                    }
                } else {
                    new ModalAlert('Horarios sin Asignar' + clase.employee.names, 'error');
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
        thead.innerHTML = '<th class="text-center align-middle"><button class="btn btn-success btn-sm">H</button></th>';
        thead.innerHTML += '<th class="text-center align-middle"><button class="btn btn-success btn-sm">M</button></th>';
        listDia.forEach(dia => {
            thead.innerHTML += '<th class="text-center align-middle" style="width: 12.50%"><button class="btn btn-sm text-success bg-white">' + dia.abr + '</button></th>';
        });
        let tr = '';
        for (let i = 9; i < 24; i++) {
            let hora = "";
            if (i < 10) {
                hora += "0" + i;
            }
            if (i > 9) {
                hora += i;
            }
            tr += '<tr>';
            tr += '  <td rowspan="2" class="align-middle">';
            tr += '    <button class="btn btn-outline-dark btn-sm"><h6>' + hora + '</h6></button>';
            tr += '  </td>';
            for (let j = 0; j < 2; j++) {
                if (j == 0) {
                    tr += '<td><button class="btn btn-outline-dark btn-sm">:00</button></td>'
                } else
                    if (j == 1) {
                        tr += '<tr>'
                        tr += '<td><button class="btn btn-outline-dark btn-sm">:30</button></td>'
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
                    if (existe == -1) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-outline-success btn-sm addTimetableEmployee" dia="' + dia.id + '" hour="' + i + '" min="' + (j == 0 ? 0 : 30) + '"><i class="fas fa-battery-full"></i></button>'
                        tr += '</td>'
                    }
                    else if (existe == 1) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-primary" dia="' + dia.id + '" hour="' + i + '" min="' + (j == 0 ? 0 : 30) + '" disabled><i class="far fa-grin-squint-tears"></i></button>'
                        tr += '</td>'
                    }
                    else if (existe == 2) {
                        tr += '<td class="text-center align-middle">';
                        tr += '<button class="btn btn-outline-info btn-sm" dia="' + dia.id + '" hour="' + i + '" min="' + (j == 0 ? 0 : 30) + '" disabled><i class="fas fa-battery-full"></i></button>'
                        tr += '</td>'
                    }
                    //TODO :BOTONES END
                });
                tr += '</tr>'
            }
            tbody.innerHTML = tr;

        }
        this.eventsList();
    }

    eventsList() {
        let clase = this;
        document.querySelectorAll('.addTimetableEmployee').forEach(btnAdd => {
            btnAdd.onclick = function () {
                clase.modalAddTimetableEmployeeObject.show();
            }
        });
    }
}
let tm = new CRUDTimetableEmployee();

class TimeTableEmployee {
    constructor() {
        this.idtimetable_employee;
        this.day = 0;
        this.start_hour = 10;
        this.start_minute = 30;
        this.number_hours = 4;
        this.number_minutes = 30;
        this.idemployee = 1;
    }
}
class Hour {
    constructor(hour = 0, min = 0) {
        this.hour = hour;
        this.min = min;
    }
}
class Hours {
    constructor(TimeTableEmployee) {
        this.tmtbE = TimeTableEmployee;
        this.arrayHours = [];
        this.setArrayHours();
    }
    setArrayHours() {
        let iterator = this.tmtbE.number_hours * 2;
        this.tmtbE.number_minutes == 0 ? iterator += 0 : iterator++;
        let hour = this.tmtbE.start_hour;
        let min = this.tmtbE.start_minute;
        for (let i = 0; i < iterator; i++) {
            this.arrayHours.push(new Hour(hour, min));
            min == 0 ? (min = 30) : (hour++ , min = 0);
        }
    }
}