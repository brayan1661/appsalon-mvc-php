<div class="barra"><!--MOSTRAR EL NOMBRE DEL CLIENTE CUANDO ESTEMOS EN EL BOTON DE ENVIAR CITA-->
    <div class="nombree">
        <p>Hola: <?php echo $nombre ?? ''; ?></p><!--hola, nombre es la variable que esta en el archivo CitaController.php linea 21-->
    </div>
    

    <!--ENLACE PARA CERRAR SECION-->
    <a class="boton" href="/logout">Cerrar Sesion</a>
</div>



<!--AQUI ES PARA CREAR EL MENU DE ADMINISTRADOR-->
<?php if(isset($_SESSION['admin'])){ ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver Citas</a>
        <a class="boton" href="/servicios">Ver Servicios</a>
        <a class="boton" href="/servicios/crear">Nuevo Servicio</a>
    </div>

<?php } ?>