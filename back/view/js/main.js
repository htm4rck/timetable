class Settings {
	constructor() {
		this.api = 'http://timetables-app.herokuapp.com/back/api/';
		//this.api = 'http://localhost/back/api/';
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
listDia.push(new Dia(6, 'DOMINGO', 'D'));
document.querySelector('#sidenavToggler').addEventListener('click', function (e) {
	e.preventDefault();
	document.querySelector('body').classList.toggle('sidenav-toggled');
	document.querySelector('.navbar-sidenav .nav-link-collapse').classList.add('collapsed');
	document.querySelector(
		'.navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level'
	).classList.remove('show')
});
document.querySelector('.navbar-sidenav .nav-link-collapse').addEventListener('click', function (e) {
	e.preventDefault();
	document.querySelector('body').classList.remove('sidenav-toggled');
});