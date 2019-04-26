class Settings{
	constructor(){
		this.api='http://timetables-app.herokuapp.com/back/api/';
		//this.api='http://localhost/back/api/';
	}
}
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