<?php
//include models
include "models/ModelBase.php";
foreach (glob("models/*.php") as $filename) {
    if ($filename !== "models/ModelBase.php") {
        include $filename;
    }
}
function error($message)
{
    $file = fopen("logs/error.log", "a");
    fwrite($file, $message . "\n");
    fclose($file);
}
function post($name, $default = null)
{
    return isset($_POST[$name]) ? $_POST[$name] : $default;
}
function get($name, $default = null)
{
    return isset($_GET[$name]) ? $_GET[$name] : $default;
}

function printer($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
error("start");
/**
 * convert string to controller name. ex: "my-site" => "MySiteController"
 * @param string $string
 * @return string
 */
function stringToControllerName(String $string): String
{
    $string = str_replace(" ", "", ucwords(str_replace("-", " ", $string))) . "Controller";
    return $string;
}
/**
 * convert string to action name. ex: "my-site" => "actionMySite"
 * @param string $string
 * @return string
 */
function stringToActionName(String $string): String
{
    $string = "Action" . str_replace(" ", "", ucwords(str_replace("-", " ", $string)));
    return $string;
}

function getControllerAndAction()
{
    $controller = "SiteController";
    $action = null;
    if (isset($_GET['controller']) && !empty($_GET['controller'])) {
        $controller = stringToControllerName($_GET['controller']);
    }
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $action = stringToActionName($_GET['action']);
    }
    return [$controller, $action];
}

list($controller, $action) = getControllerAndAction();


if (!file_exists("controllers/$controller.php")) {
    $controller = "BaseController";
    $action = "actionError";
}

if ($controller !== "BaseController") {
    include "controllers/BaseController.php";
}
include "controllers/$controller.php";
//check if class $controller exists
if (!class_exists($controller)) {
    throw new Exception("Class $controller does not exist in file controllers/$controller.php");
}
$controller = new $controller();
//if action exists
if (method_exists($controller, $action)) {
    echo $controller->$action();
} else {
    if ($action === null) {
        echo $controller->actionIndex();
    }
    //if action is set but does not exist
    else {
        echo $controller->actionError();
    }
}
