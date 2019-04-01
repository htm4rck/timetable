class Crud {
  constructor() {
    this.action = 'paginate';
    this.typeRequest = 'POST'
    this.numberPage = 1;
    this.sizePage = '10';
  }
}
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
/*
var crudEmployee = new Crud();
let alertEmployee = new Alert('succes', 'modalAlert', 'El Colaborador se Registro con Exito!');
//alertEmployee.showAlert();
let empleado = new Employee();
let modalCargandoEmployee = document.querySelector('#modalCargandoEmployee');
let modalCargandoEmployeeObject = new Modal(modalCargandoEmployee, {
  backdrop: false
});
document.addEventListener("DOMContentLoaded", function () {
  modalCargandoEmployee.addEventListener("show.bs.modal", function (event) {
    ajaxExec();
  });

  //TODO : ### SEARCH ###
  document.querySelector('#sizePageEmployee').onchange = function () {
    crudEmployee.sizePage = this.value;
    modalCargandoEmployeeObject.show();
    return false;
  }
  document.querySelector('#slcGenderEmployeeSearch').onchange = function () {
    modalCargandoEmployeeObject.show();
    return false;
  }
  document.querySelector('#FrmEmployee').onsubmit = function () {
    crudEmployee.action = 'paginate';
    modalCargandoEmployeeObject.show();
    return false;
  };
  //TODO : ### CREAR EMPLOYEE ###
  document.querySelector('#btnCreateEmployee').addEventListener('click', function () {
    let modal = new Modal(document.querySelector('#modalman'));
    crudEmployee.action = 'insert';
    modal.show();
  });


  document.querySelector('#formularioModal').onsubmit = function () {
    empleado.paternal = document.querySelector('#txtPaternalEmployee').value;
    empleado.maternal = document.querySelector('#txtMaternalEmployee').value;
    empleado.names = document.querySelector('#txtNamesEmployee').value;
    empleado.gender = document.querySelector('#slcGenderEmployee').value;
    empleado.mobile = document.querySelector('#txtMobileEmployee').value;
    empleado.weekly_hours = document.querySelector('#txtWeekly_HoursEmployee').value == '' ? 0 : document.querySelector('#txtWeekly_HoursEmployee').value;
    empleado.dni = document.querySelector('#txtDniEmployee').value;
    ajaxExec();
    return false;
  };
  modalCargandoEmployeeObject.show();
});


function ajaxExec() {
  let action = crudEmployee.action;
  let actionurl = '?action=' + action;
  let parameters = '';
  if (action == 'paginate') {
    parameters += '&filter=' + document.querySelector('#txtFilterEmployeeSearch').value;
    parameters += '&gender=' + document.querySelector('#slcGenderEmployeeSearch').value;
    parameters += '&size=' + crudEmployee.sizePage;
    parameters += '&page=' + crudEmployee.numberPage;
  }
  console.log(parameters);
  fetch("http://localhost/back/api/employee" + actionurl + parameters, {
    method: crudEmployee.typeRequest,
    body: JSON.stringify(empleado),
    headers: {
      'Content-Type': 'application/json'
    }
  }).then(function (response) {
    return response.json();

  }).then(function (jsonResponse) {
    console.log(jsonResponse);
    if (jsonResponse.error == false) {
      if (jsonResponse.counter > 0) {
        toList(jsonResponse.content);
        modalCargandoEmployeeObject.hide();
        new Pagination(jsonResponse.counter, crudEmployee, 'paginationEmployee', modalCargandoEmployeeObject)

        function name(params) {
          alert()
        }
      } else {
        toList(jsonResponse.content);
        alert("no hay resultados");
      }
    } else {
      //console.log(jsonResponse.message.errorInfo)
      //alert(jsonResponse.message.errorInfo+'<br>ada');
    }
  });
  return false;
}

function toList(list) {
  document.getElementById("tbodyEmployee").innerHTML = '';
  list.forEach(function (element) {
    row = '<tr>'
    row += '<td class="align-middle text-center">' + element.dni + '</td>';
    row += '<td>' + element.paternal + ' ' + element.maternal + ' ' + element.names + '<br>' + element.mobile + '</td>';
    row += '</tr>';
    document.getElementById("tbodyEmployee").innerHTML += row;
  });
}
*/
class EmployeeCRUD {

  constructor() {
    this.api = 'http://localhost/back/api/employee';
    this.send = new Send();
    this.parameters = '';
    this.json = '';
    this.action = 'paginate'
    this.actionurl = '?action=' + this.action;
    this.modalCargando = document.querySelector('#modalCargandoEmployee');
    this.modalCargandoObject = new Modal(this.modalCargando, {
      backdrop: false
    });
    this.pagination = new Pagination(10, this.send, 'paginationEmployee', this.modalCargandoObject);
    this.list = [];
    this.employee = new Employee();
    this.events();
  }
  events() {
    let clase = this;
    this.modalCargando.addEventListener("show.bs.modal", function (event) {
      clase.read();
    });
    document.querySelector('#formularioModal').onsubmit = function () {
      clase.create()
      clase.run();
      return false;
    };

    document.querySelector('#btnCreateEmployee').onclick = function () {
      let modal = new Modal(document.querySelector('#modalman'));
      clase.action = 'insert';
      clase.actionurl = '?action=' + clase.action;
      modal.show();
    }

  }

  read() {
    this.parameters += '&filter=' + document.querySelector('#txtFilterEmployeeSearch').value;
    this.parameters += '&gender=' + document.querySelector('#slcGenderEmployeeSearch').value;
    this.parameters += '&size=' + this.send.sizePage;
    this.parameters += '&page=' + this.send.numberPage;
    this.run();
  }
  create() {
    this.employee.paternal = document.querySelector('#txtPaternalEmployee').value;
    this.employee.maternal = document.querySelector('#txtMaternalEmployee').value;
    this.employee.names = document.querySelector('#txtNamesEmployee').value;
    this.employee.gender = document.querySelector('#slcGenderEmployee').value;
    this.employee.mobile = document.querySelector('#txtMobileEmployee').value;
    this.employee.weekly_hours = document.querySelector('#txtWeekly_HoursEmployee').value == '' ? 0 : document.querySelector('#txtWeekly_HoursEmployee').value;
    this.employee.dni = document.querySelector('#txtDniEmployee').value;
    this.json = this.employee;
    console.log(this.json);

  }
  update() {

  }
  delete() {

  }

  run() {
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
      console.info(jsonResponse);
      if (jsonResponse.error == false) {
        if (jsonResponse.counter > 0) {
          clase.list = [];
          jsonResponse.content.forEach(element => {
            clase.employee = element;
            clase.list.push(clase.employee);
          });
          clase.modalCargandoObject.hide();
          clase.print(jsonResponse.content);
          clase.pagination = new Pagination(jsonResponse.counter, clase.send, 'paginationEmployee', clase.modalCargandoObject)
        } else {
          alert("no hay resultados");
        }
      }
    }).catch(function (error) {
      console.error(error);
    });
  }
  print() {
    document.getElementById("tbodyEmployee").innerHTML = '';
    let row = '';
    this.list.forEach(function (element) {
      row = '<tr>'
      row += '<td class="align-middle text-center">' + element.dni + '</td>';
      row += '<td>' + element.paternal + ' ' + element.maternal + ' ' + element.names + '<br>' + element.mobile + '</td>';
      row += '</tr>';
      document.getElementById("tbodyEmployee").innerHTML += row;
    });
  }

}

let crud = new EmployeeCRUD();
crud.read();