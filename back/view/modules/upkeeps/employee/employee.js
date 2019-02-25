document.addEventListener("DOMContentLoaded", function () {
  document.querySelector('#btnAbrirEmployee').addEventListener('click', function () {
    let modal = new Modal(document.querySelector('#modalman'))
    modal.show();
  });
  document.querySelector('#FrmEmployee').onsubmit = function () {
    //document.querySelector('#APIEmployee').value=("Employees/paginate");
    //document.querySelector('#typeRequestEmployee').value=("GET");
    //document.querySelector('#numberPageEmployee').value=("1");
    //document.querySelector('#modalCargandoEmployee').modal('show');
    ajaxExec();
    return false;
  };
  ajaxExec();
});

function ajaxExec() {
  let json = '';
  let action = document.querySelector('#actionEmployee').value
  let actionurl = '?action=' + action;
  let parameters = '';
  switch (action) {
    case 'paginate':
      parameters += '&filter=' + document.querySelector('#txtFilterEmployee').value;
      break;

    default:
      break;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "http://localhost/back/api/employee" + actionurl + parameters, true);
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(json));
  let jsonResponse;
  xhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {
      jsonResponse = JSON.parse(this.responseText)
      console.log(jsonResponse);
      console.log(parameters);
      list = jsonResponse.content;
      let row = '';
      switch (action) {
        case 'paginate':
          document.getElementById("tbodyEmployee").innerHTML = '';
          list.forEach(function (element) {
            row = '<tr>'
            row += '<td class="align-middle text-center">' + element.dni + '</td>';
            row += '<td>' + element.paternal + ' ' + element.maternal + ' ' + element.names + '<br>' + element.mobile + '</td>';
            row += '</tr>';
            document.getElementById("tbodyEmployee").innerHTML += row;
          });
          break;

        default:
          break;
      }

    }
  };
}