let admin = new Manager();
sessionStorage.validate == 'true' ? SetManager() : window.location = '/back/login';
function SetManager(){
admin.idmanager=sessionStorage.idmanager;
admin.paternal=sessionStorage.paternal;
admin.maternal=sessionStorage.maternal;
admin.names=sessionStorage.names;
admin.login=sessionStorage.login;
document.querySelector('#nameManager').innerHTML='<i class="fas fa-user-tie mr-1"></i>Hola '+admin.paternal+' '+admin.maternal+' '+admin.names+'!';
}
document.querySelector('#btnSalir').onclick = function () {
    sessionStorage.clear();
    window.location = '/back/login';
}