//creamos una variable que vamos a llamar let
let paso=1;//let es una palabra clave que se usa para declarar variables con alcance de bloque, lo que significa que solo son accesibles dentro del bloque (delimitado por {})
//let es una funcion global que se puede usar en bloque y se puede usar en diferentes funciones



//esto es para hacer un calculo con la funciones de boton anterior y siguiente para que le digamos desde donde empezar
const pasoInicial = 1;
const pasoFinal = 3;//solo tenemos 3 pasos por eso este es el calculo






//AHORA VAMOS IR CREANDO EL OBJETO DE LA CITA CUANDO EL CLIENTE ESTE ELIJIENDO QUE SERVICIO QUIERE HACERCE Y LO VAMOS A GUARDAR EN LA BASE DE DATOS
const cita = {//LE PONEMOS CONST PORQUE LOS OBJETOS EN JAVACRIPT PRACTICAMENTE SON COMO UN LET PUEDES REESCRIBIR EN ELLOS SIN NINGUN PROBLEMA
    //BA SER UN OBJETO QUE TENDRA MUCHA INFORMACION
    id: '',//este id sera un campo oculto en la seccion de servicios
    nombre: '',//tenemos un nombre que va ser un string vacio
    fecha: '',
    hora: '',
    servicios: []//este va ser un arreglo
}






//DESPUES VAMOS A INICIALIZAR MI PROYECTO document.addEventListener('DOMContentLoaded',)
document.addEventListener('DOMContentLoaded', function(){//DOMContentLoaded QUIERE DECIR Que cuando todo mi documento este cargado vamos a ejecutar la siguiente funcion
    iniciarApp();//vamos a llamar la funcion iniciarApp
});//entonces iniciamos asi el proyecto con ua funcion porque asi nosotros vamos iniciando las funciones que nosotros querramos





//CREAMOS LA FUNCION iniciarApp
function iniciarApp(){
    //vamos a mandar llamar la funcion mostrarSeccion para que inicie ejecutando el paso de servicios
    mostrarSeccion();//muestra y oculta las secciones



    //VAMOS A CREAR LA PRIMER FUNCION DE tabs
    tabs();//cambia la seccion cuando se presione los tabs de 1 2 y 3



    //VAMOS A CREAR O REGISTRAR UNA FUNCION PARA EL PAGINADOR
    botonesPaginador();//agrega o quita los botones del paginador





    //VAMOS A CREAR 2 FUNCIONES PARA QUE FUNCIONEN LOS BOTONES ANTERIOR Y SIGUIENTE EN LA PAGINA CITA
    paginaSiguiente();
    paginaAnterior();




    //AQUI ES PARA CONSULTAR EL API QUE VAMOS A CONSUMIR CON JSON
    consultarAPI();





    //AQUI ES CUANDO ESTEMOS SELECCIONADO EL ID OCULTO EL HIDDEN EN LA INFORMACION CITA
    idCliente();



    //AQUI ES PARA CUANDO ESTEMOS SELECCIONANDO LA FECHA DE LA CITA
    nombreCliente();//esto añade e nombre dl cliente al objeto de cita




    //AQUI ES PARA SELECCIONAR FECHA
    seleccionarFecha();//añade la fecha de la cita en el objeto





    //AQUI ES PARA SELECCIONAR HORA
    seleccionarHora();//añade la hora de la cita en el objeto




    //AQUI VAMOS A CREAR EL APARTADOD DE MOSTRAR RESUMEN
    mostrarResumen();//muestra el resumen de la cita
}



