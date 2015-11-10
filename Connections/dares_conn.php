<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dares_conn = "localhost";
$database_dares_conn = "dares";
$username_dares_conn = "root";
$password_dares_conn = "OmanIis_2015";
$dares_conn = @mysql_pconnect($hostname_dares_conn, $username_dares_conn, $password_dares_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>