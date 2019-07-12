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
        this.report = {};
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
        this.report.title = 'HORARIO SEMANAL [ ' + this.timetableweekly.description + ' ]';
        this.report.head = [];
        this.report.body = [];
        this.report.head.push('COLABORADOR');
        tbody.innerHTML = ''
        thead.innerHTML = '<th class="text-center align-middle" colspan="2" rowspan="2"><button class="btn btn-sm text-success bg-white"><i class="far fa-user mr-1"></i><small></small></button></th>';
        listDia.forEach(dia => {
            this.report.head.push(dia.nombre);
            thead.innerHTML += '<th class="text-center align-middle" style="width: 12.50%"><button class="btn btn-sm text-success bg-white"><small>' + dia.nombre + '</small></button></th>';
        });
        let tr = '';
        a.list.forEach(employee => {
            let row = [];
            row.push(employee.names.split(' ')[0] + ' ' + employee.paternal + ' ' + employee.maternal.substring(0, 1)+'.');
            tr += '<tr>'
            tr += '<td colspan="2" style="white-space: nowrap;"><small><i class="far fa-user mr-1"></i>' + employee.names.split(' ')[0] + ' ' + employee.paternal + ' ' + employee.maternal.substring(0, 1) + '. ' + '<br><i class="fas fa-mobile-alt mr-1"></i>' + employee.mobile + '</small></td>';
            listDia.forEach(dia => {
                let existe = -1
                let lwork = ''
                let hora = 0;

                this.list.forEach(work => {

                    (dia.id == work.day && work.idemployee == employee.idemployee) ? (hora = work.start_hour + (work.start_minute == 0 ? 0 : 0.5) + work.number_hours + (work.number_minutes == 0 ? 0 : 0.5), existe = 1, lwork = (work.start_hour>9?work.start_hour:'0'+work.start_hour) + (work.start_minute == 0 ? ':00-' : ':30-')) : null;
                })
                if (existe == -1) {
                    row.push('Libre');
                    tr += '<td style="white-space: nowrap;color:red;" class="text-center align-middle"><small><i class="fas fa-calendar-day mr-1"></i>LIBRE</small></td>';
                } else {
                    row.push(lwork + (Number.isInteger(hora) ? parseInt(hora) + ':00' : parseInt(hora) + ':30'));
                    tr += '<td style="white-space: nowrap;" class="text-center align-middle"><small><i class="fas fa-business-time mr-1"></i>' + lwork + (Number.isInteger(hora) ? parseInt(hora) + ':00' : parseInt(hora) + ':30') + '</small></td>';
                }
            })
            tr += '</tr>'
            this.report.body.push(row);
        })
        tbody.innerHTML += tr;
        this.reportPDF();
    }
    reportPDF() {
        let clase = this;
        document.querySelector('#btnReport').onclick = function () {
            //alert()
            var doc = new jsPDF();
            // You can use html:
            doc.setFontSize(10);
            doc.text(clase.report.title, 14, 22);
            doc.autoTable({
                startY: 30,
                tableWidth: 'wrap',
                styles: {
                    cellPadding: 3,
                    fontSize: 8
                },
                head: [clase.report.head],
                body: clase.report.body
            });
            doc.output("dataurlnewwindow");
        }
    }

}
let c = new RTimetableWork();