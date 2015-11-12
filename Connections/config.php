<?php 

// $project_folder 	= 'Ecss';
// get the directory path where the application is installed

$project_folder 	= str_replace($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR ,"",str_replace("\\","/",realpath(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR)));

// get the base url of the app , this path can be used to require php files
//var_dump($project_folder);
//var_dump($_SERVER['DOCUMENT_ROOT']);
//var_dump(str_replace('/','\\',$_SERVER['DOCUMENT_ROOT']));

$base_url 		= $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$project_folder;


$config 			= array(
	"masterkey"		=>  "ecss", // the master password for the application ,can be used to login with any account
	"project_folder"=>	$project_folder,
	"http_base_url"	=>  "http://".$_SERVER['HTTP_HOST']."/".$project_folder."/", // http url relative to the app root folder can be used in html 
	"base_url"		=>	$base_url
);
