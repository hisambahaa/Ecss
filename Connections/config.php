<?php 

$base_url = explode('/',$_SERVER['REQUEST_URI']);
$template_dir = $_SERVER['DOCUMENT_ROOT']."/".$base_url[1];

$mas = "ecss";
$config = array(
	"masterkey"		=>"ecss",
	"http_base_url"	=> "http://".$_SERVER['HTTP_HOST']."/".$base_url[1]."/",
	"base_url"		=>$template_dir
);
?>