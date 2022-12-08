<?php

//Il controller si aspetta i dati di input e emette i dati in putput
//ha la request e scrive la response

function getRegioni() {
    echo file_get_contents("../res/regioni.json");
    exit;
}

function getProvince($regione) {
    if(!isset($regione)) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "no regione field found in query string"}';
        exit;
    }

    $rawJson = file_get_contents("../res/regioni.json");
    $jsonObj = json_decode($rawJson, true);

    if(!is_array($jsonObj)) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "invalid json file regioni.json"}';
        exit;
    }

    $regioneFound = false;
    foreach ($jsonObj as $value) {
        if(strcasecmp($value["nome"], $regione) === 0) {
            $regioneFound = true;
            break;
        }
    }
    if(!$regioneFound) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "the regione provided in the query sttring has no match!"}';
        exit;
    }

    $rawJson = file_get_contents("../res/province.json");
    $jsonObj = json_decode($rawJson, true);
    $provinceRegione = array();
    foreach ($jsonObj as $value) {
        if(strcasecmp($value["regione"] ,$regione))
        {
            $jsonTempObj = new stdClass();
            $jsonTempObj->nome = $value["nome"];
            $jsonTempObj->sigla = $value["sigla"];
            array_push($provinceRegione, $jsonTempObj);
        }
    }
    if(count($provinceRegione) <= 0) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "no entry in the province array, there are problems with the selected regione"}';
        exit;
    }
    echo json_encode($provinceRegione);
    exit;
}

function getComuni($siglaProvincia) {
    if(!isset($siglaProvincia)) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "no sigla field found in query string"}';
        exit;
    }
    if(strlen($siglaProvincia) !== 2) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "sigla field is in an incorrect format"}';
        exit;
    }

    $rawJson = file_get_contents("./res/province.json");
    $json = json_decode($rawJson, true);
    $provSigla = strtoupper($_GET["sigla"]);
    $provFound = false;
    foreach ($json as $value) {
        if(strcmp($provSigla, $value["sigla"]) === 0)
        {
            $provFound = true;
            break;
        }
    }
    if(!$provFound) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "no province found with gived name"}';
        exit;
    }

    $rawJson = file_get_contents("./res/comuni.json");
    $json = json_decode($rawJson, true);
    $comuniProvincia = array();
    foreach ($json as $value) {
        if(strcmp($provSigla, $value["sigla"]) === 0)
        {
            $jsonObj = new stdClass();
            $jsonObj->nome = $value["nome"];
            array_push($comuniProvincia, $jsonObj);
        }
    }
    if(count($comuniProvincia) <= 0) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "no entry in the comuni array, there are problems with the selected provincia"}';
        exit;
    }
    echo json_encode($comuniProvincia);
    exit;
}