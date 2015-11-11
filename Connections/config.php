<?php 

$base_url = explode('/',$_SERVER['REQUEST_URI']);

$mas = "ecss";
$config = array(
	"masterkey"	=>"ecss",
	"base_url"	=> "http://".$_SERVER['REMOTE_ADDR']."/".$base_url[1]."/"
);
?>