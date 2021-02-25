<?php

/**
 *   Clase 'UserModel' que implementa el modelo de usuarios de nuestra aplicación en una
 * arquitectura MVC. Se encarga de gestionar el acceso a la tabla usuarios
 */
class UserModel extends BaseModel
{

   private $id;

   private $nombre;

   private $email;

   private $password;

   private $image;

   public function __construct()
   {
      // Se conecta a la BD
      parent::__construct();
      $this->table = "usuarios";
   }

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNombre()
   {
      return $this->nombre;
   }

   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   public function getEmail()
   {
      return $this->email;
   }

   public function setEmail($email)
   {
      $this->email = $email;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function setPassword($password)
   {
      $this->password = $password;
   }

   public function getImage()
   {
      return $this->image;
   }

   public function setImage($image)
   {
      $this->image = $image;
   }

   /**
    * 
    * ****************************                                  METODOS PARA  LOS USUARIOS                                                        ****************************
    * ****************************                                                                                                                    ****************************    
    */

   /**
    * Función que permite añadir un usuario a la bbdd.
    */
   public function adduser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "INSERT INTO usuarios(usuario,password,nombre,apellido1,apellido2,nif,email,telefono,direccion,rol_id) VALUES (:usuario, :password, :nombre, :apellido1, :apellido2,
          :dni, :email, :telefono, :direccion, :rol_id)";
         // Preparamos la consulta...
         $query = $this->db->prepare($sql);
         // y la ejecutamos indicando los valores que tendría cada parámetro
         $query->execute([
            'usuario' => $datos["usuario"],
            'password' => $datos["password"],
            'nombre' => $datos["nombre"],
            'apellido1' => $datos["apellido1"],
            'apellido2' => $datos["apellido2"],
            'dni' => $datos["dni"],
            'email' => $datos["email"],
            'telefono' => $datos["telefono"],
            'direccion' => $datos["direccion"],
            'rol_id' => $datos["rol_id"]
         ]); //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }


   /**
    * Función que comprueba que el usuario y contraseña son correctos
    */
   public function inUser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         $sql = "SELECT * FROM usuarios WHERE usuario =:usuario and password =:password";
         $query = $this->db->prepare($sql);
         $query->execute(['usuario' => $datos["usuario"], 'password' => $datos["password"]]);

