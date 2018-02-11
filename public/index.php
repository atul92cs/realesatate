<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once '../includes/dboperations.php';
$app= new \Slim\App(['settings'=>['displayErrorDetails'=>true]]);
$app->get('/test',function(Request $req,Response $res){
	    $result="it works.app is updated";
		$res->getBody()->write(json_encode(array($result)));
});
$app->get('/cities',function(Request $req,Response $res)
{
	$db=new $DbOperation();
	$cities=$db->getCities();
	$res->getBody()->write(json_encode(array("Cities"=>$cities)));
});
$app->run();
