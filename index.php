<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug function
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

/**
 * Inclusión de los archivos que contienen las clases de core
 * Cuando PHP usa una clase que no encuentra va a llamar a la función anónima definida en el callback
 * que requiere (incluye) la clase
 * @return void
 */
spl_autoload_register(function ($nombre) {
    // Debug: Uncomment to see what classes are being loaded
    // echo "Trying to load: $nombre<br>";
    
    $coreFile = __DIR__ . '/core/' . $nombre . '.php';
    $controllerFile = __DIR__ . '/controladores/' . $nombre . '.php';
    
    // Debug: Uncomment to see the file paths being checked
    // echo "Checking: $coreFile<br>";
    // echo "Checking: $controllerFile<br>";
    
    if (file_exists($coreFile)) {
        require $coreFile;
        // Debug: Uncomment to confirm when a file is loaded
        // echo "Loaded from core: $coreFile<br>";
    } elseif (file_exists($controllerFile)) {
        require $controllerFile;
        // Debug: Uncomment to confirm when a file is loaded
        // echo "Loaded from controllers: $controllerFile<br>";
    } else {
        // For debugging - remove in production
        die("Could not load class: $nombre. Tried: $coreFile and $controllerFile");
    }
});

try {
    // Debug: Check if FrontController exists
    if (!class_exists('FrontController')) {
        throw new Exception('FrontController class not found. Check autoloading.');
    }
    
    // Debug: Check if main method exists
    if (!method_exists('FrontController', 'main')) {
        throw new Exception('FrontController::main() method not found.');
    }
    
    // Start the application
    FrontController::main();
    
} catch (Exception $e) {
    // Show detailed error information
    echo '<h2>Error:</h2>';
    echo '<p><strong>Message:</strong> ' . $e->getMessage() . '</p>';
    echo '<p><strong>File:</strong> ' . $e->getFile() . ' on line ' . $e->getLine() . '</p>';
    
    // Show backtrace
    echo '<h3>Backtrace:</h3>';
    echo '<pre>';
    debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    echo '</pre>';
    
    // Show included files
    echo '<h3>Included Files:</h3>';
    echo '<pre>';
    print_r(get_included_files());
    echo '</pre>';
}