         if ($query) {
            $usuarioDatos = $query->fetchAll();

            if (count($usuarioDatos) > 0) {
               $return["correcto"] = TRUE;
               $return["datos"] = $usuarioDatos;
            }
         }
      } catch (\Throwable $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Método que elimina el usuario cuyo id es el que se le pasa como parámetro 
    */
   public function deluser($id)
   {
      // La función devuelve un array con dos valores:'correcto', que indica si la
      // operación se realizó correctamente, y 'mensaje', campo a través del cual le
      // mandamos a la vista el mensaje indicativo del resultado de la operación
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];
      //Si hemos recibido el id y es un número realizamos el borrado...
      if ($id && is_numeric($id)) {
         try {
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM usuarios WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos si la eliminación se realizó correctamente... 
            if ($query) {
               $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
         }
      } else {
         $return["correcto"] = FALSE;
      }

      return $return;
   }

   /**
    * Función que realiza el listado de todos los usuarios registrados
    */
   public function listado()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM usuarios";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Metodo para actualizar los usuarios cuando un admin lo pide
    */

   public function actuser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];


      try {
         $sql = "UPDATE usuarios SET nif= :nif, nombre= :nombre, apellido1= :apellido1, apellido2= :apellido2, password= :password ,imagen= :imagen, telefono= :telefono, direccion= :direccion  WHERE usuario= :usuario";
         $query = $this->db->prepare($sql);

         //Si no trae el nombre de usuario lo cogemos de la sesion.
         if (!is_null($datos['usuario'])) {
            $query->execute([
               'nif' => $datos['dni'],
               'nombre' => $datos["nombre"],
               'apellido1' => $datos["apellido1"],
               'apellido2' => $datos["apellido2"],
               'password' => $datos['password'],
               'imagen' =>   $datos['imagen'],
               'telefono' => $datos['telefono'],
               'direccion' => $datos['direccion'],
               'usuario' => $datos['usuario']
            ]);
         } else {
            $query->execute([
               'nif' => $datos['dni'],
               'nombre' => $datos["nombre"],
               'apellido1' => $datos["apellido1"],
               'apellido2' => $datos["apellido2"],
               'password' => $datos['password'],
               'imagen' => $datos['imagen'],
               'telefono' => $datos['telefono'],
               'direccion' => $datos['direccion'],
               'usuario' => $_SESSION['usuario']
            ]);
         }


         if ($query) {
            $return["correcto"] = TRUE;
         }
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que realiza el listado de un usaurio pasandole el id
    */
   public function listausuario($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      if ($id && is_numeric($id)) {
         try {
            $sql = "SELECT * FROM usuarios WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos que la consulta se realizó correctamente... 
            if ($query) {
               $return["correcto"] = TRUE;
               $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
            } // o no :(
         } catch (PDOException $ex) {
            $return["error"] = $ex->getMessage();
            //die();
         }
      }

      return $return;
   }

   /**
    * Función que permite listar el rol_id y el id de un usuario mediante su usuario.
    */
   public function comprobarID($usuario)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      try {
         $sql = "SELECT rol_id , id FROM usuarios WHERE usuario=:usuario";
         $query = $this->db->prepare($sql);
         $query->execute(['usuario' => $usuario]);
         //Supervisamos que la consulta se realizó correctamente... 
         if ($query) {
            $return["correcto"] = TRUE;
            $return["datos"] = $query->fetch();
         } // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   /**
    * Función que realiza el listado de todos los usuarios no validados
    */
   public function listadoNoValidados()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];
      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM usuarios WHERE rol_id = 2";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que listar toda la informacion de un determinado usuario mediante el usuario
    */
   public function perfilCompleto($usuario)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      try {
         $sql = "SELECT * FROM usuarios WHERE usuario=:usuario";
         $query = $this->db->prepare($sql);

         //depende de que metodo llame a este (perfilCompleto), se ejecutara la consulta de una determinada manera.
         if (is_null($usuario)) {
            $query->execute(['usuario' => $_SESSION['usuario']]);
         } else {
            $query->execute(['usuario' => $usuario]);
         }


         //Supervisamos que la consulta se realizó correctamente... 
         if ($query) {
            $return["correcto"] = TRUE;
            $return["datos"] = $query->fetch(PDO::FETCH_ASSOC);
         } // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   /**
    * Función que actualizar el rol_id de un usuario al administrador
    */
   public function actualizaruser($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         //Inicializamos la transacción
         $this->db->beginTransaction();
         //Definimos la instrucción SQL parametrizada 
         $sql = "UPDATE usuarios SET rol_id= :rol_id WHERE id=:id";
         $query = $this->db->prepare($sql);
         $query->execute([
            'id' => $datos["id"],
            'rol_id' => $datos["rol_id"]
         ]);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
            $return["correcto"] = TRUE;
         } // o no :(
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }


   /**
    * 
    * ****************************                                  METODOS PARA LAS CLASES                                                           ****************************
    * ****************************                                                                                                                    ****************************    
    */

   /**
    * Función que realiza el listado dde todas las clases
    */
   public function listadoClases()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT clasesExistentes.id, clasesExistentes.idClase, clasesExistentes.duracion ,clasesExistentes.Dia, clasesExistentes.horaInicio, clasesExistentes.horaFin, clases.nombre FROM clasesExistentes
                                                                                                                                                                               JOIN clases ON clasesExistentes.idClase = clases.id;";
         // Hacemos directamente la consulta al no tener parámetros
         $resultsquery = $this->db->query($sql);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }


   /**
    * Función que realiza el listado de la oferta de clases
    */
   public function verActividades()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM clases";

         $resultsquery = $this->db->query($sql);

         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif;
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función para insertar una determinada clase
    */
   public function insertarClase($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      try {
         $sql = "INSERT INTO clases(nombre,descripcion,imagen)
                          VALUES (:nombre,:descripcion,:imagen)";

         $query = $this->db->prepare($sql);

         $query->execute([
            'nombre' => $datos["nombre"],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen']
         ]);

         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) {
            $return["correcto"] = TRUE;
         }
      } catch (PDOException $ex) {
         var_dump($ex->getMessage());
         //$this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }

      return $return;
   }

   /**
    * Función que permite insertar una clase en un dia y hora determinados.
    */
   public function insertarClaseExistente($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      $contador = 0; //Variable para editar clases duplicadas.

      try {
         $this->db->beginTransaction();
         //Primero comprobamos que esas horas no esten ocupadas
         $sqlUno = "SELECT count(*) FROM clasesExistentes WHERE Dia=:dia and horaInicio<:horaFin and horaFin>:horaInicio";
         $queryUno = $this->db->prepare($sqlUno);

         $queryUno->execute(
            [
               'dia' => $datos['Dia'],
               'horaFin' => $datos['horaFin'],
               'horaInicio' => $datos['horaInicio']
            ]
         );
         $contador = $queryUno->fetch();

         //Si la hora esta libre:
         if ($contador['count(*)'] == 0) {
            $sql = "INSERT INTO clasesExistentes (idClase, Dia, horaInicio, horaFin)
                              VALUES (:idClase,:Dia,:horaInicio,:horaFin)";
            // Preparamos la consulta...
            $query = $this->db->prepare($sql);
            // y la ejecutamos indicando los valores que tendría cada parámetro
            $query->execute([
               'idClase' => $datos['idClase'],
               'Dia' => $datos['Dia'],
               'horaFin' => $datos['horaFin'],
               'horaInicio' => $datos['horaInicio']
            ]); //Supervisamos si la inserción se realizó correctamente... 

            if ($query) {
               $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
               $return["error"] = "Clase programada correctamente.";
            } // o no :(
         } else {
            $return["error"] = "Horario no disponible. Consulte el horario para ver horas libres.";
         }
      } catch (PDOException $ex) {
         $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
         $return["error"] = $ex->getMessage();
         //die();
      }
      return $return;
   }


   /**
    * Función que permite la eliminacion de una clase determinada de un dia y hora determinados
    */
   public function delCLaseExistente($id)
   {
      $fecha = date("d/m/Y");  //Creamos la fecha de envio del mensaje

      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      try {
         $this->db->beginTransaction();

         //BORRAMOS LAS RESERVAS DE ESA CLASE
         $sqlDos = "DELETE FROM asistenciaClases WHERE idClase=:idClase";
         $queryDos = $this->db->prepare($sqlDos);
         $queryDos->execute(['idClase' => $id]);

         //BORRAMOS LA CLASE
         $sql = "DELETE FROM clasesExistentes WHERE id=:id";
         $query = $this->db->prepare($sql);
         $query->execute(['id' => $id]);

         if ($query) {
            $this->db->commit();
            $return["correcto"] = TRUE;
         }
      } catch (PDOException $ex) {
         $this->db->rollback();
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que realiza la insercion de un usuario a una determinada clase
    */
   public function insertarInscripcion($id)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL,
         "inscrito" => FALSE
      ];

      $contador = 0; //Variable para editar clases duplicadas.


      $idUsuario = $_SESSION['id'];

      //Primero comprobamos que el usuario no esté ya inscrito en esa clase.
      $sqlUno = "SELECT count(*) FROM asistenciaClases WHERE idAlumno=:id and  idClase=:idClase";
      $queryUno = $this->db->prepare($sqlUno);
      $queryUno->execute(
         [
            'id' => $idUsuario,
            'idClase' => $id
         ]
      );
      $contador = $queryUno->fetch();

      //Si no esta inscrito se le inscribe
      if ($contador["count(*)"] == 0) {
         try { //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "INSERT INTO asistenciaClases (idClase, idAlumno)
                              VALUES (:idClase,:idUsuario)";
            // Preparamos la consulta...
            $query = $this->db->prepare($sql);
            // y la ejecutamos indicando los valores que tendría cada parámetro
            $query->execute([
               'idClase' => $id,
               'idUsuario' => $idUsuario
            ]); //Supervisamos si la inserción se realizó correctamente... 

            if ($query) {
               $this->db->commit(); // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
            //die();
         }
      } else { //Si ya esta inscrito se le informa.
         $return["inscrito"] = TRUE;
      }

      return $return;
   }

   /**
    * Función que realiza el listado de inscripciones
    */
   public function listadoInscripciones()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT clases.nombre, clasesExistentes.idClase, clasesExistentes.id, idAlumno, horaInicio, horaFin, Dia, clasesExistentes.duracion FROM clasesExistentes 
                                                                                           JOIN asistenciaClases ON clasesExistentes.id = asistenciaClases.idClase 
                                                                                           JOIN clases ON clasesExistentes.idClase = clases.id 
                                                                                           WHERE idAlumno=:idAlumno";


         $query = $this->db->prepare($sql);
         // Hacemos directamente la consulta al no tener parámetros
         $query->execute(['idAlumno' => $_SESSION['id']]);
         //Supervisamos si la inserción se realizó correctamente... 
         if ($query) :
            $return["correcto"] = TRUE;
            $return["datos"] = $query->fetchAll(PDO::FETCH_ASSOC);
         endif; // o no :(
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que permite borrar una inscripcion de un uusairo a una clase
    */
   public function borrarInscripcion($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      $usuario = $_SESSION['id'];

      try {
         $this->db->beginTransaction();

         $sql = "DELETE FROM asistenciaClases WHERE idAlumno=:idAlumno and idClase=:idClase";
         $query = $this->db->prepare($sql);
         $query->execute([
            'idAlumno' => $usuario,
            'idClase' => $id
         ]);

         if ($query) {
            $this->db->commit();
            $return["correcto"] = TRUE;
         }
      } catch (PDOException $ex) {
         $this->db->rollback();
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Funcion para retornar toda la informaciond de una clase en concreto, esta seusará para listarla en un formulario y que el usuario edite lo que vea oportuno.
    */
   public function infoClase($id)
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      try {
         $this->db->beginTransaction();

         $sql = "SELECT * FROM clases WHERE id=:id";
         $query = $this->db->prepare($sql);
         $query->execute(['id' => $id['id']]);
         $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
         $return['datos'] = $resultado;

         $this->db->commit();
      } catch (PDOException $ex) {
         $this->db->rollback();
         $return["error"] = $ex->getMessage();
      }
      return $return;
   }


   /**
    * Función que realiza el listado de la oferta de clases
    */
   public function listarOferta()
   {
      $return = [
         "correcto" => FALSE,
         "datos" => NULL,
         "error" => NULL
      ];

      //Realizamos la consulta...
      try {  //Definimos la instrucción SQL  
         $sql = "SELECT * FROM clases";

         $resultsquery = $this->db->query($sql);

         if ($resultsquery) :
            $return["correcto"] = TRUE;
            $return["datos"] = $resultsquery->fetchAll(PDO::FETCH_ASSOC);
         endif;
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función para editar una clase ya creada
    */
   public function editarClase($datos)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];


      try {
         $sql = "UPDATE clases SET nombre= :nombre, descripcion= :descripcion, imagen= :imagen WHERE id= :id";
         $query = $this->db->prepare($sql);


         if (!is_null(isset($datos['datos']))) {
            $query->execute([
               'nombre' => $datos["nombre"],
               'descripcion' => $datos['descripcion'],
               'imagen' =>   $datos['imagen'],
               'id' => $datos['id']
            ]);
         } else {
            $query->execute([
               'nombre' => $datos["nombre"],
               'descripcion' => $datos['descripcion'],
               'imagen' =>   $datos['imagen'],
               'id' => $datos['id']
            ]);
         }


         if ($query) {
            $return["correcto"] = TRUE;
         }
      } catch (PDOException $ex) {
         $return["error"] = $ex->getMessage();
      }

      return $return;
   }

   /**
    * Función que permite eliminar una clase
    */
   public function delClase($id)
   {
      $return = [
         "correcto" => FALSE,
         "error" => NULL
      ];

      //Si hemos recibido el id y es un número realizamos el borrado...
      if ($id && is_numeric($id)) {
         try {
            //PRIMERO BORRAMOS LAS CLASES EN EL HORARIO
            //Inicializamos la transacción
            $this->db->beginTransaction();
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM clasesExistentes WHERE idClase=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);

            //DESPUES BORRAMOS LA CLASE DEL SISTEMA
            //Definimos la instrucción SQL parametrizada 
            $sql = "DELETE FROM clases WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            //Supervisamos si la eliminación se realizó correctamente... 
            if ($query) {
               $this->db->commit();  // commit() confirma los cambios realizados durante la transacción
               $return["correcto"] = TRUE;
            } // o no :(
         } catch (PDOException $ex) {
            $this->db->rollback(); // rollback() se revierten los cambios realizados durante la transacción
            $return["error"] = $ex->getMessage();
         }
      } else {
         $return["correcto"] = FALSE;
      }

      return $return;
   }
}
