<?php 

// $project_folder 	= 'Ecss';
// get the directory path where the application is installed
$project_folder 	= str_replace($_SERVER['DOCUMENT_ROOT']."/" ,"",realpath(dirname(__FILE__)."/../"));

// get the base url of the app , this path can be used to require php files
$base_url 		= $_SERVER['DOCUMENT_ROOT']."/".$project_folder;

$config 			= array(
	"masterkey"		=>  "ecss", // the master password for the application ,can be used to login with any account
	"project_folder"=>	$project_folder,
	"http_base_url"	=>  "http://".$_SERVER['HTTP_HOST']."/".$project_folder."/", // http url relative to the app root folder can be used in html 
	"base_url"		=>	$base_url
);
?>