<?php 
if (session_id() == '') {
  session_start();
}
require_once 'config.php';
require_once 'functions.php';
require_once 'composer.php';
require_once 'dares_conn.php';
require_once 'perm.php';