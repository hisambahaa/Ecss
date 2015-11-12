<?php 
echo __DIR__;
echo "<br>";
echo dirname(__FILE__);
echo "<br>";
var_dump($_SERVER);
var_dump(pathinfo($_SERVER['SCRIPT_FILENAME']));
echo getcwd();
?>