//CREAMOS OTRA FUNCION LLAMADA mostrarSeccion
function mostrarSeccion(){
    //OCULTAR LA SECCION AL QUE TENGA LA CLASE DE MOSTRAR
    const seccionAnterior = document.querySelector('.mostrar');//aqui el selector de mostrar lleva el punto porque esta en el queryselector
    //QUITA LA CLASE DE MOSTRAR AL TAB ANTERIOR
    if(seccionAnterior){//aqui decimos si al menos hay una seccion anterior que tenga la clase de mostrar entonces se la quitamos si no no hagas nada
        seccionAnterior.classList.remove('mostrar');//aqui ya se lo quitamos
    }
    





    //MOSTRAR LOS PASOS
    //SELECCIONAR LA SECCION CON EL PASO QUE ESCRIBIMOS EN CODIGO ES DECIR CON EL PRIMERO DE ARRIBA
    const pasoSelector = `#paso-${paso}`;//colocamos un template string, porque vamos a mezclar la variable que es let paso=1 y con algo de codigo selector de html que seria: el ID de los div que empiezan todos con paso-1 y los demas paso-2 entonces colocamos en el parentesis de esta forma ya traera el selector de html
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');





    //QUITA LA CLASE DE ACTUAL AL TAB ANTERIOR
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }




    //RESALTA EL TAB ACTUAL
    const tab = document.querySelector(`[data-paso="${paso}"]`);//DATA-PASO ES NUESTRO ATRIBUTO PERSONALIZADO EN EL HTML DE TODOS LOS PASOSS DE LAS SECCIONES SE PARESE AL DE PASOselectro al de arriba pero ya es nuestro atributo que le pusimo en el html de index de citas por eso en ves de parentesis se le ponen corchetes y despues para intectarle el paso si lo ponemos en parentesis
    tab.classList.add('actual');//tambien diferencia que el selector de html si lo tenemos en el archivo index de la carpeta cita y en la clase mostrar ese solo lo tenemos en el css por eso cambio un poco la sintaxis
}   




function tabs(){//ponemos tabs porque es la clase que pusimos en el html y css y en el query selector all podemos utilizar la etiqueta e button en el archivo index de la carpeta cita
    const botones=document.querySelectorAll('.tabs button');//En JavaScript, const se usa para declarar variables cuyo valor no se puede reasignar ni modificar después de su asignación inicial. Las variables const tienen un alcance de bloque, lo que significa que solo están disponibles dentro de las llaves {}


    //ENTONCES ESTOS BOTONES DE ARRIBA ES MUY SIMILAR A UN ARREGLO Y VAMOS ITERAR SOBRE CADA UNO DE ELLOS
    botones.forEach( boton =>{//esto es un arrow function vamos acceder a un solo boton aqui y en el parentesis lo nombramos como nosotros querramos
        boton.addEventListener('click', function(e){//e es el evento que se va registrar es decir a que le estamso dando click
            
            
            //AQUI ESTAMOS ASIGNANDO TODO AL PASO1
            paso = parseInt(e.target.dataset.paso);//este target.dataset lo obtenemos de mandar a la consola la funcion e, con parseint lo convertimos a un entero porque son string, ya cuando aparecen en color azul en la consola son enteros
        
        
            //Y CUANDO YA HALLAMOS ASIGNADO CUALQUIERA DE LOS PASOS VAMOS MANDAR LLAMAR UNA FUNCION QUE SE LLAMA mostrarSeccion
            mostrarSeccion();
        
        
            //mandamos a llamar los botones del paginador para que realisen la accion de ocultrase y aparecer
            botonesPaginador();




            
        });//y como aqui estoy accediendo a todos los 3 botones con el foreach se va ir ejecutando almenos una vez por cada elemnto que hay en este selectorAll
    })//NO LE PONEMOS HACER CLICK por AddEventListener porque este metodo no se puede usar cuando query selector all tiene all porque selecciona muchos
}// es un método de JavaScript que permite seleccionar el primer elemento HTML de una página web que coincida con un selector CSS válido. Y QUERY SELECTOR ALL VA RETORNAR TODAS LAS COINCIDENCIAS





function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');


        //MANDAMOS A LLAMAR MOSTRARESUEMEN PARA MOSTRAR LA INFORMACION EN EL PASO 3 QUE ES EL RESUEMN
        mostrarResumen();
    }else{
         paginaAnterior.classList.remove('ocultar');
         paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();//mandar llamar ahora mostrar seccion porque abajo estamos mandando a llamar la logica de la paginacion para que se muevan tanto los botones como las paginas
}




//ESTA FUNCION ES PARA LOS BOTONES DE ANTERIOR Y SIGUIENTE DE LA PAGINA CITA
function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');//vamos a seleccionar el selector de html el id de anterior que esta en el div de paginacion y seleccionamos el id anterior
    paginaAnterior.addEventListener('click', function(){//En JavaScript, addEventListener() es un método que adjunta una función de manejo de eventos a un elemento específico del documento (como un botón o un enlace), permitiendo que el navegador detecte y responda a eventos como clics o pulsaciones de teclas. Por ejemplo, puedes usarlo para que al hacer clic en un botón, se muestre un mensaje en la consola del navegador. 
        if(paso <= pasoInicial) return;
        //caso contrario si vele restando de 1 en 1
        paso--;//le ponemos menos menos para que valla yendo de uno en uno


        botonesPaginador();//mandamos a llamar la funcion de paginacion que se encarga de ocultar y mostrar toda la logica de la paginacion
    })

}





