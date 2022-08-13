<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require 'App/Controllers/Controller.php';



$controller = new \App\Controllers\Controller();
$getData = $controller->getData();
$preDataPai = $controller->preDataPai($getData);

?>