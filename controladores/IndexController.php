<?php
session_start();
/**
 * Controlador de la página index desde la que se puede hacer el login y el registro
 */

/**
 * Incluimos todos los modelos que necesite este controlador
 */
require_once MODELS_FOLDER . 'UserModel.php';

class IndexController extends BaseController
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
      $this->view->show("Inicio", $parametros);
   }


   public function registro()
   {
      $parametros = [];
      $this->view->show("RegistroUsuarios", $parametros);
   }

   /**
    * 
    * ****************************                                  METODOS PARA EL PERFIL  DE LOS USUARIOS                                           ****************************
    * ****************************                                                                                                                    ****************************    
    */


   /**
    * Función para editar un perfil ya creado
    * 
    */
   public function editarPerfil()
   {
      //Array que almacenara los errores
      $errores = array();

      // Si se ha pulsado el botón guardar y no hay variables post vacias:
      if (isset($_POST) && !empty($_POST) && isset($_POST['submit']) && !empty($_POST['txtpassword'])) {
         //Limpiamos los valores que nnos ha llegado de la vista
         $nombre = filter_var($_POST['txtnombre'], FILTER_SANITIZE_STRING);
         $apellido1 = filter_var($_POST['txtapellido1'], FILTER_SANITIZE_STRING);
         $apellido2 = filter_var($_POST['txtapellido2'], FILTER_SANITIZE_STRING);
         $dni = filter_var($_POST['txtdni'], FILTER_SANITIZE_STRING);
         $direccion = filter_var($_POST['txtdireccion'], FILTER_SANITIZE_STRING);
         $telefono = filter_var($_POST['txttelefono'], FILTER_SANITIZE_STRING);
         $password = $_POST['txtpassword'];

         //Creamos la session
         $_SESSION['nombre'] = $nombre;
         $_SESSION['apellido1'] = $apellido1;
         $_SESSION['apellido2'] = $apellido2;
         $_SESSION['dni'] = $dni;
         $_SESSION['telefono'] = $telefono;
         $_SESSION['direccion'] = $direccion;
         $_SESSION['password'] = $password;


         //no trabajo con la imagen
         $imagen = NULL;


         //Si no se cumple la expresión regular se genera error
         if (!preg_match("/[a-zA-Z]{1,30}$/", $nombre)) {
            $this->mensajes[] = [
               "campo" => "nombre",
               "tipo" => "danger",
               "mensaje" => "nombre no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
            $_SESSION['nombre'] = null;
         }

         if (!preg_match("/^\d{8}[a-zA-Z]{1}$/", $dni)) {
            $this->mensajes[] = [
               "campo" => "dni",
               "tipo" => "danger",
               "mensaje" => "Dni no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
            $_SESSION['dni'] = null;
         }

         if (!preg_match("/^[6-7]{1}[0-9]{8}$/", $telefono) && !preg_match("/^[8-9]{1}[0-9]{8}$/", $telefono)) {
            $this->mensajes[] = [
               "campo" => "telefono",
               "tipo" => "danger",
               "mensaje" => "Solo fijos nacionales o moviles."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
            $_SESSION['telefono'] = null;
         }


         if (!preg_match("/[a-zA-Z0-9_]{1,100}/", $direccion)) {
            $this->mensajes[] = [
               "campo" => "direccion",
               "tipo" => "danger",
               "mensaje" => "Nombre no valido."
            ];
            $errores["nombre"] = "Error: No valido";
            $parametros = ["mensajes" => $this->mensajes];
            $_SESSION['direccion'] = null;
         }

         //Si hay errores llevamos al usuario de nuevo a la vista 
         if (count($errores) > 0) {
            $this->view->show("completarPerfil", $parametros);
         }

         // Si no se han producido errores realizamos el registro del usuario llamando al metodo correspondiente del modelo
         if (count($errores) == 0) {
            $resultModelo = $this->modelo->actuser([
               'usuario' => $_SESSION['usuario'],
               'nombre' => $nombre,
               "apellido1" => $apellido1,
               'apellido2' => $apellido2,
               'dni' => $dni,
               'direccion' => $direccion,
               'telefono' => $telefono,
               'imagen' => $imagen,
               'password' => $password
            ]);

            if ($resultModelo["correcto"]) {
               $this->mensajes[] = [
                  "tipo" => "success",
                  "mensaje" => "El usuarios se registró correctamente!! :)"
               ];
               //Cargamos la ruta de la imagen en la sesion del usuario.
               $_SESSION['imagen'] = $imagen;
            } else {
               $this->mensajes[] = [
                  "tipo" => "danger",
                  "mensaje" => "El usuario no pudo registrarse!! :( <br />({$resultModelo["error"]})"
               ];
            }
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "Datos de registro de usuario erróneos!! :("
            ];
         }
      }

      //Según el rol nos lleva a la vista para cada uno
      if ($_SESSION['rol_id'] == 0) {
         $this->view->show("paginaAdmin");
      } else {
         $this->view->show("paginaUsuario");
      }
   }

   /**
    * 
    * ****************************                                  METODOS PARA EL HORARIO                                        ****************************
    * ****************************                                                                                                 ****************************    
    */

   /**
    * Metodo que nos lista el horario de clases con sus Horas
    */
   public function listarHorario()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a pasar a la vista
      $parametros = [
         "datos" => NULL,
         "mensajes" => [],
         "horario" => ["07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->listadoClases();

      if ($resultModelo["correcto"]) {
         //Creamos un nuevo array asociativo metiendo en el la clave y como valor, la hora de inicio de la clase de turno.
         foreach ($resultModelo["datos"] as $key => $value) {
            $horas[$key] = $value['horaInicio'];
         }
         //Usamos el array de horas que hemos ordenado para ordenar el array donde estan todos los datos.
         array_multisort($horas, SORT_ASC, $resultModelo["datos"]);

         $parametros["datos"] = $resultModelo["datos"];

         //No quiero mostrar el mensaje ya que resulta incomodo, tan solo con ver si la tabla esta rellena sabemos si fue con exito
         /* $this->mensajes[] = [
            "tipo" => null,
            "mensaje" => null
         ]; */
      } else {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
         ];
      }

      $parametros["mensajes"] = $this->mensajes;
      $this->view->show("ListarClases", $parametros);
   }

   /**
    * Metodo para editar el horario, despues de listarlo
    *
    */
   public function editarHorario()
   {
      if (isset($_SESSION['rol_id'])) {

         // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
         $parametros = [
            "datos" => NULL,
            "mensajes" => [],
            "horario" => ["07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
         ];

         // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
         $resultModelo = $this->modelo->listadoClases();

         if ($resultModelo["correcto"]) {
            //Creamos un nuevo array asociativo metiendo en el la clave y como valor, la hora de inicio de la clase de turno.
            foreach ($resultModelo["datos"] as $key => $value) {
               $horas[$key] = $value['horaInicio'];
            }
            //Usamos el array de horas que hemos ordenado para ordenar el array donde estan todos los datos.
            array_multisort($horas, SORT_ASC, $resultModelo["datos"]);

            $parametros["datos"] = $resultModelo["datos"];
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "El listado se realizó correctamente"
            ];
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
         }

         $parametros["mensajes"] = $this->mensajes;
         $this->view->show("editarHorario", $parametros);
      } else {
         $this->view->show("inicio");
      }
   }

   /**
    * 
    * ****************************                                  METODOS PARA LAS CLASES                                                ****************************
    * ****************************                                                                                                         ****************************    
    */

   /**
    * Metodo que nos devuelve la lista de actividades
    */
   public function verActividades()
   {
      $parametros = [
         "datos" => NULL,
         "mensajes" => []
      ];
      // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
      $resultModelo = $this->modelo->verActividades();

      if ($resultModelo["correcto"]) {
         $parametros["datos"] = $resultModelo["datos"];
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "El listado se realizó correctamente"
         ];
      } else {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
         ];
      }

      $parametros["mensajes"] = $this->mensajes;

      //Segregamos entre administradores y usuarios normales a la hora de cargar la vista.
      if ($_SESSION['rol_id'] == 0) {
         $this->view->show("ListarOfertaAdmin", $parametros);
      } else {
         $this->view->show("ListarOfertaUsuarios", $parametros);
      }
   }


   /**
    * Funcion que nos permite llamar a la vista en la que se encuentra el formulario para una clase
    * 
    */
   public function insertClase($parametros = null)
   {
      if (isset($_SESSION['rol_id'])) {
         $this->view->show("insertarClase", $parametros);
      } else {
         $this->view->show("inicio");
      }
   }

   /**
    * Funcion que nos permite insertar un nuevo tipo de clase en la BBDD
    */
   public function insertarClase()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "datos" => NULL,
         "mensajes" => []
      ];

      //Imagen por defecto
      $imagen = "defecto.jpg";

      //Si el nombre y descripcion existe:
      if (!empty($_POST['txtnombre']) || !empty($_POST['txtdescripcion'])) {

         //Todo lo relacionado con la carga de la foto.
         if (isset($_FILES["imagen"]) && (!empty($_FILES["imagen"]["tmp_name"]))) {
            // Verificamos la carga de la imagen
            // Comprobamos si existe el directorio fotos, y si no, lo creamos
            if (!is_dir("img/clases")) {
               $dir = mkdir("img/clases", 0777, true);
            } else {
               $dir = true;
            }
            // Ya verificado que la carpeta uploads existe movemos el fichero seleccionado a dicha carpeta
            if ($dir) {
               //Para asegurarnos que el nombre va a ser único...
               $nombrefichimg = $_FILES["imagen"]["name"];
               // Movemos el fichero de la carpeta temportal a la nuestra
               $movfichimg = move_uploaded_file($_FILES["imagen"]["tmp_name"], "img/clases/" . $nombrefichimg);
               $imagen = $nombrefichimg;
               // Verficamos que la carga se ha realizado correctamente
               if ($movfichimg) {
                  $imagencargada = true;
               } else {
                  $imagencargada = false;
                  $this->mensajes[] = [
                     "tipo" => "danger",
                     "mensaje" => "Error: La imagen no se cargó correctamente! :("
                  ];
                  $errores["imagen"] = "Error: La imagen no se cargó correctamente! :(";
               }
            }
         }

         //Llamamos al modelo para insertar la clase
         $resultModelo = $this->modelo->insertarClase([
            'nombre' => $_POST['txtnombre'],
            'descripcion' => $_POST['txtdescripcion'],
            'imagen' => $imagen
         ]);

         if ($resultModelo["correcto"]) {
            $parametros["datos"] = isset($resultModelo["datos"]);
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "Operacion realizada correctamente"
            ];
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "No se ha podido borrar!! :( <br/>({$resultModelo["error"]})"
            ];
         }
         $parametros["mensajes"] = $this->mensajes;
      } else {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No pueden existir campos vacios."
         ];
         $parametros["mensajes"] = $this->mensajes;
      }

      //Llamamos al metodo que llama a la vista pasandole los mensajes / datos oportunos.   
      $this->insertClase($parametros);
   }

   /**
    * Metodo para añadir una clase al horario
    */
   public function insertClaseExistente($resutadoModelo = null)
   {
      if (isset($_SESSION['id'])) {
         $parametros = [
            "datos" => NULL,
            "mensajes" => [],
            "horario" => ["07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
         ];

         //Metemos la oferta de clases para que el administrador pueda elegir
         $resultModelo = $this->modelo->verActividades();
         $parametros["clases"] = $resultModelo['datos'];
         //$parametros["mensajes"] = $this->mensajes;
         $this->view->show("insertarClaseExistente", $parametros);
      } else {
         $this->view->show("inicio");
      }
   }

   /**
    * Funcion que nos permite insertar una clase en un determinado dia y hora.
    */
   public function insertarClaseExistente()
   {

      //Si la hora de inicio es mayor que la hora de
      if ($_POST['txtHoraInicio'] > $_POST['txtHoraFin']) {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "Una clase no puede empezar mas tarde de lo que termina!"
         ];
      } else {
         $resultModelo = $this->modelo->insertarClaseExistente([
            'idClase' => $_POST['txtidclase'],
            'Dia' => $_POST['txtDia'],
            'horaInicio' => $_POST['txtHoraInicio'],
            'horaFin' => $_POST['txtHoraFin']
         ]);
      }

      //Pasamos el resultado, con los mensajes de error si es que existen al metodo especifico parsa mostrar por pantalla.
      $this->insertClaseExistente($resultModelo);
   }


   /**
    * Funcion que nos permite eliminar una clase de un dia y hora concretos.
    */
   public function delClaseExistente()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "datos" => NULL,
         "mensajes" => []
      ];
      $id = $_GET['id'];

      // Realizamos el borrado pasando el id de la clase.
      $resultModelo = $this->modelo->delClaseExistente($id);

      if ($resultModelo["correcto"]) {

         $parametros["datos"] = $resultModelo["datos"];
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "Operacion realizada correctamente"
         ];
      } else {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No se ha podido borrar!! :( <br/>({$resultModelo["error"]})"
         ];
      }

      $parametros["mensajes"] = $this->mensajes;

      //Llamamos a la funcion para listar el horario al administrador.
      $this->editarHorario();
   }

   /**
    * Funcion que nos permite inscribir a un usuario en una determinada clase.
    */
   public function insertarInscripcion()
   {
      $parametros = [
         "datos" => NULL,
         "mensajes" => []
      ];

      // Realizamos la consulta pasando el id de clase a la que se quiere inscribir. Esto lo hacemos para comprobar
      // que no se inscriba dos veces en la misma clase.
      $resultModelo = $this->modelo->insertarInscripcion($_GET['idCl']);

      //Si no esta inscrito en la clase:
      if ($resultModelo['inscrito'] == false) {

         //Y si el inster no ha fallado:
         if ($resultModelo["correcto"]) {
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "Se te ha inscrito en la clase seleccionada"
            ];
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "Error inesperado!! :( <br/>({$resultModelo["error"]})"
            ];
         }

         //Metemos el mensaje de error o exito.
         $parametros["mensajes"] = $this->mensajes;
      } else {
         //Si inscrito es true:
         $this->mensajes[] = [
            "tipo" => "warning",
            "mensaje" => "Ya estas inscrito a esta clase!"
         ];
      }
      $this->listarHorario($parametros["mensajes"]);
   }

   /**
    * Funcion que nos permite listar las clases a las que esta apuntado un determinado usuario.
    * Recoge los datos devueltos pro la base de datos y se los manda a la vista correspondiente.
    */
   public function listarInscripciones()
   {
      if (isset($_SESSION['rol_id'])) {
         // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
         $parametros = [
            "datos" => NULL,
            "mensajes" => []
         ];
         // Realizamos la consulta y almacenamos los resultados en la variable $resultModelo
         $resultModelo = $this->modelo->listadoInscripciones();

         if ($resultModelo["correcto"]) {
            $parametros["datos"] = $resultModelo["datos"];

            $this->mensajes[] = [
               "tipo" => null,
               "mensaje" => null
            ];
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
         }

         $parametros["mensajes"] = $this->mensajes;
         $this->view->show("ListarClasesInscritas", $parametros);
      } else {
         $this->view->show("inicio");
      }
   }

   /**
    * Funcion que nos permite borrar una inscripcion de un usuario a una determinada clase.
    */
   public function borrarInscripcion()
   {
      // Almacenamos en el array 'parametros[]'los valores que vamos a mostrar en la vista
      $parametros = [
         "datos" => NULL,
         "mensajes" => []
      ];
      $id = $_GET['id'];

      // Realizamos la eliminacion pasandole el id del usuario.
      $resultModelo = $this->modelo->borrarInscripcion($id);

      if ($resultModelo["correcto"]) {
         $parametros["datos"] = $resultModelo["datos"];
         $this->mensajes[] = [
            "tipo" => "warning",
            "mensaje" => "Fuistes excluido de la clase."
         ];
      } else {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No se ha podido borrar!! :( <br/>({$resultModelo["error"]})"
         ];
      }

      $parametros["mensajes"] = $this->mensajes;

      //Llamamos al metodo que lista las inscripciones del usuario.
      $this->listarInscripciones();
   }

   /**
    * Funcion que nos permite llamar a la vista en la que se encuentra el formulario para editar un tipo de clase
    *
    */
   public function editClase($parametros = null)
   {
      $resultModelo = $this->modelo->infoClase([
         'id' => $_GET['id']
      ]);

      $this->view->show("editarClase", $resultModelo);
   }

   /**
    * Funcion que nos permite listar los tipos de clases existentes al administrador para que pueda eliminar
    * o editar datos.
    */
   public function listarClasesEditarBorrar()
   {
      if (isset($_SESSION['rol_id'])) {
         $parametros = [
            "datos" => NULL,
            "mensajes" => []
         ];

         $resultModelo = $this->modelo->listarOferta();

         if ($resultModelo["correcto"]) {
            $parametros["datos"] = $resultModelo["datos"];
            $this->mensajes[] = [
               "tipo" => "success",
               "mensaje" => "El listado se realizó correctamente"
            ];
         } else {
            $this->mensajes[] = [
               "tipo" => "danger",
               "mensaje" => "El listado no pudo realizarse correctamente!! :( <br/>({$resultModelo["error"]})"
            ];
         }

         $parametros["mensajes"] = $this->mensajes;
         $this->view->show("ListarClasesEditarBorrar", $parametros);
      } else {
         $this->view->show("inicio");
      }
   }

   /**
    * Funcion que nos permite editar una clase de un determinado tipo en el sistema.
    */
   public function editarClase()
   {
      $parametros = [
         "datos" => NULL,
         "mensajes" => []
      ];

      $imagen = "porDefecto.jpg";

      //Si el nombre y descripcion no esta vacios:
      if (!empty($_POST['txtnombre']) || !empty($_POST['txtdescripcion'])) {
         //Todo lo relacionado con la carga de la foto.
         if (isset($_FILES["imagen"]) && (!empty($_FILES["imagen"]["tmp_name"]))) {
            // Verificamos la carga de la imagen
            // Comprobamos si existe el directorio fotos, y si no, lo creamos
            if (!is_dir("img/clases")) {
               $dir = mkdir("img/clases", 0777, true);
            } else {
               $dir = true;
            }
            // Ya verificado que la carpeta uploads existe movemos el fichero seleccionado a dicha carpeta
            if ($dir) {
               //Para asegurarnos que el nombre va a ser único...
               $nombrefichimg = $_FILES["imagen"]["name"];
               // Movemos el fichero de la carpeta temportal a la nuestra
               $movfichimg = move_uploaded_file($_FILES["imagen"]["tmp_name"], "img/clases/" . $nombrefichimg);
               $imagen = $nombrefichimg;
               // Verficamos que la carga se ha realizado correctamente
               if ($movfichimg) {
                  $imagencargada = true;
               } else {
                  $imagencargada = false;
                  $this->mensajes[] = [
                     "tipo" => "danger",
                     "mensaje" => "Error: La imagen no se cargó correctamente! :("
                  ];
                  $errores["imagen"] = "Error: La imagen no se cargó correctamente! :(";
               }
            }
         }

         //Editamos la imagen
         $resultModelo = $this->modelo->editarClase([
            'nombre' => $_POST['txtnombre'],
            'descripcion' => $_POST['txtdescripcion'],
            'id' => $_GET['id'],
            'imagen' => $imagen
         ]);
      } else {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No pueden existir campos vacios."
         ];
         $parametros["mensajes"] = $this->mensajes;
      }

      //Volvemos al listado de actividades
      $this->verActividades($parametros);
   }


   /**
    * Metodo que nos permite eliminar una determinada clase del sistema
    */
   public function delClase()
   {
      $parametros = [
         "datos" => NULL,
         "mensajes" => []
      ];

      $id = $_GET['id'];

      //Borramos la clase pasandole el id de esta.
      $resultModelo = $this->modelo->delClase($id);

      if (isset($resultModelo["correcto"])) {
         $parametros["datos"] = isset($resultModelo["datos"]);
         $this->mensajes[] = [
            "tipo" => "success",
            "mensaje" => "Operacion realizada correctamente"
         ];
      } else {
         $this->mensajes[] = [
            "tipo" => "danger",
            "mensaje" => "No se ha podido borrar!! :( <br/>({$resultModelo["error"]})"
         ];
      }

      $parametros["mensajes"] = $this->mensajes;

      $this->verActividades($parametros);
   }
}
