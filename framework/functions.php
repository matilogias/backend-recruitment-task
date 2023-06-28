<?php
function error()
{
    $data = func_get_args();
    $file = fopen("logs/error.log", "a");
    fwrite($file, date("Y-m-d H:i:s") . "\n");
    foreach ($data as $value) {
        fwrite($file, print_r($value, true) . "\n");
    }
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

function printer()
{
    $data = func_get_args();
    echo "<pre>";
    foreach ($data as $value) {
        print_r($value);
    }
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

function icon($name, $class = '')
{
    $icons = [
        'arrow-up' => '<svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M450-160v-526L202-438l-42-42 320-320 320 320-42 42-248-248v526h-60Z"/></svg>',
        'arrow-down' => '<svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M480-160 160-480l42-42 248 248v-526h60v526l248-248 42 42-320 320Z"/></svg>',
    ];

    if (isset($icons[$name])) {
        return $icons[$name];
    }

    return '';
}

function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}