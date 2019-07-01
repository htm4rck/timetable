class Settings {
	constructor() {
		this.api = 'http://timetables-app.herokuapp.com/back/api/';
		//this.api = 'http://localhost/back/api/';
	}
}
class Send {
	constructor() {
		this.action = 'read';
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
class Manager {
    constructor() {
        this.idmanager = 0;
        this.paternal = '';
        this.maternal = '';
        this.names = '';
        this.login = '';
        this.pass = '';
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
class TimeTableEmployee {
	constructor() {
		this.idtimetable_employee = 0;
		this.day = 0;
		this.start_hour = 0;
		this.start_minute = 0;
		this.number_hours = 0;
		this.number_minutes = 0;
		this.idemployee = 0;
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
class Hour {
	constructor(hour = 0, min = 0, maxH = 0, maxM = 0) {
		this.hour = hour;
		this.min = min;
		this.maxH = maxH; //MAXIMO DE HORAS
		this.maxM = maxM; //0:DISABLED;1:ENABLED
	}
}
class Hours {
	constructor(TimeTableEmployee) {
		this.tmtbE = TimeTableEmployee;
		this.arrayHours = [];
		this.setArrayHours();
	}
	setArrayHours() {
		let iterator = this.tmtbE.number_hours * 2;
		this.tmtbE.number_minutes == 0 ? iterator += 0 : iterator++;
		let hour = this.tmtbE.start_hour;
		let min = this.tmtbE.start_minute;
		let maxH = parseInt(this.tmtbE.number_hours);
		let maxM = this.tmtbE.number_minutes;
		for (let i = 0; i < iterator; i++) {
			this.arrayHours.push(new Hour(hour, min, maxH,maxM));
			min == 0 ? (min = 30) : (hour++, min = 0);
			maxM == 0 ? (maxM = 30, maxH--) : ( maxM = 0);
		}
	}
}
class UtilDate {
	constructor(date) {
		this.date = date;
		this.format = ''
	}
	getDate() {
		let array = this.date.split('-');
		for (let index = array.length - 1; index >= 0; index--) {
			index == 0 ? this.format += array[index] : this.format += array[index] + '/';
		}
		return this.format;
	}
	getDateGuion() {
		let array = this.date.split('/');
		return array[2] + '-' + array[1] + '-' + array[0];
	}
}

class UtilDateWeek {
	constructor(yyyy, m, d) {
		this.date = new Date(yyyy, m, d);
		this.dateStart = '';
		this.dateEnd = '';
		switch (this.date.getDay()) {
			case 0:
				this.date.setDate(this.date.getDate() - 6);
				this.dateStart = 'Lunes ' + this.date.toLocaleDateString();
				this.date.setDate(this.date.getDate() + 6);
				this.dateEnd = 'Domingo ' + this.date.toLocaleDateString();
				break;
			case 1:
				this.dateStart = 'Lunes ' + this.date.toLocaleDateString();
				this.date.setDate(this.date.getDate() + 6);
				this.dateEnd = 'Domingo ' + this.date.toLocaleDateString();
				break;
			case 2:
				this.date.setDate(this.date.getDate() - 1);
				this.dateStart = 'Lunes ' + this.date.toLocaleDateString();
				this.date.setDate(this.date.getDate() + 6);
				this.dateEnd = 'Domingo ' + this.date.toLocaleDateString();
				break;
			case 3:
				this.date.setDate(this.date.getDate() - 2);
				this.dateStart = 'Lunes ' + this.date.toLocaleDateString();
				this.date.setDate(this.date.getDate() + 6);
				this.dateEnd = 'Domingo ' + this.date.toLocaleDateString();
				break;
			case 4:
				this.date.setDate(this.date.getDate() - 3);
				this.dateStart = 'Lunes ' + this.date.toLocaleDateString();
				this.date.setDate(this.date.getDate() + 6);
				this.dateEnd = 'Domingo ' + this.date.toLocaleDateString();
				break;
			case 5:
				this.date.setDate(this.date.getDate() - 4);
				this.dateStart = 'Lunes ' + this.date.toLocaleDateString();
				this.date.setDate(this.date.getDate() + 6);
				this.dateEnd = 'Domingo ' + this.date.toLocaleDateString();
				break;
			case 6:
				this.date.setDate(this.date.getDate() - 5);
				this.dateStart = 'Lunes ' + this.date.toLocaleDateString();
				this.date.setDate(this.date.getDate() + 6);
				this.dateEnd = 'Domingo ' + this.date.toLocaleDateString();
				break;
		}
	}
	getWeek() {
		return 'Del ' + this.dateStart + ' al ' + this.dateEnd;
	}
}
if(document.querySelector('#sidenavToggler')!=null){
	document.querySelector('#sidenavToggler').addEventListener('click', function (e) {
		e.preventDefault();
		document.querySelector('body').classList.toggle('sidenav-toggled');
		document.querySelector('.navbar-sidenav .nav-link-collapse').classList.add('collapsed');
		document.querySelector(
			'.navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level'
		).classList.remove('show')
	});
}
