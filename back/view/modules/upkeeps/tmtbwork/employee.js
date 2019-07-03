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
    this.frmSearch = document.querySelector('#FrmSearchEmployee');
    this.btnCreate = document.querySelector('#btnCreateEmployee');
    this.frmUpkeep = document.querySelector('#frmUpkeepEmployee');
    this.modalUpkeep = document.querySelector('#modalUpkeepEmployee');
    this.modalUpkeepObject = new Modal(this.modalUpkeep);
    this.modalChangePass = document.querySelector('#modalChangePassEmployee');
    this.modalChangePassObject = new Modal(this.modalChangePass);
    this.frmChangePass = document.querySelector('#frmChangePassEmployee');
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

    this.modalUpkeep.addEventListener("hide.bs.modal", function (event) {
      clase.send.action = 'read';
      clase.json = '';
    });
    
    this.frmSearch.onsubmit = function () {
      clase.read();
      return false;
    }

    document.querySelectorAll('.searchEmployee').forEach(search => {
      search.onchange = function () {
        search.classList.contains('sendSize') ? clase.send.sizePage = this.value : null;
        clase.send.numberPage = 1;
        clase.read();
      }
    });
  }

  read() {
    this.send.action = 'read';
    this.json = '';
    this.modalCargandoObject.show();
  }

  delete() {
    this.send.action = 'delwork';
    this.parameters = '';
    this.json = this.employee;
  }

  run() {
    this.actionurl = '?action=' + this.send.action;
    this.parameters = '';
    if (this.send.action == 'read') {
      this.parameters += '&filter=' + document.querySelector('#txtFilterEmployeeSearch').value;
      this.parameters += '&gender=' + document.querySelector('#slcGenderEmployeeSearch').value;
      this.parameters += '&size=' + document.querySelector('#sizePageEmployee').value;
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
      //response.text().then(text=>{console.info(text)});
      return response.json();
    }).then(function (jsonResponse) {
      if (jsonResponse.error == false) {
        document.getElementById("tbodyEmployee").innerHTML = '';
        if (jsonResponse.counter > 0) {
          clase.list = [];
          document.querySelector('#titleEmployee').innerHTML = '[ ' + jsonResponse.counter + ' ] COLABORADORES';
          jsonResponse.content.forEach(element => {
            clase.employee = element;
            clase.list.push(clase.employee);
          });
          clase.print();
          new Pagination(jsonResponse.counter, clase.send, 'paginationEmployee', clase.modalCargandoObject);
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
      new ModalAlert(error, 'error')
      clase.modalCargandoObject.hide();
    });
  }
  print() {
    document.getElementById("tbodyEmployee").innerHTML = '';
    let row = '';
    this.list.forEach(function (employee) {
      row = '<tr>'
      row += '<td class="align-middle text-center" style="white-space: nowrap;"><small><i class="far fa-id-card mr-1"></i>' + employee.dni + '</small></td>';
      row += '<td style="white-space: nowrap;"><small><i class="far fa-user mr-1"></i>' + employee.paternal + ' ' + employee.maternal + ' ' + employee.names.split(' ')[0] + '</small></td>';
      row += '<td class="align-middle text-center"><button idemployee="' + employee.idemployee + '" type="button" class="btn btn-sm btn-outline-danger deleteTimetableEmployee"><small><i class="fas fa-snowplow"></i></small></button></td>';
      row += '</tr>';
      document.getElementById("tbodyEmployee").innerHTML += row;
    });
    this.eventsList();
  }

  eventsList() {
    let clase = this;
    document.querySelectorAll('.deleteTimetableEmployee').forEach(btnUpdate => {
      btnUpdate.onclick = function () {
        clase.setEmployee(parseInt(this.getAttribute('idemployee')));
        clase.delete();
        new ModalAction(clase.modalCargandoObject, 'Seguro que desea Eliminar los Horarios de Trabajo de ' + clase.employee.names + ' ' + clase.employee.paternal + ' ' + clase.employee.maternal+'(Se Eliminaran de Todos los Horarios Semanales Existentes)');
      }
    });

  }

}
new CRUDEmployee();