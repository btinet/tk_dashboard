<?php
// PHP-Dateien werden mit <?php eingeleitet. Folgt danach kein HTML, darf das schließende Tag am Ende fehlen.
// Verwende die Kernel-Class als Kernel.
use App\Repository\ExamRepository;
use Core\ErrorHandler\ErrorExceptionHandler;
use Core\Kernel;
use Symfony\Component\ErrorHandler\Debug;

// Definiere das Wurzelverzeichnis des Projekts.
define("project_root", dirname(__DIR__));
// Lade die Autoload-Class von Composer zum dynamischen Nachladen unserer Classes.
require (project_root . '/vendor/autoload.php');

// Neue Instanz der Kernel-Class.
$kernel = new Kernel();

Debug::enable();

// or enable only one feature
//ErrorHandler::register();
//DebugClassLoader::enable();

// If you want a custom generic template when debug is not enabled
// HtmlErrorRenderer::setTemplate('/path/to/custom/error.html.php');

    $kernel
        // Routen aus Konfiguration hinzufügen. Entsprechende Methode der Klasse wird ausgeführt.
        ->addRoutes()
        ->addNotFound()
        ->run()
    ;


