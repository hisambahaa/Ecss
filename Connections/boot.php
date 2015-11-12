<?php 
if (session_id() == '') {
  session_start();
}

require_once 'config.php';
require_once 'languages'.DIRECTORY_SEPARATOR.$config['language'].'.php';
require_once 'functions.php';
require_once 'composer.php';
require_once 'dares_conn.php';
if(basename($_SERVER["REQUEST_URI"])!=='login.php')
require_once 'perm.php';