document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});







function iniciarApp(){
    buscarPorFecha();
}

















function buscarPorFecha(){
    const fechaInput = document.querySelector('#fecha');//seleccionamos el id de fecha del archivo index de la carpeta admin
    fechaInput.addEventListener('input', function(e){//y vamos a escuchar por input este input es basicamente seleccionar una fecha en el calendario de administrador y le ponemos un calvack que se va ejecutar cada vez que suceda el evento
        const fechaSeleccionada = e.target.value;//e.trget.value para leer un valor el value nos selecciona la fecha

        //VAMOS A REDIRECCIONAR AL USUARIO POR GET
        window.location = `?fecha=${fechaSeleccionada}`;//ponemos un template string y le ponemos en el query string, de esta forma vamos a redireccionar al usuario, vamos a mandarlo por query string la fecha que el usuario a seleccionado
    });
}