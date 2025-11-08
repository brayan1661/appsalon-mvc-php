<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>


<?php
    include_once __DIR__ . '/../templates/barra.php';
?>



<div id="app">
    <nav class="tabs"><!--TODO ESTOS SON TABS PARA PODER CREAR BOTONES EN LA PARTE SUPERIROR-->
        <button class="actual" type="button" data-paso="1">Servicios</button><!--con data paso 1 vamos a mapear los pasos de abajo ES DECIR ESTAMOS DIVIDIEDNO EL FORMULARIO EN 3 SECCIONES CUAND YO PRESIONE EL TAB 2 ME DARA LOS PASOS DEL 2 Y ASI SUSESIVAMENTE-->
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>


    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div><!--este se va quedAR VACIO ASI PORQUE CON JAVA SCRIPT VOY A consultar la base de datos en php la voy a exportar a json y la voy a insertar aqui los datos -->
    </div>










    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label><!--En un formulario HTML, el atributo id sirve para asignar un identificador único a un elemento, el cual se utiliza para manipularlo con CSS y JavaScript-->
                <input
                    id="nombre"
                    type="text"
                    placeholder="Tu Nombre"
                    value="<?php echo $nombre; ?>"
                    disabled
                /><!--con el value ya sabemos que es para llenar los formularios con el post-->
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    id="fecha"
                    type="date"
                    min="<?php echo date('Y-m-d', strtotime('+0 day') ); ?>"
                /><!--poner la fecha para el calendario de hacer citas,,,,,,,strtotime lo que hace es convertir un string a fecha-->
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input
                    id="hora"
                    type="time"
                />
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>" ><!--ete campo tiene que ver con el con id oculto en la seccion de servicios que lo creamos en nuestra Api en el archivo de app.js donde creamos el objeto de la cita,, los inputs de tipo hidden estan ocultos no se pueden ver-->

        </form>
    </div>












    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="paginacion">
        <button 
            id="anterior"
            class="boton"
        >&laquo; Anterior</button><!--esta entidad de &laquo es lo que hace generar esas flechas que estan en el boton siguiente y anterior-->

        <button 
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>
</div>



<?php
    $script="
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?><!--con esto mandamos a llamar todo lo relacionado con java script--> <!--el primer script es el de sweewtalert donde podemos ver y extraer el codigo de sweetalert y en la consola podemos poner swal para ver si se instalo-->