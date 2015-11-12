<?php 
session_start();

if(!isset($_SESSION['sidebar_show']) || !isset($_COOKIE['sidebar_show'])) {

	$_SESSION['sidebar_show'] = TRUE;
	setcookie("sidebar_show" ,TRUE ,time()+ (24*3600));

}else{

	$sidebar_show = $_SESSION['sidebar_show'];
	unset( $_SESSION['sidebar_show'], $sidebar_show );
	unset($_COOKIE['sidebar_show']);
}



exit(json_encode(true));
?>
