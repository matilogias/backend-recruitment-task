<?php
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
function request($name, $request ='post', $default = null)
{
    if ($request === 'post') {
        return post($name, $default);
    }
    if ($request === 'get') {
        return get($name, $default);
    }
    throw new Exception("Request type \"$request\" is not supported");
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