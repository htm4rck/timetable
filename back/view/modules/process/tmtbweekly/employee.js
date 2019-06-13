class CRUDEmployee {

  constructor() {
    this.settingsGlobal = new Settings();
    this.api = this.settingsGlobal.api + 'employee';
    this.send = new Send();
    this.parameters = '';
    this.json = '';
    this.actionurl = '?action=' + this.send.action;
    this.modalCargando = document.querySelector('#modalCargandoEmployee');
    this.modalCargandoObject = new Modal(this.modalCargando, {
      backdrop: false
    });
    this.list = [];
    this.employee = new Employee();
    this.eventsDefault();
    this.read();
  }
  setEmployee(id) {
    let clase = this;
    this.employee = new Employee();
    this.list.forEach(function (element, index) {
      if (element.idemployee == id) {
        clase.employee = element;
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
      this.parameters += '&gender=' + '-1';
      this.parameters += '&size=' + 1000;
      this.parameters += '&page=' + 1;
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
      console.log(jsonResponse);
      if (jsonResponse.error == false) {
        //document.getElementById("tbodyEmployee").innerHTML = '';
        if (jsonResponse.counter > 0) {
          clase.list = [];
          //document.querySelector('#titleEmployee').innerHTML = '[ ' + jsonResponse.counter + ' ] COLABORADORES';
          jsonResponse.content.forEach(element => {
            clase.employee = element;
            clase.list.push(clase.employee);
          });
          //clase.print();
          //new Pagination(jsonResponse.counter, clase.send, 'paginationEmployee', clase.modalCargandoObject);
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
    }).then(function () {
      console.log(clase.list);
      new CRUDTmtbWeekly(clase.list);
    }
    ).catch(function (error) {
      new ModalAlert(error, 'error')
      clase.modalCargandoObject.hide();
    });
  }

}
let em = new CRUDEmployee();