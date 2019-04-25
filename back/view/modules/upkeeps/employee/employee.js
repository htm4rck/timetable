class Send {
  constructor() {
    this.action = 'paginate';
    this.method = 'POST'
    this.numberPage = 1;
    this.sizePage = 10;
  }
}
class Employee {
  constructor() {
    this.idemployee = 0;
    this.paternal = '';
    this.maternal = '';
    this.names = '';
    this.login = '';
    this.pass = '';
    this.weekly_hours = 0;
    this.extra_hours = 0;
    this.extra_minutes = 0;
    this.gender = '';
    this.dni = '';
    this.mobile = '';
  }
}

class CRUD {

  constructor() {
    this.settingsGlobal = new Settings();
    this.api = this.settingsGlobal.api+'employee';
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
      clase.send.action = 'paginate';
      clase.json = '';
    });

    this.frmUpkeep.onsubmit = function () {
      clase.setObject();
      return false;
    };

    this.btnCreate.onclick = function () {
      clase.create();
      clase.modalUpkeepObject.show();
    }
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
    })
  }

  read() {
    this.send.action = 'paginate';
    this.json = '';
    this.modalCargandoObject.show();
  }
  create() {
    this.frmUpkeep.txtPaternalEmployee.value = '';
    this.frmUpkeep.txtMaternalEmployee.value = '';
    this.frmUpkeep.txtNamesEmployee.value = '';
    this.frmUpkeep.slcGenderEmployee.value = 'M';
    this.frmUpkeep.txtMobileEmployee.value = '';
    this.frmUpkeep.txtWeekly_HoursEmployee.value = '24';
    this.frmUpkeep.txtDniEmployee.value = '';

    this.send.action = 'create';
    this.parameters = '';
  }
  update() {
    this.frmUpkeep.txtPaternalEmployee.value = this.employee.paternal;
    this.frmUpkeep.txtMaternalEmployee.value = this.employee.maternal;
    this.frmUpkeep.txtNamesEmployee.value = this.employee.names;
    this.frmUpkeep.slcGenderEmployee.value = this.employee.gender;
    this.frmUpkeep.txtMobileEmployee.value = this.employee.mobile;
    this.frmUpkeep.txtWeekly_HoursEmployee.value = this.employee.weekly_hours;
    this.frmUpkeep.txtDniEmployee.value = this.employee.dni;

    this.send.action = 'update';
    this.parameters = '';
  }
  delete() {

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
    this.parameters += '&filter=' + document.querySelector('#txtFilterEmployeeSearch').value;
    this.parameters += '&gender=' + document.querySelector('#slcGenderEmployeeSearch').value;
    this.parameters += '&size=' + document.querySelector('#sizePageEmployee').value;
    this.parameters += '&page=' + this.send.numberPage;
    console.log(this.api + this.actionurl + this.parameters);
    console.log(this.send.method);
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
      new ModalAlert(error,'error')
      clase.modalCargandoObject.hide();
    });
  }
  print() {
    document.getElementById("tbodyEmployee").innerHTML = '';
    let row = '';
    this.list.forEach(function (employee) {
      row = '<tr>'
      row += '<td class="align-middle text-center"><i class="far fa-id-card mr-1"></i>' + employee.dni + '</td>';
      row += '<td><i class="far fa-user mr-1"></i>' + employee.paternal + ' ' + employee.maternal + ' ' + employee.names + '<br><i class="fas fa-mobile-alt mr-1"></i>' + employee.mobile + '</td>';
      row += '<td><i class="far fa-clock mr-1"></i>' + employee.weekly_hours + ':00</td>';
      row += '<td><i class="fas fa-history mr-1"></i>' + employee.extra_hours + ':' + 0 + '</td>';
      row += '<td><button idemployee="' + employee.idemployee + '" type="button" class="btn btn-outline-warning updateEmployee"><i class="far fa-edit"></i></button></td>';
      row += '<td><button idemployee="' + employee.idemployee + '" type="button" class="btn btn-outline-danger deleteEmployee"><i class="far fa-trash-alt"></i></button></td>';
      row += '</tr>';
      document.getElementById("tbodyEmployee").innerHTML += row;
    });
    this.eventsList();
  }

  eventsList() {
    let clase = this;
    document.querySelectorAll('.updateEmployee').forEach(btnUpdate => {
      btnUpdate.onclick = function () {
        clase.setEmployee(parseInt(this.getAttribute('idemployee')));
        clase.update();
        clase.modalUpkeepObject.show();
      }
    });

  }

}
let a = new CRUD();