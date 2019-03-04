class Crud {
  constructor() {
    this.action = 'paginate';
    this.typeRequest = 'GET'
    this.numberPage = '1';
    this.sizePage = '10';
  }
}

var crudEmployee = new Crud();
let alertEmployee = new Alert('succes', 'modalAlert','El Colaborador se Registro con Exito!');
//alertEmployee.showAlert();

document.addEventListener("DOMContentLoaded", function () {
  
  document.querySelector('#sizePageEmployee').onchange = function () {
    crudEmployee.sizePage=this.value;
    ajaxExec();
    return false;
  }
  document.querySelector('#slcGenderEmployee').onchange = function () {
    ajaxExec();
    return false;
  }

  document.querySelector('#btnAbrirEmployee').addEventListener('click', function () {
    let modal = new Modal(document.querySelector('#modalman'))
    modal.show();
  });
  document.querySelector('#FrmEmployee').onsubmit = function () {
    ajaxExec();
    return false;
  };
  ajaxExec();
});


function ajaxExec() {
  let json = '';
  let action = crudEmployee.action;
  let actionurl = '?action=' + action;
  let parameters = '';
  switch (action) {
    case 'paginate':
      parameters += '&filter=' + document.querySelector('#txtFilterEmployee').value;
      parameters += '&gender=' + document.querySelector('#slcGenderEmployee').value;
      parameters += '&size=' + crudEmployee.sizePage;
      parameters += '&page=' + crudEmployee.numberPage;

      break;

    default:
      break;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.open(crudEmployee.typeRequest, "http://localhost/back/api/employee" + actionurl + parameters, true);
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(json));
  let jsonResponse;
  xhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {
      jsonResponse = JSON.parse(this.responseText)
      console.log(jsonResponse);
      console.log(parameters);
      if (jsonResponse.error == false) {
        if (jsonResponse.counter > 0) {
          toList(jsonResponse.content);
        } else {
          toList(jsonResponse.content);
          alert("no hay resultados");
        }
      } else {
        console.log(jsonResponse.message.errorInfo)
        //alert(jsonResponse.message.errorInfo+'<br>ada');
      }
    }
  };
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