function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');//vamos a seleccionar el selector de html el id de anterior que esta en el div de paginacion y seleccionamos el id anterior
    paginaSiguiente.addEventListener('click', function(){//En JavaScript, addEventListener() es un método que adjunta una función de manejo de eventos a un elemento específico del documento (como un botón o un enlace), permitiendo que el navegador detecte y responda a eventos como clics o pulsaciones de teclas. Por ejemplo, puedes usarlo para que al hacer clic en un botón, se muestre un mensaje en la consola del navegador. 
        if(paso >= pasoFinal) return;
        //caso contrario si vele restando de 1 en 1
        paso++;//le ponemos menos menos para que valla yendo de uno en uno


        botonesPaginador();//mandamos a llamar la funcion de paginacion que se encarga de ocultar y mostrar toda la logica de la paginacion
    })

}







//CREAR FUNCION PARA LA API ES DECIR MANDAR Y ALMACENAR EN LA BASE DE DATOS CON JSON AQUI ESTAMOS CREANDO UNA APLICACION FULL STACK
async function consultarAPI(){//una funcion asincrona es cuando hay un monton de registros en la base de datos y no sabemos cuanto tiempo le va tomar llevar o mandar llamar esos datos entonces con async podemos asegurar que nuestra aplicacion tendra burn performance
    try {//este es un try cath
        //ENTONCES AQUI CONSULTAMOS NUESTRA BASE DE DATOS CONSULTAMOS NUESTRA API
        const url = '/api/servicios';//aqui ponemos la url que vamos a consumir en este caso es api/servicios que es donde vamos a mndar a llamar todos los servicios de la base de datos, recordar que si ponemos location .origin en la consola nos va traer el localhost y el numero de puerto
        
        //CON FETC LA CONSULTAMOS TAMBIEN NUESTRA API
        const resultado = await fetch(url);//el await solo se puede usar en una funcion asincrona, fetch es la fncion que nos va permitir consumir este servicio, y tambien el await espera que descarguemos todo porque no sabemos cuantos productos hay en la base de datos
        
        //OBTENEMOS LOS RESULTADOS COMO JSON
        const servicios = await resultado.json();//el json los sacamos del console.log(resultado) de Prototype
    
        //Y AQUI LO PASAMOS A OTRA FUNCION ABAJO PARA QUE NO QUEDE TAN GRANDE ESTA FUNCION
        mostrarServicios(servicios);
    
    } catch (error) {
        console.log(error);
    }
}




//MOSTRAR LOS SERVICIOS DE TODO LO QUE OFRECEMOS EN LA BARBERIA
function mostrarServicios(servicios){
    //ENTONCES LO PRIMERO QUE VAMOS HACER VA SER ITERAR SOBRE LOS SERVICIOS PORQUE ES UN ARREGLO
    servicios.forEach(servicio=>{
        const {id, nombre, precio} = servicio;

        //AQUI ESTAMOS HACIENDO UN SCRIPTING, los scripting para nosotros las personas que desarrollamoslas aplicaciones es dificil y ceunta pero en performace es mas seguro y ademas que es mas rapido
        const nombreServicio = document.createElement('P');//y creamos un parrafo con p
        nombreServicio.classList.add('nombre-servicio');//aqui en este nombreServicio le vamos a poner una clase y la clase sera nombreservicio asi le podemos dar estilos con sass
        nombreServicio.textContent = nombre;//todos estos 3 codigos es practicamente para crear codigo html en la consola donde se muestra el parrafp el nombre de la clase y despues el nombre del servicio
        //console.log(nombreServicio);


        //CREAMOS UN SEGUNDO PARA EL PRECIO
        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent =  `Lps. ${precio} `;




        //AHORA VAMOS A CREAR EL CONTENEDOR QUE CONTENGA, ES DECIR UN DIV QUE CONTENGA CADA UNO DE ESTOS SERVICIOS
        const servicioDiv = document.createElement('DIV');//importante que cuando estamos creando el scriptin todo sea en mayuscula asi como aqui con el div
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;//los atributos personalizados aqui en java se injertan  con dataset, el id es el que esta ariba lo estamos extrayendo de arriba
        //AQUI VAMOS AñADIR UN EVENTO CON onclick QUE TIENE QUE VER CON LA FUNCION CITA es decir con la funcion de arriba; cuando estemos clickeando en el servicio que querramos esta va ser una funcion que se va ejecutar cuando yo de click en ese div o en l servicio en la interfaz de usuario
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);//nombramos la funcion como seleccionar servicio y la ponemos abajo como funcion seleccionarServicio y con un calback ponemos la funcion seleccionarServicio y en el parentesis le asignamos el servicio
        } 


        //AHORA LOS VAMOS A MOSTRAR EN PANTALLA en el concole log
        servicioDiv.appendChild(nombreServicio);//y aqui ya tenemos un div que tiene un parrafo
        servicioDiv.appendChild(precioServicio);//y aqui ya tenemos un div que tiene un precio
        //console.log(servicioDiv);



        //EN EL ARCHIVO DE index.php en la carpeta cita en views tenemos en el paso 1 un div con el id de servicios y si miras vien el archivo html ese div esta vacio es ahi donde vamos a inyectar nuestro codigo de java script
        document.querySelector('#servicios').appendChild(servicioDiv);//y le agregamos servicio div que ya tiene los otros dos parrafos
    });
} 




