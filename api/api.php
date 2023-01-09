<?php

include_once "util.php";

if($_SERVER["REQUEST_METHOD"] === "GET")
{
    include_once "router.php";
}
else if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if(strcasecmp($contentType, 'application/json') != 0){
        NotFound('Content type must be: application/json');
    }

    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));

    //Attempt to decode the incoming RAW post data from JSON.
    $decoded = json_decode($content, true);

    //If json_decode failed, the JSON is invalid.
    if(!is_array($decoded)){
        NotFound('Received content contained invalid JSON!');
    }
    echo json_encode($decoded);
    exit;
}
