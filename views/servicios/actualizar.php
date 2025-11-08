<h1 class="nombre-pagina">Actualziar Servicio</h1>
<p class="descripcion-pagina">Modifica los valores del Formulario</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';

?>





<form method="POST" class="formulario"><!--LE QUITAMOS EL ACTION Y AUTOMATICAMENTE NOS MNDA A LA URL DEL ROUTIN QUE ES /servicios/actualizar-->
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="boton" value="Actualizar Servicio">
</form>