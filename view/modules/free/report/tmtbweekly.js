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
        this.modalUpkeep = document.querySelector('#modalUpkeepTmtbWeekly');
        this.list = [];
        this.TmtbWeekly = new TimeTableWeekly();
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
            this.parameters += '&filter=';
            this.parameters += '&estate=-1';
            this.parameters += '&size=' + 10000;
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
                if (jsonResponse.counter > 0) {
                    clase.list = [];
                    jsonResponse.content.forEach(element => {
                        clase.TmtbWeekly = element;
                        element.estate == 'V' ?  c.timetableweekly = element : null;
                        document.querySelector('#titleTimetableWork').innerHTML = 'HORARIO SEMANAL [ ' + c.timetableweekly.description + ' ]';
                        c.read();
                        clase.list.push(clase.TmtbWeekly);

                    });
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
}

let b = new CRUDTmtbWeekly();