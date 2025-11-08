<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<!--VAMOS A TENER TAMBIEN UN PANEL DE BUSQUEDA-->
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    type="date"
                    id="fecha"
                    name="fecha"
                    value="<?php echo $fecha; ?>"

                /><!--type de tipo fecha porque vamos a poder buscar citas por fecha, ba poder seleccionar el calendario y ver que cita tiene en el futuro y cuales tubo ene l pasado--> <!--NOTA EL VALUE DE LA FECHA TIENE QUE VER CON EL ADMIN CONTROLLER DONDE ESTAMOS ESCRIBIENDO LA FECHA DE HOY DEL SERVIDOR Y LA PASAMOS ALA VISTA AQUI EN EL HTML-->
        </div>
    </form>
</div>



<!--AQUI ES PARA MOSTRAR UN MENSAJE QUE NO HAY CITAS EN EL CALENDARIO DEL ADMINISTRADOR CUANDO ESTEMOS BUSCANDO UNA CITA EN EL CALENDARIO-->
<?php
    if(count($citas) === 0){//entonces ejecutamos este codigo 
        echo "<h2> NO HAY CITAS EN ESTA FECHA </h2>";
    }
?><!--LA FUNCION COUNT nos va contar un arreglo-->





<!--AQUI SE VAN A IR MOSTRANDO LAS CITAS-->
<div id="citas-admin">
    <ul class="citas">
        <?php
            //PARA QUE NO ME MARQUE UNDEFINED LA PRIMERA VEZ QUE ITERE POR EL PRIMER ID PONEMOS:
            $idCita = 0;
            foreach($citas as $key => $cita){//con el key o la llave vamos a registrar el indice, el key es la pocicion o el n umero que tiene el registro del arrelo el id es lo que biene de la base de datos
                //debuguear($key);
                if($idCita !== $cita->id){//vamos a comprobar si el idCita es !== diferente a $cita->id citaid, entonces si ejecuta este codigo, es decir va iterar sobre el primer id pero si luego itera por el siguiente id y mira que es el mismo, pues ya no lo va mostrar porqu eso es lo que queremos que las citas no se muestren con id duplicado en la base de datos
                    $total = 0;//aqui voy a iniciar en cero para ir sumando el valor de cada servicio en lps, porque recordemos todo este codigo todo este if hasta h3 servicios solo se ejecuta una vez cuando iniciamos a mostrar los datos de la cita, entonces aqui va iniciar en cero, no lo ponemos arriba porque el forEach ba ir reiniciabdo el cero en cada iteracion, peor lo que tenemos en este if, nos permite o ba crear la variable total, que inicia en cero una sola vez hasta que cambia la siguiente cita
                    

    
        ?><!--iteramos por cada uno de ellos o cada una de las citas las que va ver el administrador con un foreach, puede ser con un while pero el forEach son especiales para los arreglos-->
            <li><!--cada una de las citas sera un li-->
                <p>ID: <span> <?php echo $cita->id; ?> </span></p><!--como es un objeto entonces ponemos sintaxis de flecha-->
                <p>Hora: <span> <?php echo $cita->hora; ?> </span></p><!--como es un objeto entonces ponemos sintaxis de flecha-->
                <p>Cliente: <span> <?php echo $cita->cliente; ?> </span></p><!--como es un objeto entonces ponemos sintaxis de flecha-->
                <p>Email: <span> <?php echo $cita->email; ?> </span></p><!--como es un objeto entonces ponemos sintaxis de flecha-->
                <p>Telefono: <span> <?php echo $cita->telefono; ?> </span></p><!--como es un objeto entonces ponemos sintaxis de flecha-->
                <p>Email: <span> <?php echo $cita->email; ?> </span></p><!--como es un objeto entonces ponemos sintaxis de flecha-->


                <h3>Servicios</h3>
        <?php 
            $idCita = $cita->id;    
                }//FIN DE IF 
                    $total += $cita->precio;//aqui tiene que ser fuera del if para ir sumando todos los elementos por cada cita es decir cuanto suma el servicio de cada cita 
                ?>    
                <p class="servicio"> <?php echo $cita->servicio . " " . $cita->precio; ?> </p>

        <?php
            //vamos a crear 2 variables uno va ser el registro actual ese va ser igual a cita id y el otro va ser el proximo elemento que va ser igual a citas que es el objeto que estamos iterando en un arreglo vamos sumando siempre una posicion adelante y va ser igual al id
            $actual = $cita->id;//actual va retornar el id actual en el cual nos encontramos, es decir 27, 28, 29 etc
            $proximo = $citas[$key + 1]->id ?? 0;//mientras que proximo es el indice en el arreglo de la base de datos va empezar contando de 0 uno dos tres cuatro etc, de este modo ba identificar cual es el ultimo registro cual es la ultima cita cual es el ultimo id para entonces detectar que es el ultimo,
            

            //recordemos que cuando estemos en el ultimo indice del arreglo va marcar undefined porque como esta en el ultimo ya no habras mas indices o id que marcar entonces sera igual a cero
            //esta funcion es ultimo esta en el archivo includes funciones.php
            if(esUltimo($actual, $proximo)){ ?>
                <p class="total">Total: <span> <?php echo $total; ?> </span> </p>

                
                <!--AQUI ES PARA ELINAR LAS CITAS EL ADMINISTRADOR PUEDE HACERLO-->
                <form action="/api/eliminar" method="POST"><!--PODEMOS VER  que es un form enviando la peticion a eliminar-->
                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>"><!--aqui vamos a mostrar el id de la cita en un campo oculto-->

                    <input type="submit" class="boton-eliminar" value="Eliminar cita">
                </form>
        <?php } ?>

        <?php } //FINAL DE FOREACH ?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>"
?><!--este script es para buscar las citas por medio del calendarios en el area de administracion y vamos apuntar hacia buscador.js-->