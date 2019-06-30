/*class Settings {
	constructor() {
		this.api = 'http://timetables-app.herokuapp.com/back/api/';
		this.api = 'http://localhost/back/api/';
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
class TimeTableWeekly {
	constructor() {
		this.idtimetable_weekly = 0;
		this.description = '';
		this.date = '';
		this.estate = '';
		this.idmanager = 0;
	}
}
class TimeTableWork {
	constructor() {
		this.idtimetable_work = 0;
		this.day = 0;
		this.start_hour = 0;
		this.start_minute = 0;
		this.number_hours = 0;
		this.number_minutes = 0;
		this.idemployee = 0;
		this.idtimetable_weekly = 0;
	}
}
class Dia {
	constructor(id = 0, nombre = 'LUNES', abr = 'L') {
		this.id = id;
		this.nombre = nombre;
		this.abr = abr;
	}
}
listDia = [new Dia()];
listDia.push(new Dia(1, 'MARTES', 'M'));
listDia.push(new Dia(2, 'MIERCOLES', 'X'));
listDia.push(new Dia(3, 'JUEVES', 'J'));
listDia.push(new Dia(4, 'VIERNES', 'V'));
listDia.push(new Dia(5, 'SABADO', 'S'));
listDia.push(new Dia(6, 'DOMINGO ', 'D'));

function getDia(id) {
	let d = new Dia()
	listDia.forEach(dia => {
		if (dia.id == id) {
			d = dia;
		}
	});
	return d;
}
*/
window.onscroll = function () {
  var window_top = window.scrollY + 1;
  if (window_top > 60) {
    document.querySelectorAll('.main_menu').forEach(menu => {
      menu.classList.add('menu_fixed');
      menu.classList.add('animated');
      menu.classList.add('fadeInDown');
    })
  } else {
    document.querySelectorAll('.main_menu').forEach(menu => {
      menu.classList.remove('menu_fixed');
      menu.classList.remove('animated');
      menu.classList.remove('fadeInDown');
    })
  }
};