function seleccionarServicio(servicio){//esta funcion tiene que ver con la de arriba con el calback de oneclick y seleccionarservicio
    //AHORA AQUI VAMOS IR REESCRIBIENDO ESTE OBJETO EN EL ARREGLO VACIO DE SERVICIOS EN LA VARIABLE CREADA CITA EN LA PARTE DE ARRIBA
    const {id} = servicio;//vamos a extraer tambien el id
    const {servicios} = cita;//aqui estamos extrayendo los servicios del objeto o arreglo de citas en la parte de arriba y lo extraemos porque vamos a estar escribiendo sobre el
    
    //IDENTIFICAR EL ELEMNTO AL QUE SE LE DA CLICK
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);//ponemos template string porque este es un atributo personalizado por nosotros recordemos
    
    //STE IF COMPROBARA SI UN SERVICIO YA FUE AGREGADO O QUITARLO entonces vamos a iterar sobre servicios
    if(servicios.some( agregado => agregado.id === servicio.id)){//LA COMPROBACION LA VAMOS HACER POR MEDIO DE UN ARRAY METHOD,//recordemos la variable servicio es la que yo estoy seleccionando cuando quiero un servicio, servicios en plural es es el objeto de citas con el arreglo vacio de servicio que tiene la informacion de la cita, le ponemos servicio agregado asi decidimos ponerle y le ponemos un arrow function, ENTONCES: agregado.id es lo que esta en memoria id es lo que yo estoy dando click en la interfaz de usuario de los servicios
        //YA ESTA AGREGADO LO VAMOS A ELIMINAR
        cita.servicios = servicios.filter( agregado => agregado.id !== id )//el signo: !== quiere decir que es diferente//filter es otro some que nos permite sacar un elemnto basado en ciertas condiciones
        divServicio.classList.remove('seleccionado');//le aÑadimos la clase de seleccionado
    }else{//un array method muy sencillo es .some este va verificar va iterar sobre todo el arreglo y va retornar true o false en caso de que un elemnto ya exista en el arreglo
        //Articulo Nuevo, no estaba agregado ENTONCES LO VAMOS AGREGAR
        cita.servicios = [...servicios, servicio];//creamos un arreglo y con los 3 puntos toma una copia de los servicios y tambien le agregamos el nuevo servicio
        divServicio.classList.add('seleccionado');//le aÑadimos la clase de seleccionado
    }//entonces ese .some es muy importante para revisar  si en un arreglo    ya esta un elemento
    
    
    
    
    
    
    
    
    console.log(cita);

}




//ESTA FUNCION TIENE QUE VER CON INICIAR AOO CON idCliente
function idCliente(){
    cita.id = document.querySelector('#id').value;
}




//ESTA FUNCION TIENE QUE VER CON LA DE ARRIBA DONDE ESTA INICIARAPP
function nombreCliente(){//
    //ahora le vamos asignar al arreglo de arriba el nombre 
    cita.nombre = document.querySelector('#nombre').value;//podemos acceder al objeto de cita aqui porque la hemos dejado global, entonces accedemos al nombre del index.php de la carpeta cita y mnadamos a llamar el nombre En un formulario HTML, el atributo id sirve para asignar un identificador único a un elemento, el cual se utiliza para manipularlo con CSS y JavaScript y accedemos a ese valor con value l que para html es un atributo para javaScript es un objeto asi podemos acceder a esa informacion con un punto

}






