<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>




<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?><!--RECORDAR QUE: el doble guion bajo hace referencia a este archivo actual osea crear-cuenta.php es decir nos va imprimir la ruta hasta crear cuenta pero nos tenemos que salir de la carpeta y entrar a templates le ponemos un punto para concatenar porque estas alertas las vamos a tner en todos los formularios que vamos a tener en este proyecto-->




<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">EMAIL</label>
        <input
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
            value="<?php echo s($auth->email); ?>"
        /><!--RECORDAR QUE ESTE NAME DE EMAIL LO VAMOS A LERR CON POST DE ESTA MANERA: $_POST['email'];-->
    </div><!--Prerrellenamos el email de login con value-->





    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            placeholder="Tu Contraseña"
            name="password"
        /><!--recordar que el for en la etiqueta tiene que ver con el input de id tienen que decir lo mismo para poder conectarse con otras tecnologias-->
    </div>



    <input type="submit" class="boton" value="Iniciar Sesion">
</form>





<div class="acciones">
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
    <a href="/olvide">¿Olvidaste tu Password?</a>
</div>