class Crud {
  constructor() {
    this.action = 'paginate';
    this.typeRequest = 'POST'
    this.numberPage = '5';
    this.sizePage = '10';
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

var crudEmployee = new Crud();
let alertEmployee = new Alert('succes', 'modalAlert', 'El Colaborador se Registro con Exito!');
//alertEmployee.showAlert();
let empleado = new Employee();

document.addEventListener("DOMContentLoaded", function () {
  //TODO : ### SEARCH ###
  document.querySelector('#sizePageEmployee').onchange = function () {
    crudEmployee.sizePage = this.value;
    ajaxExec();
    return false;
  }
  document.querySelector('#slcGenderEmployeeSearch').onchange = function () {
    ajaxExec();
    return false;
  }
  document.querySelector('#FrmEmployee').onsubmit = function () {
    crudEmployee.action='paginate';
    ajaxExec();
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
    empleado.weekly_hours = document.querySelector('#txtWeekly_HoursEmployee').value==''?0:document.querySelector('#txtWeekly_HoursEmployee').value;
    empleado.dni = document.querySelector('#txtDniEmployee').value;
    ajaxExec();
    return false;
  };
  ajaxExec();
});


function ajaxExec() {
  let action = crudEmployee.action;
  let actionurl = '?action=' + action;
  let parameters = '';
  if(action=='paginate'){
    parameters += '&filter=' + document.querySelector('#txtFilterEmployeeSearch').value;
    parameters += '&gender=' + document.querySelector('#slcGenderEmployeeSearch').value;
    parameters += '&size=' + crudEmployee.sizePage;
    parameters += '&page=' + crudEmployee.numberPage;
  }
  fetch("http://localhost/back/api/employee" + actionurl + parameters, {
    method: crudEmployee.typeRequest, // or 'PUT'
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