//ESTA FUNCION TIENE QUE VER CON LA DE ARRIBA DONDE ESTA INICIAR APP
function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');//tenemos el id de fecha
    inputFecha.addEventListener('input', function(e){
        //new Date().getUTCDay(); es el codigo en la consola de java script para ver en que dia estamos
        //INSTANCIAMOS EL OBJETO DE FECHA Y LE PASAMOS LA FECHA QUE EL USUARIO SELECCIONO 
        const dia = new Date(e.target.value).getUTCDay();//aqui le poenmos la fecha que el usuario eligio que sera e.target.value y utilizamos el metodo .getUTCDay

        //ENTONCES HACEMOS UN IF Y TAMBIEN UN ARREGLO EN ESE INSTANTE SOLAMENTE COLOCANDO LOS CORCHETES
        if( [6, 0].includes(dia)){//recordar que cero es domingo y lo 6 son sabados, includes es un array method que nos permite comprobar si un valor existe
            e.target.value = '';//igual a un string vacio.    este codigo de aqui es para que si el cliente toca un sabado o un domingo no se ponga la fecha en el espacio de la aplicacion
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');//aqi madamos a llamar la funcion de alerta que esta abajo
        }else{
            cita.fecha = e.target.value;
        }




        //TODO ESTE CODIGO DE ABAJO ME SIRVE PARA VER EN LA CONSOLA
        //sconsole.log(e.target.value);//recordar que target es el elemnto que dispara este evento
        //cita.fecha = inputFecha.value;//aqui le estamso asigando la fecha ya
    });
    
}








function seleccionarHora(){
    const inputHora = document.querySelector('#hora');//y seleccionamos el id de hora en el html del archivo index carpeta cita
    inputHora.addEventListener('input', function(e){//y le agregamos un evenlistener y le agregamos un calback y tambien un evento
        
        const horaCita = e.target.value;
        const hora= horaCita.split(":")[0];//split nos va permitir separar una cadena de texto mi separador seran 2 puntos y con cero podemos leer la hora
        if(hora < 10 || hora > 18){
            e.target.value = '';//esto es para que no alamcene la hora incorrecta
            mostrarAlerta('Hora no valida', 'error', '.formulario');
        }else{
            cita.hora = e.target.value;//cita .hora es el objeto que tenemos arriba el que instanciamos vacio e.target ya lo va guardar correctamente

            //console.log(cita);
        }
    })
}










function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){//va tomar un mensaje y tambien un tipo de alerta , ponemos un tercer parametro y le decimos que va ser eleemnto para las alertas

    //PREVENIR QUE SE CREEN MAS ALERTAS SI YA HAY UNA DISPONIBLE
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia){//entonces aqui si ya hay alerta previa pues ejecutamos aqui un if con un return PARA QUE YA NO AñADA MAS DE UNA ALERTA
        alertaPrevia.remove();//YA CON EL IF Y CON ESTE REMOVE PODEMOS DECIR QUE paar evita rque se generen mas podemos remober una y asi añadir otra mas
    }    

    //scripting o script para crear la alerta
    const alerta = document.createElement('DIV');//CREAMOS UN DIV
    alerta.textContent = mensaje;//y va tomar el mensaje que le vamos a pasar desde arriba en mostrarAlerta
    alerta.classList.add('alerta');//le agregamos tambien las clases de scss
    alerta.classList.add(tipo);//y le ponemos el tipo de alerta

    const referencia = document.querySelector(elemento);//ahora para mostrarlo en pantalla seleccionamos el formulario porque en este proyecto solo abra un solo formulario entonces lo hacemos, ponemos elemento en el parentesis porque pusimos  un tercer parametro en mostrar alerta que se llama elemento
    referencia.appendChild(alerta);//y ponemos formulario appenChild para mostrar esta alerta   NOTA: LO CAMBIAMOS A REFERENCIA PORQUE YA NO ES EL FORMULARIO NADA MAS



    if(desaparece){
        //ELIMINAR LA ALERTA
        //AHORA QUIERO QUE ESE ERROR DESAPAREZCA DESPUS DE UN CIERTO TIEMPO
        setTimeout(() => {
            alerta.remove();
        }, 3000);//tres segundos hacer la accion de arriba osea que se quite la alerta
    }
    
}





