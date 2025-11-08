<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>


    <div class="contenedor-app">
        <div class="imagen"></div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>


<?php
    echo $script ?? '';
?><!--aqui estamos diciendo imprime una variable de script pero si no lo tenemos imprime un strin vacio para que no tegamos errores de que esta variable no existe-->
<!--ENTONCES ESTE LAYOUT VA IMPRIMIR TODOS LOS SCRIPTS QUE PONGAMOS EN LAS PAGINAS QUE NOSOTROS QUERRAMOS-->
    
            
</body>
</html>