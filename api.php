<?php

if($_SERVER["REQUEST_METHOD"] === "GET")
{
    if(isset($_GET["q"]) && str_contains($_GET["q"], "get"))
    {
        switch ($_GET["q"]) {
            case "getRegioni":
                $rawJson = file_get_contents("./res/regioni.json");
                echo $rawJson;
                exit;

            case "getProvince":
                if(!isset($_GET["regione"]))
                {
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    echo '{"message": "no regione field found in query string"}';
                    exit;
                }

                $rawJson = file_get_contents("./res/regioni.json");
                $json = json_decode($rawJson, true);
                $regSel = strtolower($_GET["regione"]);
                $regFound = false;

                foreach ($json as $value)
                {
                    if(strcmp(strtolower($value["nome"]), $regSel) === 0)
                    {
                        $regFound = true;
                        break;
                    }
                }
                if(!$regFound)
                {
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    echo '{"message": "no region found with gived name"}';
                    exit;
                }

                $rawJson = file_get_contents("./res/province.json");
                $json = json_decode($rawJson, true);
                $apiOutput = array();
                foreach ($json as $value) {
                    if (strcmp(strtolower($value["regione"]), strtolower($regSel)) === 0) {
                        $jsonObj = new stdClass();
                        $jsonObj->nome = $value["nome"];
                        $jsonObj->sigla = $value["sigla"];
                        //$jsonObj->reg = $value["regione"];
                        array_push($apiOutput, $jsonObj);
                    }
                }
                echo json_encode($apiOutput);
                break;
            case "getComuni":
                if(!isset($_GET["sigla"]) && strlen($_GET["sigla"]) <= 2)
                {
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    echo '{"message": "no sigla field found in query string or incorrect format"}';
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
                if(!$provFound)
                {
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    echo '{"message": "no province found with gived name"}';
                    exit;
                }

                $rawJson = file_get_contents("./res/comuni.json");
                $json = json_decode($rawJson, true);
                $apiOutput = array();
                foreach ($json as $value) {
                    if(strcmp($provSigla, $value["sigla"]) === 0)
                    {
                        $jsonObj = new stdClass();
                        $jsonObj->nome = $value["nome"];
                        array_push($apiOutput, $jsonObj);
                    }
                }
                echo json_encode($apiOutput);
                break;
            default:
                header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                echo '{"message": "unrecognized get element"}';
                break;
        }
    }
    else
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo '{"message": "no query string founded"}';
        exit;
    }
}
