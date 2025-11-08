<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administrador de Servicios</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';

?>

<ul class="servicios">
    <?php foreach($servicios as $servicio) { ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span> </p>
            <p>Precio: <span>Lps <?php echo $servicio->precio; ?></span> </p>

            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a><!--obtenemos el id de query string ese php echo-->

                <form action="/servicios/eliminar" method="post">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>"><!--hidden es oculto va tener el name de id para poder leerlo en el post en el controlador y el id es lo que requerimos para poderlo eliminar-->

                    <input type="submit" value="Borrar" class="boton-eliminar">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>