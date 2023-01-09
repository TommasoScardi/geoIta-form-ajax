<?php

//Il controller si aspetta i dati di input e emette i dati in putput
//ha la request e scrive la response

function getRegioni() {
    echo file_get_contents("../res/regioni.json");
    exit;
}

function getProvince($regione) {
    if(!isset($regione)) {
        NotFound("Campo regione assente nella richiesta");
    }

    $rawJson = file_get_contents("../res/regioni.json");
    $jsonObj = json_decode($rawJson, true);

    if(!is_array($jsonObj)) {
        NotFound("File json archivio corrotto -> regioni.json");
    }

    $regioneFound = false;
    foreach ($jsonObj as $value) {
        if(strcasecmp($value["nome"], $regione) === 0) {
            $regioneFound = true;
            break;
        }
    }
    if(!$regioneFound) {
        NotFound("La regione selezionata non ha province");
    }

    $rawJson = file_get_contents("../res/province.json");
    $jsonObj = json_decode($rawJson, true);
    $provinceRegione = array();
    foreach ($jsonObj as $value) {
        if(strcasecmp($value["regione"] ,$regione) === 0)
        {
            $jsonTempObj = new stdClass();
            $jsonTempObj->nome = $value["nome"];
            $jsonTempObj->sigla = $value["sigla"];
            array_push($provinceRegione, $jsonTempObj);
        }
    }
    if(count($provinceRegione) <= 0) {
        NotFound("La regione selezionata non ha province, server error");
    }
    echo json_encode($provinceRegione);
    exit;
}

function getComuni($siglaProvincia) {
    if(!isset($siglaProvincia)) {
        NotFound("Campo sigla non trovato nella richiesta");
    }
    if(strlen($siglaProvincia) !== 2) {
        NotFound("La sigla è in un formato incorretto -> $siglaProvincia");
    }

    $rawJson = file_get_contents("../res/province.json");
    $json = json_decode($rawJson, true);
    $provFound = false;
    foreach ($json as $value) {
        if(strcasecmp($siglaProvincia, $value["sigla"]) === 0)
        {
            $provFound = true;
            break;
        }
    }
    if(!$provFound) {
        NotFound("Nessun comune trovato con la sigla fornita");
    }

    $rawJson = file_get_contents("../res/comuni.json");
    $json = json_decode($rawJson, true);
    $comuniProvincia = array();
    foreach ($json as $value) {
        if(strcasecmp($siglaProvincia, $value["sigla"]) === 0)
        {
            $jsonObj = new stdClass();
            $jsonObj->nome = $value["nome"];
            array_push($comuniProvincia, $jsonObj);
        }
    }
    if(count($comuniProvincia) <= 0) {
        NotFound("Nessun comune trovato con la sigla fornita, server error");
    }
    echo json_encode($comuniProvincia);
    exit;
}