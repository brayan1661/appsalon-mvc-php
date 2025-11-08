<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">coloca tu nuevo password a continuacion</p>



<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>



<?php if($error) return; ?>
<form class="formulario" method="POST"><!--no le dejamos el action porque si no me va eliminar el token de la parte superior-->
    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Tu Nuevo Password"
        /><!--recordar que el name es lo que vamos a leer con el post-->
    </div>
    <input type="submit" class="boton" value="Guardar Nuevo Password">

</form>





<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Obtener una</a>
</div>