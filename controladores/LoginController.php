<?php

/**
 * Incluimos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

/**
 * Controlador de la página de Login desde la cual se puede acceder a tu perfil
 */
class LoginController extends BaseController
{
   public function __construct()
   {
      parent::__construct();
      $this->modelo = new UserModel();
      $this->mensajes = [];
   }

   public function index()
   {
      $parametros = [];
      $this->view->show("Login", $parametros);
   }

   /**
    * Funcion que nos permite hacer login en la bbdd con un determinado usuario y asi darle paso a su pagina personal.
    * 
    */
   public function inUser()
   {
      //Array donde almacenamos los errores
      $errores = array();

      //Bucle para comprobar que hemos pulsado el boton SUBMIT
      if (isset($_POST['submit'])) {

         //Bucle para comporbar que no esten vacios los campos usuario y contraseña
         if (empty($_POST['txtusuario']) || empty($_POST['txtpassword'])) {

            //Almacenamos los mensajes
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "¿No tienes cuenta? Necesitas registrarte"
            ];
            $parametros["mensajes"] = $this->mensajes;
            //Volvemos al usuario a la vista Inicio(Login)
            $this->view->show("Inicio", $parametros);
         }

         //Guardamos en la variables los valores introducidos en el Login 
         $usuario = $_POST['txtusuario'];
         $password = $_POST['txtpassword'];

         //Llamamos al modelo que contiene el metodo de inicio de sesion pasandole la contraseña y usuario
         $resultado = $this->modelo->inUser([
            'usuario' => $usuario,
            'password' => $password
         ]);

         //Creamos la sesion
         session_start();
         //Guardamos el valor usuario en la sesion [Usuario]
         $_SESSION['usuario'] = $usuario;

         //Comprobamos la id del usuario para saber ROL que le pertenece
         $datos = $this->modelo->comprobarID($usuario);

         //Si el usuario y contraseña son correctos:
         if ($resultado['correcto'] == TRUE) {

            //Guardamos en la sesion su id por la datos que ha devuelto el modelo
            $_SESSION['id'] = $datos['datos']['id'];
            //Guardamos en la sesion su rol_id por la datos que ha devuelto el modelo
            $_SESSION['rol_id'] = $datos['datos']['rol_id'];

            //Si es igual a 2 no esta validado y no podra inciar sesion hasta que se valide
            if ($_SESSION['rol_id'] != 2) {

               $parametros['datos'] = $resultado['datos'];
               
               //Actualiazamos la sesion con la info extraida de la BBDD
               $_SESSION['nombre'] = $parametros['datos'][0]['nombre'];
               $_SESSION['apellido1'] = $parametros['datos'][0]['apellido1'];
               $_SESSION['apellido2'] = $parametros['datos'][0]['apellido2'];
               $_SESSION['dni'] = $parametros['datos'][0]['nif'];
               $_SESSION['telefono'] = $parametros['datos'][0]['telefono'];
               $_SESSION['direccion'] = $parametros['datos'][0]['direccion'];
               $_SESSION['imagen'] = $parametros['datos'][0]['imagen'];
               $_SESSION['password'] = $parametros['datos'][0]['password'];

               
               //Segun se ROL_ID tendra su vista correspondiente
               if ($_SESSION['rol_id'] == 0) {
                  $this->view->show("paginaAdmin", $parametros);
               }
               if ($_SESSION['rol_id'] == 1) {
                  $this->view->show("paginaUsuario", $parametros);
               }

               //Si el usuario y contraseña NO son correctos:
            } else {
               $this->mensajes[] = [
                  "tipo" => "warning",
                  "mensaje" => "Usuario no validado."
               ];
               $parametros["mensajes"] = $this->mensajes;

               $this->view->show("Inicio", $parametros);
            }
            //Si el usuario no esta validado.
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "Usuario o contraseña incorrectos" 
            ];
            $parametros["mensajes"] = $this->mensajes;

            $this->view->show("Inicio", $parametros);
         }

      } 
   }
}