function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');//seleccionamos del index de la carpeta cita la clae resumen


    //LIMPIAR EL CONTENIDO DE RESUMEN, ES DECIR QUE LA ALERTA EN LA SECCION DE RESUEMN SE LIMPIE CUANDO YA EJECUTAMOS EL CODIGO DE SELECCIONAR SERVICIO Y SELCIONAR FECHA Y HORA
    while(resumen.firstChild){//lo limpiamos con while y seleccionamos el div que es contenido-resuemen
        resumen.removeChild(resumen.firstChild);
    }    

    //cuando queremos validd un objeto usamos object values pero si queremos verificar si un arreglo esta vacio podemos usar ,lenght
    //validemos la cita con console .log
    if(Object.values(cita).includes('') || cita.servicios.length === 0){//entonces iteramos sobre el objeto de cita con object.values y verificamos si incluye un string vacio, con object vamos a poder acceder a los valores de un objeto y no es necesario acceder a cada unos de ellos y despues un include para verificar que condicion es la que queremos ejecutar, ponemos el cero porque significa que no hemos seleccionado nada!
        mostrarAlerta('faltan datos de servicios, fecha u hora', 'error', '.contenido-resumen', false)//objet es para directamente objetos podemos ver cuantas cosas hay con string vacios, primero el mensaje de error, luego el lugar en el html donde lo vamos a insetar que es en ,contenido-resuemen. LE PONEMOS FALSE PORQUE AQUI NO QUIERO QUE DESAPAREZCA LA ALERTA ES DECIR EN EL RESUEMN EN LO DEMAS SI
    
        return;
    }

    //FORMATEAR EL DIV DE RESUMEN    AQUI VAMOS A CREAR TODO LO DE RESUMEN Y CREAMOS TODO NUESTRO SCRIPTING
    const{nombre, fecha, hora, servicios} = cita;//vamos a extraer toda la informacion de cita del arreglo vacio de arriba, A ESTAS alturas ya todos tienen informacion es un buen lugar para aplicar disctroctorin

    



    //HEADING PARA SERVICIOS EN RESUEMN
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingServicios);//y lo agregamos en el resuemn



    //LOS SERVICIOS SON UN ARREGLO POR LO TANTO TOCA ITERAR SOBRE ELLOS
    servicios.forEach(servicio => {//no le ponemos servicios .lengt porque aqui arriba ya lo estoy validando en el if del objeto.values y vamos acceder a cada servicio y abrimos llaves
        //APLICAMOS DISTROCTORING:   entonces como servicio el color anaranjado ya tenemos una instancia y ya tenemos valores y si nos fijamos en la consola servicio es un arreglo entonces aplicamos distroctoring
        const {id, precio, nombre} = servicio;//La desestructuración (destructuring) en JavaScript es una característica de ES6 que permite desempaquetar valores de arrays u objetos en un conjunto de variables individuales, haciendo el código más conciso y legible
        
        const contenedorServicio = document.createElement('DIV');//lo que vamos hacer es que cada servicio lo vamos a colocar en un div
        contenedorServicio.classList.add('contenedor-servicio');//LE AGREGAMOS UNA CLASE PARA DARLE ESTILOS

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;//si no aplicaramos distroction seria servicio.nombre

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> L${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);


        //AQUI LO AGREGAMOS EN LA SECCION DE RESUMEN
        resumen.appendChild(contenedorServicio);//lo agregamos contenedor servicio que contiene todas las variables
    })




    //HEADING PARA cita EN RESUEMN
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);//y lo agregamos en el resuemn






    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre</span> ${nombre}`;


    //FORMATEAR LA FECHA EN ESPAÑOL
    const fechaObj = new Date(fecha);// y le pasamos la fecha que selecciono el usuario
    const mes= fechaObj.getMonth();//y el mes lo vamos a obtenr getMonth
    const dia = fechaObj.getDate() +2;//getday te retorna el dia de la semana en javascript el dia 1 es lunes,   ponemos +2 porque hay un desfase con new Date
    const year = fechaObj.getFullYear();


    const fechaUTC = new Date(Date.UTC(year, mes, dia));//utc imprime la fecha por separado y todo esto lo utilizamos para instanciar la nueva fecha
    
    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day:'numeric'}//weekday es el dia de la semana
    const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);//este es un codigo de idioma de mexico los podemos poner en wikipedia para buscar codigos de idioma
    //console.log(fechaFormateada);


    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora</span> ${hora} Horas`;




    //BOTON PARA CREAR UNA CITA Y ENVIARLA AL SERVIDOR
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    //Y CUANDO DEMMOS CLICK EN EL BOTON VAMOS A EJECUTAR UNA FUNCION
    botonReservar.onclick = reservarCita;//la funcion se llama reservar cita




    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    //ESTO ES DEL BOTON
    resumen.appendChild(botonReservar);//para que aparezca en pantalla
}




