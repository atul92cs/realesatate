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
	$db=new DbOperation();
	$cities=$db->getCities();
	$res->getBody()->write(json_encode(array("Cities"=>$cities)));
});
$app->get('/projects',function(Request $req,Response $res){
	$db=new DbOperation();
	$projects=$db->getProjects();
	$res->getBody()->write(json_encode(array("Projects"=>$projects)));
});
$app->get('/projects/{city}',function(Request $req,Response $res)
{
	$city=$req->getAttribute('city');
	$db=new DbOperation();
	$projects=$db->getProjectsbyCity($city);
	$res->getBody()->write(json_encode(array("Projects"=>$projects)));
});
$app->get('/rentables/{city}',function(Request $req,Response $res){
	$city=$req->getAttribute('city');
	$db=new DbOperation();
	$rents=$db->getRentables($city);
	$res->getBody()->write(json_encode(array("Rentables"=>$rents)));
});
$app->get('/sale/{city}',function(Request $req,Response $res){
	$city=$req->getAttribute('city');
	$db=new DbOperation();
	$sale=$db->getSaleables($city);
	$res->getBody()->write(json_encode(array("Saleables"=>$sale)));
});
$app->get('/types',function(Request $req,Response $res){
	$db=new DbOperation();
	$types=$db->getTypes();
	$res->getBody()->write(json_encode(array("Types"=>$types)));
});
$app->run();
