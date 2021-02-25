<?php
session_start();
/**
 * Incluimos los modelos que necesite este controlador
 * TODOS ESTOS METODOS CREADOS SOLO LE DARA USO LOS PERFILES COMO ADMINISTRADOR
 */
require_once MODELS_FOLDER . 'UserModel.php';

class AdminController extends BaseController
{

    // El atributo $modelo es de la 'clase modelo' y será a través del que podremos 
   // acceder a los datos y las operaciones de la base de datos desde el controlador
   private $modelo;
   //$mensajes se utiliza para almacenar los mensajes generados en las tareas, 
   //que serán posteriormente transmitidos a la vista para su visualización
   private $mensajes;

   /**
    * Constructor que crea automáticamente un objeto modelo en el controlador e
    * inicializa los mensajes a vacío
    */
   public function __construct()
   {
      parent::__construct();
      $this->modelo = new UserModel();
      $this->mensajes = [];
   }

   public function inicio()
   {
      $parametros = [
         "tituloventana" => "Inicio del sitio del administrador"
      ];
      $this->view->show("paginaAdmin", $parametros);
   }

   /**
    * Metodo para listar todos los usuarios
    */
    public function listaUsuarios(){

        if (isset($_SESSION['rol_id'])) {

           // Almacenamos en el array 'parametros[]' los valores que vamos a pasar a la vista
           $parametros = [
              "datos" => NULL,
              "mensajes" => []
           ];
           //Llamamada al modelo para que haga la ejecución de busqueda en la bbdd
           $resultModelo = $this->modelo->listado();
        
           //Bucle para comprobar si fue correcto
           if ($resultModelo["correcto"]){
              $parametros["datos"] = $resultModelo["datos"];
              //Donde se guardan los mensajes si fue correcto
              $this->mensajes[] = [
                 "tipo" => "success",
                 "mensaje" => "El listado se realizó correctamente"
              ];
           }else{
              //Si no fue correcto
              $this->mensajes[] = [
                 "tipo" => "danger",
                 "mensaje" => "El listado no pudo realizarse correctamente. <br/>({$resultModelo["error"]})"
              ];
           }
           //Llamamos a la vista pasandole los parametros
           $parametros["mensajes"] = $this->mensajes;
           $this->view->show("ListarUsuarios", $parametros);
        }else{
           $this->view->show("inicio");
        }
     }
  
     /**
      * Funcion para listar al administrador los usuarios no validados.
      */
     public function listaUsuariosNoValidados(){
  
        if (isset($_SESSION['rol_id'])) {
  
           $parametros = [
              "datos" => NULL,
              "mensajes" => []
           ];
  
           $resultModelo = $this->modelo->listadoNoValidados();
  
           if ($resultModelo["correcto"]){
              $parametros["datos"] = $resultModelo["datos"];
              $this->mensajes[] = [
                 "tipo" => "success",
                 "mensaje" => "Operación realizada correctamente"
              ];
           }else{
              $this->mensajes[] = [
                 "tipo" => "danger",
                 "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
              ];
           }
           
           $parametros["mensajes"] = $this->mensajes;
           $this->view->show("ListarUsuariosNoValidados", $parametros);
        }else{
           $this->view->show("inicio");
        }
     }

    /**
    * Metodo para que el administrador edite el usuario en concreto.
    */
   public function editarUsuario()
   {  
      //Cargamos todos los datos del usuario pasandole el id.
      $parametros['datos'] = $this->modelo->perfilCompleto($_GET['usuario']);     
      $this->view->show("editarUsuario",$parametros);
   }

}