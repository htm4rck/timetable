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
                    });
                    //TODO: UPDATE, CREATE, DELETE
                    if (jsonResponse.message != 'ok') {
                        clase.read();
                        new ModalAlert(jsonResponse.message);
                    }
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
        thead.innerHTML = '<th class="text-center align-middle" colspan="2" rowspan="2"><button class="btn btn-sm text-success bg-white"><small><i class="far fa-user mr-1"></i>COLABORADOR</small></button></th>';
        listDia.forEach(dia => {
            thead.innerHTML += '<th class="text-center align-middle" style="width: 12.50%"><button class="btn btn-sm text-success bg-white"><small>' + dia.nombre + '</small></button></th>';
        });
        let tr = '';
        a.list.forEach(employee => {
            tr += '<tr>'
            tr += '<td colspan="2" style="white-space: nowrap;"><small><i class="far fa-user mr-1"></i>' + employee.paternal + ' ' + employee.maternal + ' ' + employee.names.split(' ')[0] + '<br><i class="fas fa-mobile-alt mr-1"></i>' + employee.mobile + '</small></td>';
            listDia.forEach(dia => {
                let existe = -1
                let lwork = ''
                let hora = 0;
                this.list.forEach(work => {
                    (dia.id == work.day && work.idemployee == employee.idemployee) ?
                    (hora = work.start_hour + (work.start_minute == 0 ? 0 : 0.5) + work.number_hours + (work.number_minutes == 0 ? 0 : 0.5), existe = 1, lwork = work.start_hour + (work.start_minute == 0 ? ':00-' : ':30-')) : null;
                })
                if (existe == -1) {
                    tr += '<td style="white-space: nowrap;color:red;" class="text-center align-middle">';
                    tr += '<small><i class="fas fa-calendar-day mr-1"></i>LIBRE</small></td>';
                } else {
                    tr += '<td style="white-space: nowrap;" class="text-center align-middle">';
                    tr += '<small><i class="fas fa-business-time mr-1"></i>' + lwork + (Number.isInteger(hora) ? parseInt(hora) + ':00' : parseInt(hora) + ':30') + '</small></td>';
                }
            })
            tr += '</tr>'
        })
        tbody.innerHTML += tr;
    }

}
let c = new RTimetableWork();