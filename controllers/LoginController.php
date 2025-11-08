<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){//recordar que para que se mire esta vista tenemos que instanciar el router en el parentesis y  la variable router
        

        $alertas=[];//INICIAMOS ALERTAS SIEMPRE COMO ARREGLO VACIO PORQQUE ASI ESTA EN ACTIVE RECORD

        //para que se autollene el campo de email
        $auth=new Usuario;// y lo mandamos hacia la vista abajo en render


        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $auth=new Usuario($_POST);//vamos a instanciar el modelo o la clase de usuario y le vamos a pasar lo que el usuario escriba en post, recordar que auth solo tiene los datos del email y la password
        
            $alertas = $auth->validarLogin();//ENTONCES VAMOS A CREAR OTRO METODO O FUNCON DONDE VALIDARLOGIN SOLO VALIDA EMAIL Y CONTRASEñ ES DIFERENTE DE CREAR USUARIO
        
        
        

            if(empty($alertas)){//si las alertas estan vacias entonces quiere decir que hemos validado
                //COMPROBAR QUE EXISTA EL USUARIO O EMAIL
                $usuario=Usuario::where('email', $auth->email);//TOMA LA COLUMNA QUE VAMOS A COMPARAR EN ESTE CASO LA DE EMAIL Y EL VAOR QUE VAMOS A VERIFICAR EN ESTE CASO ES AUTH
                if($usuario){
                    //VERIFICAR EL PASSWORD
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){;//de esta forma ya le pasamos lo que el usuario escribio en el formulario
                        //ENTONCES SI TODO ESTA BIEN VAMOS A AUTENTICAR AL USUARIO
                        session_start();//ya con esto tenemos acceso a la super global de $_SESSION

                        $_SESSION['id']=$usuario->id;//recordar que usuario es la instancia que hemos credo aqui arriba en el where
                        $_SESSION['nombre']=$usuario->nombre . " " . $usuario->apellido;//y le concatenamos el apellido tambien
                        $_SESSION['email']=$usuario->email;
                        $_SESSION['login']=true;//podemos ir llenando la sesion con los datos que nosotros querramos


                        //REDIRECCIONAMIENTO
                        if($usuario->admin==="1"){//si el resultado es 1 es administrador
                            $_SESSION['admin'] = $usuario->admin ?? null;//usuario es igual a admin o null para que no nos marque ningun error

                            header('location: /admin');
                        }else{
                            header('location: /cita');//al cliente lo vamos a enviar a que haga su cita
                        }
                        
                        //debuguear($_SESSION);
                    }    
                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        
        }//Y PUES YA DEPENDIENDO de los resultados que vallamos teniendo cuando enviemos estos datos al post se va ir llenando el arreglo que esta vacio arriba
        
        
        $alertas=Usuario::getAlertas();//este es para la alerta e indicar que el usuario no existe
        
        
        //RECORDAR QUE EL METODO PARA PASAR LAS VISTA SE LLAMA render y un arreglo vacio de datos
        $router->render('auth/login',[
            'alertas' => $alertas,//le ponemos aelrtas y pasamos la variable de ariba de alertas hacia la vista
            'auth' => $auth//PARA PRERRELLENAR EL EMAIL DE LOGIN
        ]);//le ponemos router porque arriba ya tenemos una instancia de router y el metodo se llama render y en el parentesis toma una vista y la forma de un arreglo y la carpeta auth y el archivo login.php
    }



    public static function logout(){
        session_start();//iniciamos la secion

        $_SESSION = [];//ESTO LIMPIA TODO EL CODIGO Y NOS HACE UN ARREGLO VACIO

        header('location: /');//ENTONCES MANDAMOS AL USUARIO HACIA la pagina principal
    }



    //ESTA FUNCION ES PARA SI SE ME OLVIDO LA PASSWORD ENTONCES HACEMOS QUE 
     public static function olvide(Router $router){

        $alertas=[];


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth= new Usuario($_POST);//vamos a instanciarlo con la informacion de post
            $alertas= $auth->validarEmail();//vamos a tener validacion y esto va retornar alguna alertas

            //debuguear($auth);

            if(empty($alertas)){//revisar que si nos dio un email com empy
                $usuario=Usuario::where('email', $auth->email);//revisar en nuestra base de datos si el usuario o email existe verdad, vamos a buscar por email y el valor que vamos a buscar es aut por emial
            
                //aparte de que vamos a buscar en la base de datos vamos a ver que ese usuario  O EMAIL ESTE CONFIRMADO
                if($usuario && $usuario->confirmado === "1" ){
                    //GENERAR UN TOKEN PARA QUE CUANDO QUERRAMOS RECUPERAR LA CONTRASEñSE HACE CON UN NUEVO TOKEN
                    $usuario->crearToken();
                    $usuario->guardar();//aqui estamos insertando un nuevo token en la base de datos practicamente es un update
                    




                    //ENVIAR UN EMAIL CON EL TOKEN PARA QUE EL USUARIO PUEDA RESETEAR SU PASSWORD
                    $email=new Email($usuario->email, $usuario->nombre, $usuario->token);//entonces aqui instanciamos y abajo vamos a enviar las instrucciones
                    $email->enviarIntrucciones();




                    //TODO: ENVIAR EL EMAIL
                    //alerta de exito
                    Usuario::setAlerta('exito','REVISA TU EMAIL');
                    //debuguear('si existe el usuario y tambien esta confirmado');

                }else{
                    Usuario::setAlerta('error', 'no existe el usuario o correo y tampoco esta confirmado');
                    
                }
            }    
        }


        $alertas=Usuario::getAlertas();//set para escribir alertas y get para obtenerlas LO PONEMOS ANTES DE RENDERIZAR LAS VSITAS PARA QUE SE PUEDA ESCRIBIR LAS ALERTAS

        $router->render('auth/olvide-password',[
            'alertas' => $alertas//como arreglo asociativo
        ]);
    }




    //AQUI ES PARA RECUPERAR CONTRASEñA
     public static function recuperar(Router $router){

        //VAMOS A LEER EL TOKEN DE LA PARTE SUPERIOR DEL LINK PARA RECUPERAR CONTRASEñA Y PONER UNA NUEVA
        $alertas=[];
        $error=false;//esto es para que no me aparezca el formulario al momento de recibir el token


        //DE NUEVO VAMOS A LEER EL TOKEN DESDE GET QUE GET LEER LA URL PRACTICAMENTE
        $token= s($_GET['token']);//lo sanitizamos con la funcion s
        
        //AHORA VAMOS A BUSCAR EL USUARIO POR SU TOKEN
        $usuario=Usuario::where('token',$token);
        
        if(empty($usuario)){//si esta vacio el arreglo si me marca null entonces
            Usuario::setAlerta('error','token no valido');
            $error=true;//en caso de que el error de arriba este vacio cambia a true
        }



        //RECUPERAR CON POST PRACTICAMENTE LEER EL NUEVO PASSWORD
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //leer el nuevo password y guardarlo
            $password=new Usuario($_POST);
            $alertas=$password->validarPassword();

            if(empty($alertas)){
                $usuario->password=null;//le ponemos un null a password para que me lo quite el anterior a la bvase de datos
                $usuario->password=$password->password;//aqui ponemos ya el nuevo password con el password de arriba donde dice leer el nuevo password y guardarlo le ponemos password y se lo asignamos en el campo de password nuevamente
                $usuario->hashPassword();//aqui volvemos a hashear el password nuevo del usuario en el ultimo password el que no tiene signo de dolar
                $usuario->token=null;

                $resultado=$usuario->guardar();
                if($resultado){
                    header('location: /');
                }
                
                
                //debuguear($usuario);
            }

            //debuguear($password);
        }

        
        //debuguear($usuario);


        $alertas=Usuario::getAlertas();
        $router->render('<auth/recuperar-password',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }



    public static function crear(Router $router){

        //1. PRIMERO QUE HACEMOS ES INSTANCIAR USUARIO
        $usuario=new Usuario;// y le pasamos todos los datos que tengamos en post
        
        
        
        
        //ALERTAS VACIAS
        $alertas=[];
        
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);//vamos a sincronizar los datos con los datos que estaban vacios con los nuevos que estan llegando con la funcion sincronizar con los datos de POST
            $alertas=$usuario->validarNuevaCuenta();//mandamos a llamar del archivo usuario.php de la carpeta modelos, ahora este metodo nos va devolber las alertas entonces ponemos antes alertas
        
            


            
            
            
            
            //REVISAR QUE ALERTAS ESTE VACIO
            if(empty($alertas)){
                //VERIFICAR QUE EL USUARIO NO ESTE REGISTRADO LO VAMOS HACER POR MEDIO DE SU EMAIL
                $resultado=$usuario->existeUsuario();//la funcion existe usuario fue creada en el archivo Usuario.php de la carpeta model

                if($resultado->num_rows){//aqui decimos si en el resultado encontramos que el usuario ya existe en el correo si hay algo o un 1 es mandar llmar de nuevo mis alertas
                    $alertas=Usuario::getAlertas();//Usuario porque es una funcion statica dentro de ActiveRecord entonces tambien getalertas es otr funcion de active record
                }else{
                    //NO ESTA REGISTRADO
                    //HASHEAR EL PASSWORD
                    $usuario->hashPassword();//TENEMOS LA INSTANCIA DE USUARIO entonces ponemos hashPassword
                    
                    


                    //GENERAR UN TOKEN UNICO
                    $usuario->crearToken();//vamos a mandar llamar otra funcion en los modelos entoncos los controladores mandan a llmar al modelo




                    //ENVIAR EL EMAIL E INSTANCIAMOS EL EMAIL
                    $email=new Email($usuario->email, $usuario->nombre, $usuario->token);
                    
                    
                    //AQUI MANDAMOS A LLAMAR EL METODO DE EMAIL
                    $email->enviarConfirmacion();//este metodo o funcion esta creado en la carpeta de clases en el archivo email.php
                    


                    //CREAR EL USUARIO
                    $resultado=$usuario->guardar();
                    //debuguear($usuario);
                    if($resultado){
                        header('location:/mensaje');//cuando hayamos creado el usuario redireccionamos al usuario hacia la pagina principal, este mensaje es el que esta en el index de public
                    }


                }
            }
        }

        $router->render('auth/crear-cuenta',[
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }





    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }





    public static function confirmar(Router $router){
        $alertas=[];//recordar que las alertas en active record empizan con un arreglo vacio



        //LEER EL TOKEN CON GET Y SANITIZAMOS LA ENTRADA PORQUE SIMEPRE ALGUIEN QUERRA DEVOLBER O ESCRIBIR EN EL URL
        $token= s($_GET['token']);
        

        $usuario=Usuario::where('token', $token);// where recordar no requerimos instanciarlos porque en activeRecord estan como static function y le pasamos los 2 valores que tiene la funcion where el primer valor es el token y 
        //RECORDAR QUE ESTAMOS BUSCANDO POR EL TOKEN Y LE PASAMOS EL TOKEN DE ARRIBA QEU ES EL QUE ESTA EN LA URL
        if(empty($usuario)){//si el usuario esta vacio podemos ingresarle este mensaje de error
            //MOSTRAR MENSAJE DE ERROR
            Usuario::setAlerta('error', 'Token no Valido');//este setAlerta va tomar el tipo de alerta que es error, recordar en nuestras alertas solo tenemos 2 error y exito
        }else{//PERO SI NO ESTA VACIO ENTONCES VAMOS A MODIFICAR A USUARIO CONFIRMADO
            
            
            //MODIFICAR A USUARIO CONFIRMADO
            $usuario->confirmado = "1";//aqui estamos pasando el confirmado de la base de datos a un string de 1 con esto confirmamos que el usuario ya esta confirmado al ponerse en la base de datos el numero 1 en la columna confirmado
            $usuario->token=null;//ponemos el token null porque a estas alturas despues de confirmado ya no lo ocupamos y algguien podria reutilizar ese token
            $usuario->guardar();//esto va guardar al crear el usuario pero tenemos que decirle al usuario que esta pasando por lo tanto abajo con setAlerta
            Usuario::setAlerta('exito','Cuenta comprobada Correctamente');
        }



        //OBTENER ALERTAS ENTONCES ANTES DE RENDERIZAR LAS VISTAS
        $alertas=Usuario::getAlertas();//para que esas alertas que se estan guardando en memoria se pueda en el usuario setAlerta pueda leerlas con getAlertas antes de renderizar las vitas
        
        
        
        //RENDERIZAR LA VISTA
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas//estas alertas van a confirmar si el token es valido o no hay token y lo van a crear y lo van a eliminar
        ]);
    }
}