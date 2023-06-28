<?php
include "framework/functions.php";

//include models
include "models/ModelBase.php";
foreach (glob("models/*.php") as $filename) {
    if ($filename !== "models/ModelBase.php") {
        include $filename;
    }
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
