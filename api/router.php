<?php

include_once "controller.php";

if(isset($_GET["q"]) && str_contains($_GET["q"], "get"))
{
    switch ($_GET["q"]) {
        case "getRegioni":
            getRegioni();
            break;
        case "getProvince":
            getProvince($_GET["regione"]);
            break;
        case "getComuni":
            getComuni($_GET["siglaProv"]);
            break;
        default:
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            echo '{"message": "router can\'t cathegorize the gived command => '.$_GET["q"].'"}';
            break;
    }
}
else
{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    echo '{"message": "no query string founded"}';
    exit;
}