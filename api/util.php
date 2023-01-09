<?php

function NotFound(string $message = "non trovato") {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    echo '{"message": '+$message+'}';
    exit;
}