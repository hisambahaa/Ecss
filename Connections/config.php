<?php 

$project_folder 	= 'Ecss';

$template_dir 		= $_SERVER['DOCUMENT_ROOT']."/".$project_folder;

$config 			= array(
	"masterkey"		=>"ecss",
	"project_folder"=>$project_folder,
	"http_base_url"	=> "http://".$_SERVER['HTTP_HOST']."/".$project_folder."/",
	"base_url"		=>$template_dir
);
?>