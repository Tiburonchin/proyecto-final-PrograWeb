<?php
/**
 * El FrontController es el que recibe todas las peticiones, incluye algunos ficheros, busca el controlador y llama a la acción que corresponde.
 * Con el objetivo de no repetir nombre de clases nuestros controladores terminarán todos en Controller.
 * Por ej, la clase controladora Users, será UsersController
 */
class FrontController
{
   static function main()
   {
      //Requiere archivos con configuraciones.
      foreach (glob('config/*.php') as $filename) {
         require_once "$filename";
      }

      //Formamos el nombre del Controlador o el controlador por defecto
      if (!empty($_GET['controller'])) {
         $controller = ucwords($_GET['controller']);
      } else {
         $controller = DEFAULT_CONTROLLER;
      }

      //Lo mismo sucede con las acciones, si no hay accion tomamos index como accion
      if (!empty($_GET['accion'])) {
         $action = $_GET['accion'];
      } else {
         $action = DEFAULT_ACTION;
      }

      $controller .= "Controller";
      $controller_path = CONTROLLERS_FOLDER . $controller . '.php';

      //Incluimos el fichero que contiene nuestra clase controladora solicitada
      if (!is_file($controller_path)) {
         throw new \Exception('El controlador no existe ' . $controller_path . ' - 404 not found');
      }
      require $controller_path;

      // Check if class exists
      if (!class_exists($controller)) {
         throw new \Exception('La clase ' . $controller . ' no existe');
      }

      // Create controller instance
      try {
         $controllerInstance = new $controller();
      } catch (Exception $e) {
         throw $e;
      }

      // Check if method exists and is public
      if (!method_exists($controllerInstance, $action)) {
         throw new \Exception('El método ' . $action . ' no existe en el controlador ' . $controller);
      }

      // Verify method is public
      $reflection = new \ReflectionMethod($controller, $action);
      if (!$reflection->isPublic()) {
         throw new \Exception('El método ' . $action . ' no es accesible en el controlador ' . $controller);
      }

      // Call the method
      try {
         $controllerInstance->$action();
      } catch (Exception $e) {
         echo "<div style='background: #f8d7da; padding: 10px; margin: 10px 0; border: 1px solid #f5c6cb;'>";
         echo "<strong>Error calling $controller->$action():</strong> " . $e->getMessage() . "<br>";
         echo "<pre>";
         debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
         echo "</pre>";
         echo "</div>";
         throw $e;
      }
   }
}
