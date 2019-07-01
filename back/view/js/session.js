let admin = new Manager();
sessionStorage.validate == 'true' ? SetManager() : window.location = '/back/login';

function SetManager() {
    admin.idmanager = sessionStorage.idmanager;
    admin.paternal = sessionStorage.paternal;
    admin.maternal = sessionStorage.maternal;
    admin.names = sessionStorage.names;
    admin.login = sessionStorage.login;
    document.querySelector('#nameManager').innerHTML = '<i class="fas fa-user-tie mr-1"></i>Hola ' + admin.paternal + ' ' + admin.maternal + ' ' + admin.names + '!';
}
document.querySelector('#btnSalir').onclick = function () {
    sessionStorage.clear();
    window.location = '/back/login';
}
class Menu {
    constructor(icon, url, title) {
        this.icon = icon;
        this.url = url;
        this.title = title;
    }
    getMenu() {
        let html = ''
        html += '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="' + this.title + '">';
        html += '<a class="nav-link" href="' + this.url + '">';
        html += this.icon;
        html += '<span class="nav-link-text">' + this.title + '</span>';
        html += '</a>';
        html += '</li>';
        return html;
    }
    getSubMenu(){
        let html='';
        html += '<li>';
        html += '<a href="'+this.url+'">'+this.icon+this.title+'</a>';
        html += '</li>';
        return html;
    }
}
let navMenu = document.querySelector('#exampleAccordion');
navMenu.innerHTML = '';
navMenu.innerHTML += new Menu('<i class="fas fa-home mr-1"></i>', '/back', 'Inicio').getMenu();
if (admin.idmanager == 0) {
    let a = ''
    a += '<li class="nav-item" data-toggle="tooltip" data-placement="right" data-original-title="Components">';
    a += '<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion" aria-expanded="false">';
    a += '<i class="fa fa-fw fa-wrench"></i>';
    a += '<span class="nav-link-text">Mantenimientos</span>';
    a += '</a>';
    a += '<ul class="sidenav-second-level collapse" id="collapseComponents" style="" aria-expanded="false">';
    a += new Menu('<i class="fas fa-users-cog mr-1"></i>', '/back/upkeeps/manager', 'Administradores').getSubMenu();
    a += new Menu('<i class="fas fa-user-tie mr-1"></i>', '/back/upkeeps/employee', 'Empleados').getSubMenu();
    a += new Menu('<i class="fas fa-user-clock mr-1"></i>', '/back/upkeeps/tmtbemployee', 'H. Empleados').getSubMenu();
    a += new Menu('<i class="far fa-calendar-minus mr-1"></i>', '/back/upkeeps/tmtbweekly', 'H. Semanal').getSubMenu();
    a += new Menu('<i class="fas fa-briefcase mr-1"></i>', '/back/upkeeps/tmtbwork', 'H. Trabajo').getSubMenu();
    a += '</ul>';
    a += '</li>';
    navMenu.innerHTML += a;
}

navMenu.innerHTML += new Menu('<i class="fas fa-user-tie mr-1"></i>', '/back/process/employee', 'Empleados').getMenu();
navMenu.innerHTML += new Menu('<i class="fas fa-calendar-week mr-1"></i>', '/back/process/tmtbvalid', 'H. Vigente').getMenu();
navMenu.innerHTML += new Menu('<i class="fas fa-calendar-alt mr-1"></i>', '/back/process/tmtbweekly', 'H. Semanales').getMenu();
navMenu.innerHTML += new Menu('<i class="fas fa-link mr-1"></i>', '/', 'Website').getMenu();
if(document.querySelector('.navbar-sidenav .nav-link-collapse')!=null){
	document.querySelector('.navbar-sidenav .nav-link-collapse').addEventListener('click', function (e) {
		e.preventDefault();
		document.querySelector('body').classList.remove('sidenav-toggled');
	});
}
