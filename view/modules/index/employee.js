class CRUDEmployee {

  constructor() {
    this.settingsGlobal = new Settings();
    this.api = this.settingsGlobal.api + 'employee';
    this.send = new Send();
    this.parameters = '';
    this.json = '';
    this.actionurl = '?action=' + this.send.action;
    this.modalCargando = document.querySelector('#modalLoadingEmployee');
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
  getEmployee(id) {
    let clase = this;
    this.list.forEach(function (element, index) {
      if (element.idemployee == id) {
        clase.employee = element;
        return;
      }
    })
    return clase.employee;
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
      return response.json();
    }).then(function (jsonResponse) {
      if (jsonResponse.error == false) {
        if (jsonResponse.counter > 0) {
          clase.list = [];
          jsonResponse.content.forEach(element => {
            clase.employee = element;
            clase.list.push(clase.employee);
          });
          if (jsonResponse.message != 'ok') {
            clase.read();
            clase.modalUpkeepObject.hide();
            new ModalAlert(jsonResponse.message);
          }
        } else {
          new ModalAlert('No hay Resultados', 'error');
        }
      } else {
        new ModalAlert(jsonResponse.message, 'warning');
      }
      clase.modalCargandoObject.hide();
    }).catch(function (error) {
      new ModalAlert(error, 'error')
      clase.modalCargandoObject.hide();
    });
  }

}
let a = new CRUDEmployee();