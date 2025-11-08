<?php
    foreach($alertas as $key => $mensajes)://este foreach es el arreglo principal de alertas accedemos a la llave principal que seria error y alerta es el que contiene los mensajes de errores con debuguear practicamente estamos iterando en todo el arreglo de errores del formulario crear usuario
        foreach($mensajes as $mensaje)://ahora vamos a iterar por cada uno de los mensajes de errores del formulario crear usuario
?>
    <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>     <!--este mensaje es lo que tenemos en el segundo foreach--> 

    </div><!--le agregamos una segunda clase y le ponemos key practicamente aqui estasmo sanitizando codigo-->    
<?php
        endforeach;    
    endforeach;   //ENTONCES DOBLE FOREACH PORQUE NUESTRO ARREGLO TIENE UNA LLAVE QUE TENEMOS QUE IDENTIFICAR Y LA LLAVE ES EL ERROR y despues accedemos a los mensajes 
?>












