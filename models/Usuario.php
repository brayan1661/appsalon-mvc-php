<?php




namespace Model;

class Usuario extends ActiveRecord{//estamos heredando de active record
    //BASES DE DATOS
    protected static $tabla='usuarios';//y le vamos a decir que en la tabla de usuarios es donde vamos a encontrar los datos
    protected static $columnasDB=['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];//le vamos a decir que se van ir insertando en cada una de las columnas de la base de datos tiene que ser las mismas columnas que estan en la base de datos



    //AHORA TENEMOS QUE CREAR LOS ATRIBUTOS POR CADA UNA DE LAS CLUMNAS ANTERIORES
    public $id;//y van a iniciar vacios
    public $nombre;//y van a iniciar vacios
    public $apellido;//y van a iniciar vacios
    public $email;//y van a iniciar vacios
    public $password;//y van a iniciar vacios
    public $telefono;//y van a iniciar vacios
    public $admin;//y van a iniciar vacios
    public $confirmado;//y van a iniciar vacios
    public $token;//y van a iniciar vacio




    
    
    //FINALMENTE DEFINIMOS NUESTRO CONSTRUCTOR
    public function __construct($args=[]){//va tomar alguno argumntos pero por default va ser un arreglo vacio
        $this->id=$args['id'] ?? null;//este de args va ser un arreglo asociativo entonces tendra un campo id y en caso de que no este presente lo ponemos como null
        $this->nombre=$args['nombre'] ?? '';//este de args va ser un arreglo asociativo entonces tendra un campo id y en caso de que no este presente sera un strin vacio
        $this->apellido=$args['apellido'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->password=$args['password'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->admin=$args['admin'] ?? 0;//admin en caso de que no este presente su valor sera cero
        $this->confirmado=$args['confirmado'] ?? 0;//confirmado tambien sera cero en caso de no estar presente
        $this->token=$args['token'] ?? '';
    }//aqui vamos ir agregando los argumentos con los atributos de arriba de nuetras clase Usuario











    //MENSAJES DE VALIDACION DE ERRORES PARA LA CREACION DE UNA CUENTA
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='El Nombre del cliente es Obligatorio';//recordar ahora ya no se llama errores los mensajes de errores se llaman alertas en ActiveRecord, le colocamos como arreglo error y le ponemos al final otros corchetes y mensaje final
        }


        if(!$this->apellido){
            self::$alertas['error'][]='El Apellido del cliente es Obligatorio';//recordar ahora ya no se llama errores los mensajes de errores se llaman alertas en ActiveRecord, le colocamos como arreglo error y le ponemos al final otros corchetes y mensaje final
        }


        if(!$this->email){
            self::$alertas['error'][]='El email del cliente es Obligatorio';//recordar ahora ya no se llama errores los mensajes de errores se llaman alertas en ActiveRecord, le colocamos como arreglo error y le ponemos al final otros corchetes y mensaje final
        }


        if(!$this->password){
            self::$alertas['error'][]='El password del cliente es Obligatorio';//recordar ahora ya no se llama errores los mensajes de errores se llaman alertas en ActiveRecord, le colocamos como arreglo error y le ponemos al final otros corchetes y mensaje final
        }


        if(strlen($this->password) < 6){//strlen nos va retornar el tamaÑo de un string para eso sirve la funcion
            self::$alertas['error'][]='El password debe contener almenos 6 caracteres';
        }

        
        
        
        return self::$alertas;//validarNuevaCuenta va retornar las alertas aqui
    }





    //VALIDAR LOGIN ES DECIR CUANDO ESTAM OS INGRESANDO CUANDO YA CREAMOS EL USUARIO
    public function validarLogin(){
        if(!$this->email){//es decir si no hay un email
            self::$alertas['error'][] = 'EL email es obligatorio';//en nuetras alertas sera de error
        }


        if(!$this->password){//es decir si no hay un email
            self::$alertas['error'][] = 'EL password es obligatorio';//en nuetras alertas sera de error
        }


        return self::$alertas;//y retornamos las alertas para usarlas en el controlador o en donde nosotros querramos para eso es el return en este caso LoginController
    }






    //VALIDAR EMAIL EN EOLVIDE MI PASSWORD
    public function validarEmail(){
        if(!$this->email){//es decir si no hay un email
            self::$alertas['error'][] = 'EL email es obligatorio';//en nuetras alertas sera de error
        }

        return self::$alertas;
    }







    //AQUI ESTAMOS VALIDANDO EL NUEVO PASSWORD CUANDO EL USUARIO SE LE OLVIDO LA CONTRASEñA VIEJA
    public function validarPassword(){
        //PARA VALIDAR PASSWORD NUEVO TENEMOS QUE VALIDAR QUE YA HAYA UN PASSWORD ANTERIOR Y QUE TENGA UN MINIMO DE CARACTERES
        if(!$this->password){
            self::$alertas['error'][]='el password es obligatorio';
        }


        if(strlen($this->password)< 6){
            self::$alertas['error'][]='el password debe tener almenos 6 caracteres';
        }


        return self::$alertas;
    }







    //REVISA SI EL USUARIO YA EXISTE
    public function existeUsuario(){
        $query=" SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1 ";//EN ESOS DOS PUNTOS voy hacer referencia a mi tabla de base de datos que tengo arriva de usaurios, como estamos dentro del usuario utilizamos this para hacer referencia al email si estubiera en LoginController  tendriamo que intanciar $usuario=new Usuario
    
        $resultado=self::$db->query($query);//recordemos que $db es la conexion a la base de datos
        
        

        if($resultado->num_rows){//utilizamos la sintaxis de flecha porque la conexion de musqli hace un objeto
            //entonces decimos si hay un resultado significa que esa persona ya esta registada
            self::$alertas['error'][]='El usuario ya esta registrado';
        }
    
        return $resultado;
    }//tienen que haver comillas sencillas en el email orque es un string EL LIMIT DE 1 CON LA PRIMERA COINCIDENCIA QUE ENCUENTRE YA CON ESO LO VA DENEGAR


    public function hashPassword(){
        $this->password=password_hash($this->password, PASSWORD_BCRYPT);//toma dos valores el password y la funcion
    }



    public function crearToken(){
        $this->token=uniqid();//vamos asignarle toen en el objeto cuando imrimimos con debuguear usuario, funcion de php que uniqid es ideal para generar token
    }



    public function comprobarPasswordAndVerificado($password){
        $resultado=password_verify($password, $this->password);//esta funcion password verify toma el password que nos a dado el usuario y despues el password de la base de datos
    
        if(!$resultado || !$this->confirmado){//recordar que con debuguear this podemos ver si esta confirmado el usuario si esta en 1 esta confirmado, aqui estamos diciendo si resultado no esta confirmado o this no esta confirmado
            self::$alertas['error'][]='Password Incorrecto o tu cuenta no ha sido confirmada';
        }else{
            return true;
        }    
    }
}