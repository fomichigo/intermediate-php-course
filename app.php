#!/usr/bin/env php
<?php
require __DIR__ . "/vendor/autoload.php";

$command = "error";
$name = "";

if (isset($argv[1])) {
    $command = $argv[1];
    if (isset($argv[2]))
        $name = $argv[2];
}

switch ($command) {
    case ('model'):
        if (file_exists(__DIR__ . "/src/Models/" . $name . ".php")) {
            printf("Model already exists! Aborting...");
            printf("\n\r");
            exit;
        } else {
            makeModel($name);
        }
        break;

    case ('controller'):
        if (file_exists(__DIR__ . "/src/Controllers/" . $name . ".php")) {
            printf("Controller already exists! Aborting...");
            printf("\n\r");
            exit;
        } else {
            makeController($name);
        }
        break;

    case ('exception'):
        if (file_exists(__DIR__ . "/src/Exceptions/" . $name . ".php")) {
            printf("Exception already exists! Aborting...");
            printf("\n\r");
            exit;
        } else {
            makeException($name);
        }
        break;

    case ('migration'):

        break;

    default:
        printf("Command not known. Usage: php app <command> <name>");
        printf("\n\r");
        printf("Available commands: model, controller, migration, migrate");
}

printf("\n\r");


/**
 * Create a stub controller
 * @param $name
 */
function makeController($name)
{
    $controller = file_get_contents(__DIR__ . "/CodeTemplates/ControllerStub.txt");
    $controller = str_replace("!name!", $name, $controller);
    $file = fopen(__DIR__ . "/src/Controllers/" . $name . ".php", "w");
    fwrite($file, $controller);
    fclose($file);
    printf("Controller " . $name . " created");
    printf("\n\r");
}


/**
 * Create a stub model
 * @param $name
 */
function makeModel($name)
{
    $model = file_get_contents(__DIR__ . "/CodeTemplates/ModelStub.txt");
    $model = str_replace("!name!", $name, $model);
    $file = fopen(__DIR__ . "/src/Models/" . $name . ".php", "w");
    fwrite($file, $model);
    fclose($file);
    printf("Model " . $name . " created");
    printf("\n\r");
}

/**
 * Create a stub exception
 * @param $name
 */
function makeException($name)
{
    $exception = file_get_contents(__DIR__ . "/CodeTemplates/ExceptionStub.txt");
    $exception = str_replace("!name!", $name, $exception);
    $file = fopen(__DIR__ . "/src/Exceptions/" . $name . ".php", "w");
    fwrite($file, $exception);
    fclose($file);
    printf("Exception " . $name . " created");
    printf("\n\r");
}