async function reservarCita(){




    const {nombre, fecha, hora, servicios, id} = cita;//vamos a extraer del objeto de cita, vamos aplicar distroctoring a los servicios


    //AQUI VAMOS A COLOCAR EL ID A LA TABLA CITASSERVICIOS
    const idServicios = servicios.map( servicio => servicio.id)//la diferencia entre foreach y map esque foreach va iternado por cada una y map las coincidencias las va ir colocando en la variable de idServicios y solo nos interesa el id del servicio y ponemos servicio.id
    console.log(idServicios);


    const datos = new FormData();//form data es para enviar datos al servidor solamente creamos un formData y se envia al servidor ya la api se encarga de manejar los datos, este formdata ba actuar como el submit pero con javascript
    //FORMA EN LA QUE LE VAMOS AÑADIR DATOS A FORMdTA ES CON append
    datos.append('fecha', fecha);//aqui vamos a tener el valor de la variable del objeto de cita
    datos.append('hora', hora);//aqui vamos a tener el valor de la variable del objeto de cita
    datos.append('usuarioId', id);//aqui vamos a tener el valor de la variable del objeto de cita, el lado derecho es la variable y el izquierdo es: lo que esta pegdo al append
    datos.append('servicios', idServicios);//le colocamos idServicios para mandarla via post y el controlador de APIcontroller la va lerr porque tenemos el POST EN LA FUNCION guardar linea 20
    //console.log([...datos]);






    //PETICION HACIA LA API la forma de enviar la peticion es con fetch Api
    const url = '/api/citas'//LA DEJAMOS ASI PORQUE TENEMOS ALOJADO EL BACKEND Y ESTE ARCHIVO DE JAVA SCRIPT EN EL MISMO SERVIDOR

    const respuesta = await fetch(url, {
        method: 'POST',//bueno aqui decimos vamos a utilizar un metodo POST a esta url a la de api/citas y en el archivo de index public tenemos un endpoint registrado de api/citas que tambien soporta post y se va conectar con este constrolador de aqui ya definido
        body: datos//body es el cuerpo de la peticion que vamos a enviar y le pasamos la instancia de form Data que es la variable de datos, form datta es como el submit de javaScript
    
    });///utilizamos async await porque no sabemos en cuanto tiempo nos va retornar la respuestas, await se utiliza en funcions asincronas   NOTA: CUANDO ENVIAMOS UNA PETICION DE TIPO POST EL SEGUNDO PARAMETRO es obligatorio en el fetch y creamos un objeto y le ponemos post, 




    const resultado = await respuesta.json();
    console.log(resultado.resultado);//el segundo resultado es lo que construimos en active record cuando retornamos un resultado en la linea 161
    
    //PONEMOS ESTE TRY CATCH POR SI SE VA LA LUZ o se cahio el servidor O POR ALGUN MOTIVO NO SE PUDO GUARDAR LA CITA NUESTRO SERVIDOR QUEDA EN EL AIRE AL MOMENTO DE ENVIAR LA CITA
    try {
        if(resultado.resultado){
        Swal.fire({//swal.fire es para mandar a llmar el metodo es de la pagina sweetalert2
            icon: "success",
            title: "Cita Creada...",
            text: "Tu Cita fue Creada Correctamente!",
            button: 'OK'//LE AGREGAMOS ESTA FUNCION DE BUTTON
        }).then(() => {//ponemos un punto then y  un calback y le colocamos un window . location.reload para recargar la pagina
            setTimeout(() =>{

            }, 3000);
            window.location.reload();
        })
    }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error...",
            text: "HUBO UN ERROR AL GUARDAR LA CITA"
        });
    }



    //console.log([...datos]);//con 3 puntos y entre corchetes podemos acceder al arreglo de arriba es decir al form data para saber y comprobar lo que estamnos enviando
}