<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>




<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?><!--RECORDAR QUE: el doble guion bajo hace referencia a este archivo actual osea crear-cuenta.php es decir nos va imprimir la ruta hasta crear cuenta pero nos tenemos que salir de la carpeta y entrar a templates le ponemos un punto para concatenar porque estas alertas las vamos a tner en todos los formularios que vamos a tener en este proyecto-->




<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="TU NOMBRE"
            value="<?php echo s($usuario->nombre); ?>"

        />
    </div>




    <div class="campo">
        <label for="apellido">Apellido</label>
        <input
            type="text"
            id="apellido"
            name="apellido"
            placeholder="TU APELLIDO"
            value="<?php echo s($usuario->apellido); ?>"
            
        />
    </div>




    <div class="campo">
        <label for="nombre">Telefono</label>
        <input
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="TU TELEFONO"
            value="<?php echo s($usuario->telefono); ?>"
            
        />
    </div>




     <div class="campo">
        <label for="nombre">Email</label>
        <input
            type=""
            id="email"
            name="email"
            placeholder="TU E-mail"
            value="<?php echo s($usuario->email); ?>"


        />    
    </div><!--el value  recordar que es para que en el formulario recuerde lo que ya hemos puesto-->




     <div class="campo">
        <label for="nombre">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="TU PASSWORD"
            
        />
    </div>



    <input type="submit" value="Crear Cuenta" class="boton">
</form>



<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/olvide">¿Olvidaste tu Password?</a>
</div>