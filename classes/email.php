<?php


namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

//RECORDAR QUE HICIMOS ESTA CARPETA APARTE DE CLASES PORQUE SON CLASES TERCIARIAS
class Email{//esta clase va tener un constructor 



    //ATRIBUTOS DE LA CLASE
    public $email;
    public $nombre;
    public $token;





    public function __construct($email,$nombre,$token)//va tomar el email al cual vamos a enviarle el email de confirmacion vamos a  ponerle el nombre y tambien su token
    {
        $this->email=$email;//entonces emial va ser igual al email que le vamos a pasar en el constructor y asi con los demas
        $this->nombre=$nombre;
        $this->token=$token;
    }



    public function enviarConfirmacion(){//y no toma nada porque ya lo tiene todo en el objeto con debuguear usuario
        //CREAR EL OBJETO DE EMAIL
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];





        //VAMOS A UTILIZAR HTML OSEA HAY QUE DECIRSELO AQUI set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';//de esta forma estamos diciendo que vamos a utilizar HTML aqui abajo


        //TODO ESTO SIGUIENTE SON LOS ATRIBUTOS DE PHP MAILER
        $mail->setFrom('cuentas@appsalon.com');//set from es qien envia el coreo electronico, aqui es donde ya hayamos hecho o comprado dominio
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');//addAddress es la direccion de correo electronico del cliente
        $mail->Subject='Confirma tu cuenta';



        $contenido="<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .="</html";
        $mail->Body = $contenido;//boy construyendo todo mi cuerpo de emial y despues se lo pongo dentro del body




        //ENVIAR EL EMAIL
        $mail->send();//lo enviamos de aqui porque en el login.controller.php tenemos el metodo de EnviarConfirmacion entonces lo mnadamos a llamr arriba y aqui mismo enviamos el correo con send
    }


    
    
    
    
    
    
    
    
    
    
    //este metodo es enviar instrucciones el que esta en login controller el que envia el correo cuando el usuario quiere restablecer la contraseñ
    public function enviarIntrucciones(){//no toma nada porque cuando lo estamos intanciando en active record se pasa el constructor
        //CREAR EL OBJETO DE EMAIL
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];





        //VAMOS A UTILIZAR HTML OSEA HAY QUE DECIRSELO AQUI set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';//de esta forma estamos diciendo que vamos a utilizar HTML aqui abajo


        //TODO ESTO SIGUIENTE SON LOS ATRIBUTOS DE PHP MAILER
        $mail->setFrom('cuentas@appsalon.com');//set from es qien envia el coreo electronico, aqui es donde ya hayamos hecho o comprado dominio
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');//addAddress es la direccion de correo electronico del cliente
        $mail->Subject='Reestablece tu password';



        $contenido="<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo </p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "'>Restablecer Password</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .="</html";
        $mail->Body = $contenido;//boy construyendo todo mi cuerpo de emial y despues se lo pongo dentro del body, RECORDAR QUE INYECTAMOS LA VARIABLE DE ENTORNO EN $_ENV['APP_URL']




        //ENVIAR EL EMAIL
        $mail->send();//lo enviamos de aqui porque en el login.controller.php tenemos el metodo de EnviarConfirmacion entonces lo mnadamos a llamr arriba y aqui mismo enviamos el correo con send
    }
}